<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class GaleriController extends BaseController
{
    public function index()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login!');
        }

        $id_user = session()->get('id_user');

        // Pastikan hanya pengguna dengan id_user yang sesuai yang dapat mengakses halaman
        if (session()->get('id_user') != $id_user) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda tidak memiliki akses ke halaman ini !');
        }

        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_feedback->getUnreadEntries();
        $unreadCount = $this->m_feedback->countUnreadEntries();
        //END WAJIB//

        $tb_foto = $this->m_galeri->getFotoWithFile();

        $data = [
            'title' => 'Admin | Halaman Galeri',
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_foto' => $tb_foto,
        ];

        return view('admin/galeri/index', $data);
    }

    public function tambah()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login!');
        }
        $id_user = session()->get('id_user');

        // Pastikan hanya pengguna dengan id_user yang sesuai yang dapat mengakses halaman
        if (session()->get('id_user') != $id_user) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda tidak memiliki akses ke halaman ini !');
        }

        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_feedback->getUnreadEntries();
        $unreadCount = $this->m_feedback->countUnreadEntries();
        //END WAJIB//
        $tb_foto = $this->m_galeri->getFotoWithFile();

        $data = [
            'title' => 'Admin | Halaman Tambah Galeri',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_foto' => $tb_foto,
        ];

        return view('admin/galeri/tambah', $data);
    }

    public function save()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login');
        }

        // Validasi input
        if (!$this->validate([
            'judul_foto' => [
                'rules' => 'required|trim|max_length[90]|min_length[5]',
                'errors' => [
                    'required' => 'Kolom Judul Tidak Boleh Kosong !',
                    'max_length' => 'Penamaan Judul Tidak Boleh Lebih Dari 90 Karakter !',
                    'min_length' => 'Penamaan Judul Tidak Boleh Kurang Dari 5 Karakter !'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required|trim|max_length[255]',
                'errors' => [
                    'required' => 'Kolom Deskripsi Tidak Boleh Kosong !',
                    'max_length' => 'Deskripsi Tidak Boleh Melebihi 255 Karakter !'
                ]
            ],
            'tanggal_foto' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Tanggal Tidak Boleh Kosong !',
                ]
            ]
        ])) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->to('/admin/galeri/tambah/' . $this->request->getPost('slug'))->withInput();
        }

        // Panggil helper uploadFile untuk multiple files
        $uploadedFiles = uploadMultiple('file_foto', 'dokumen/galeri/');

        if (empty($uploadedFiles)) {
            // Jika file tidak berhasil diunggah, tampilkan pesan error
            session()->setFlashdata('error', 'File gagal diunggah. Silakan coba lagi.');
            return redirect()->back()->withInput();
        }

        // Simpan data foto
        $this->m_galeri->save([
            'judul_foto' => $this->request->getPost('judul_foto'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tanggal_foto' => $this->request->getPost('tanggal_foto'),
            'slug' => url_title($this->request->getPost('judul_foto'), '-', true),
        ]);

        // Dapatkan ID dari foto yang baru saja disimpan
        $idFoto = $this->m_galeri->insertID();

        // Simpan data file yang diunggah ke tb_file_foto dan relasinya ke tb_galeri
        foreach ($uploadedFiles as $fileName) {
            $this->db->table('tb_file_foto')->insert([
                'file_foto' => $fileName,
            ]);

            // Dapatkan ID file foto yang baru saja disimpan
            $idFileFoto = $this->db->insertID();

            // Relasikan file foto dengan foto yang sudah disimpan sebelumnya
            $this->db->table('tb_galeri')->insert([
                'id_foto' => $idFoto,
                'id_file_foto' => $idFileFoto,
            ]);
        }

        session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan !');

        return redirect()->to('/admin/galeri');
    }

    public function cek_data($id_foto)
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        // Pastikan hanya admin yang dapat mengakses halaman ini
        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda tidak memiliki akses ke halaman ini');
        }

        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_feedback->getUnreadEntries();
        $unreadCount = $this->m_feedback->countUnreadEntries();
        //END WAJIB//

        // Ambil data foto berdasarkan id_foto
        $tb_foto = $this->m_galeri->getFotoById();

        // Jika data foto tidak ditemukan, atau id_user tidak sesuai, redirect ke halaman sebelumnya
        if (!$tb_foto) {
            return redirect()->back()->with('gagal', 'Data Foto Tidak Ditemukan dan Anda Tidak Memiliki Akses Foto Tersebut &#128540');
        }

        $data = [
            'title' => 'Admin | Halaman Cek Data Foto',
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_foto' => $tb_foto,
            'dokumen' => $this->m_galeri->getDokumenByFotoId($id_foto),
        ];

        return view('admin/galeri/cek_data', $data);
    }

    public function edit($slug)
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        // Pastikan hanya admin yang dapat mengakses halaman ini
        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda tidak memiliki akses ke halaman ini');
        }

        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_feedback->getUnreadEntries();
        $unreadCount = $this->m_feedback->countUnreadEntries();
        //END WAJIB//

        // Ambil data foto berdasarkan id_foto
        $tb_foto = $this->m_galeri->getFotoBySlug($slug);

        // Jika data foto tidak ditemukan, atau id_user tidak sesuai, redirect ke halaman sebelumnya
        if (!$tb_foto) {
            return redirect()->back()->with('gagal', 'Data Foto Tidak Ditemukan dan Anda Tidak Memiliki Akses Foto Tersebut &#128540');
        }

        $data = [
            'title' => 'Admin | Halaman Cek Data Foto',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_foto' => $tb_foto,
        ];

        return view('admin/galeri/edit', $data);
    }

    public function update($id_foto)
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login');
        }

        // Validasi input
        if (!$this->validate([
            'judul_foto' => [
                'rules' => 'required|trim|max_length[90]|min_length[5]',
                'errors' => [
                    'required' => 'Kolom Judul Tidak Boleh Kosong !',
                    'max_length' => 'Penamaan Judul Tidak Boleh Lebih Dari 90 Karakter !',
                    'min_length' => 'Penamaan Judul Tidak Boleh Kurang Dari 5 Karakter !'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required|trim|max_length[255]',
                'errors' => [
                    'required' => 'Kolom Deskripsi Tidak Boleh Kosong !',
                    'max_length' => 'Deskripsi Tidak Boleh Melebihi 255 Karakter !'
                ]
            ],
            'tanggal_foto' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Tanggal Tidak Boleh Kosong !',
                ]
            ]
        ])) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Panggil helper updateFile untuk multiple files
        $uploadedFiles = uploadMultiple('file_foto', 'dokumen/galeri/');

        // Jika ada file yang diunggah, simpan data file yang diunggah ke tb_file_foto dan relasinya ke tb_galeri
        if (!empty($uploadedFiles)) {
            // Hapus file lama jika ada file baru yang diunggah
            $oldFileNames = explode(', ', $this->request->getPost('old_file_foto'));
            foreach ($oldFileNames as $oldFileName) {
                if (file_exists(ROOTPATH . 'public/' . $oldFileName)) {
                    unlink(ROOTPATH . 'public/' . $oldFileName);
                }
            }

            // Hapus relasi lama dari tb_galeri dan tb_file_foto
            $this->db->table('tb_galeri')->where('id_foto', $id_foto)->delete();
            $this->db->table('tb_file_foto')->whereIn('file_foto', $oldFileNames)->delete();

            // Simpan file baru
            foreach ($uploadedFiles as $fileName) {
                $this->db->table('tb_file_foto')->insert([
                    'file_foto' => $fileName,
                ]);

                // Dapatkan ID file foto yang baru saja disimpan
                $idFileFoto = $this->db->insertID();

                // Relasikan file foto dengan foto yang sudah disimpan sebelumnya
                $this->db->table('tb_galeri')->insert([
                    'id_foto' => $id_foto,
                    'id_file_foto' => $idFileFoto,
                ]);
            }
        } else {
            // Jika tidak ada file baru yang diunggah, gunakan file lama
            $uploadedFiles = explode(', ', $this->request->getPost('old_file_foto'));
        }

        // Simpan data ke dalam database
        $this->m_galeri->update($id_foto, [
            'judul_foto' => $this->request->getPost('judul_foto'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tanggal_foto' => $this->request->getPost('tanggal_foto'),
            'slug' => url_title($this->request->getPost('judul_foto'), '-', true),
            'file_foto' => implode(', ', $uploadedFiles) // Simpan nama file baru atau lama ke database
        ]);

        // Set flash message untuk sukses
        session()->setFlashdata('pesan', 'Data Berhasil Diubah !');

        return redirect()->to('/admin/galeri');
    }

    public function delete()
    {
        $id_foto = $this->request->getPost('id_foto');

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Dapatkan ID file foto yang terkait dengan foto yang akan dihapus
            $dataFiles = $this->m_galeri->getFilesById($id_foto);

            if (empty($dataFiles)) {
                throw new \Exception('Tidak ada file yang ditemukan untuk id_foto.');
            }

            // Loop dan hapus setiap file yang terkait dari direktori
            foreach ($dataFiles as $fileData) {
                $filePath = $fileData['file_foto'];
                $fullFilePath = ROOTPATH . 'public/' . $filePath;
                if (is_file($fullFilePath)) {
                    if (!unlink($fullFilePath)) {
                        throw new \Exception('Gagal menghapus file: ' . $fullFilePath);
                    }
                }
            }

            // Hapus entri dari tb_galeri
            $this->m_galeri->deleteFilesAndEntries($id_foto);

            // Hapus entri dari tb_foto
            $db->table('tb_foto')->where('id_foto', $id_foto)->delete();

            // Hapus entri dari tb_file_foto yang tidak terkait dengan laporan lain
            $db->table('tb_file_foto')
                ->whereNotIn('id_file_foto', function ($builder) use ($id_foto) {
                    $builder->select('id_file_foto')
                        ->from('tb_galeri')
                        ->where('id_foto !=', $id_foto);
                })
                ->delete();

            $db->transComplete();

            if ($db->transStatus() === false) {
                $db->transRollback();
                return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data']);
            }

            $db->transCommit();
            return $this->response->setJSON(['status' => 'success', 'message' => 'File dan data berhasil dihapus']);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data', 'error' => $e->getMessage()]);
        }
    }

    public function delete2()
    {
        $id_foto = $this->request->getPost('id_foto');

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Dapatkan ID file foto yang terkait dengan foto yang akan dihapus
            $dataFiles = $this->m_galeri->getFilesById($id_foto);

            if (empty($dataFiles)) {
                throw new \Exception('Tidak ada file yang ditemukan untuk id_foto.');
            }

            // Loop dan hapus setiap file yang terkait dari direktori
            foreach ($dataFiles as $fileData) {
                $filePath = $fileData['file_foto'];
                $fullFilePath = ROOTPATH . 'public/' . $filePath;
                if (is_file($fullFilePath)) {
                    if (!unlink($fullFilePath)) {
                        throw new \Exception('Gagal menghapus file: ' . $fullFilePath);
                    }
                }
            }

            // Hapus entri dari tb_galeri
            $this->m_galeri->deleteFilesAndEntries($id_foto);

            // Hapus entri dari tb_foto
            $db->table('tb_foto')->where('id_foto', $id_foto)->delete();

            // Hapus entri dari tb_file_foto yang tidak terkait dengan laporan lain
            $db->table('tb_file_foto')
                ->whereNotIn('id_file_foto', function ($builder) use ($id_foto) {
                    $builder->select('id_file_foto')
                        ->from('tb_galeri')
                        ->where('id_foto !=', $id_foto);
                })
                ->delete();

            $db->transComplete();

            if ($db->transStatus() === false) {
                $db->transRollback();
                return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data']);
            }

            $db->transCommit();
            return $this->response->setJSON(['status' => 'success', 'message' => 'File dan data berhasil dihapus']);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data', 'error' => $e->getMessage()]);
        }
    }

    public function totalData()
    {
        $totalData = $this->m_galeri->getTotalGaleri();
        // Keluarkan total data sebagai JSON response
        return $this->response->setJSON(['total' => $totalData]);
    }
}
