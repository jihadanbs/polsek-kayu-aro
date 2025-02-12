<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class LaporanController extends BaseController
{
    public function index()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        $id_user = session()->get('id_user');

        // Pastikan hanya pengguna dengan id_user yang sesuai yang dapat mengakses halaman
        if (session()->get('id_user') != $id_user) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda tidak memiliki akses ke halaman ini');
        }

        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_feedback->getUnreadEntries();
        $unreadCount = $this->m_feedback->countUnreadEntries();
        //END WAJIB//
        $tb_laporan_babin = $this->m_laporan->getAllDataByUser();
        $tb_babin = $this->m_babin->getBabinByUserId();

        $data = [
            'title' => 'Admin | Halaman Laporan',
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_laporan_babin' => $tb_laporan_babin,
            'tb_babin' => $tb_babin
        ];

        return view('admin/laporan/index', $data);
    }

    public function tambah()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        $id_user = session()->get('id_user');

        // Pastikan hanya pengguna dengan id_user yang sesuai yang dapat mengakses halaman
        if (session()->get('id_user') != $id_user) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda tidak memiliki akses ke halaman ini');
        }

        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_feedback->getUnreadEntries();
        $unreadCount = $this->m_feedback->countUnreadEntries();
        //END WAJIB//
        $tb_laporan_babin = $this->m_laporan->getAllDataByUser();
        $tb_babin = $this->m_babin->getBabinByUserId();

        $data = [
            'title' => 'Admin | Halaman Tambah Laporan',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_laporan_babin' => $tb_laporan_babin,
            'tb_babin' => $tb_babin
        ];

        return view('admin/laporan/tambah', $data);
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

        // Ambil data dari request
        $id_babin = $this->request->getPost('id_babin');

        //validasi input 
        if (!$this->validate([
            'id_babin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Nama Babin Yang Bertanggung Jawab !'
                ]
            ],
            'judul_laporan' => [
                'rules' => "required|trim|min_length[5]|max_length[90]",
                'errors' => [
                    'required' => 'Kolom Judul Tidak Boleh Kosong !',
                    'min_length' => 'Judul Tidak Boleh Kurang Dari 5 Karakter !',
                    'max_length' => 'Judul Tidak Boleh Melebihi 90 Karakter !',
                ]
            ],
            'tanggal_laporan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Tanggal Kegiatan Tidak Boleh Kosong !',
                ]
            ],
            'jenis_kegiatan' => [
                'rules' => "required|trim|min_length[5]|max_length[50]",
                'errors' => [
                    'required' => 'Kolom Jenis Kegiatan Tidak Boleh Kosong !',
                    'min_length' => 'Jenis Kegiatan Tidak Boleh Kurang Dari 5 Karakter !',
                    'max_length' => 'Jenis Kegiatan Tidak Boleh Melebihi 50 Karakter !',
                ]
            ],
            'uraian_kegiatan' => [
                'rules' => "required",
                'errors' => [
                    'required' => 'Kolom Isi Kegiatan Tidak Boleh Kosong !',
                ]
            ],
            'hasil_kegiatan' => [
                'rules' => "required",
                'errors' => [
                    'required' => 'Kolom Hasil Kegiatan Tidak Boleh Kosong !',
                ]
            ],
        ])) {
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Upload gambar
        $uploadFotoKegiatan = uploadMultiple('file_foto', 'dokumen/laporan_foto_kegiatan/');


        $this->m_laporan->save([
            'id_babin' => $id_babin,
            'judul_laporan' => $this->request->getPost('judul_laporan'),
            'tanggal_laporan' => $this->request->getPost('tanggal_laporan'),
            'jenis_kegiatan' => $this->request->getPost('jenis_kegiatan'),
            'uraian_kegiatan' => $this->request->getPost('uraian_kegiatan'),
            'hasil_kegiatan' => $this->request->getPost('hasil_kegiatan'),
            'lokasi_kegiatan' => $this->request->getPost('lokasi_kegiatan'),
        ]);

        // Dapatkan ID dari foto laporan yang baru saja disimpan
        $idFotoLaporan = $this->m_laporan->insertID();

        // Simpan data file yang diunggah ke tb_file_foto_laporan dan relasinya ke tb_galeri_laporan
        foreach ($uploadFotoKegiatan as $fileName) {
            $this->db->table('tb_file_foto_laporan')->insert([
                'file_foto' => $fileName,
            ]);

            // Dapatkan ID file foto laporan yang baru saja disimpan
            $idFileFoto = $this->db->insertID();

            // Relasikan file foto dengan foto laporan yang sudah disimpan sebelumnya
            $this->db->table('tb_galeri_laporan')->insert([
                'id_laporan_babin' => $idFotoLaporan,
                'id_file_foto_laporan' => $idFileFoto,
            ]);
        }

        session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan !');

        return redirect()->to('/admin/laporan');
    }

    public function cek_data($id_laporan_babin)
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

        $tb_laporan_babin = $this->m_laporan->getLaporanById();

        // Jika data foto tidak ditemukan, atau id_user tidak sesuai, redirect ke halaman sebelumnya
        if (!$tb_laporan_babin) {
            return redirect()->back()->with('gagal', 'Data Laporan Tidak Ditemukan dan Anda Tidak Memiliki Akses Laporan Tersebut &#128540');
        }

        $data = [
            'title' => 'Admin | Halaman Cek Data Foto',
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_laporan_babin' => $tb_laporan_babin,
            'dokumen' => $this->m_laporan->getDokumenById($id_laporan_babin),
        ];

        return view('admin/laporan/cek_data', $data);
    }

    public function edit($id_laporan_babin)
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        // Pastikan hanya admin yang dapat mengakses halaman ini
        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda tidak memiliki akses ke halaman ini');
        }

        // Ambil data user
        // $id_user = session()->get('id_user');
        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_feedback->getUnreadEntries();
        $unreadCount = $this->m_feedback->countUnreadEntries();
        //END WAJIB//

        // Ambil data laporan berdasarkan id_laporan
        $tb_laporan_babin = $this->m_laporan->getLaporanById($id_laporan_babin);

        // Jika data laporan tidak ditemukan, atau id_user tidak sesuai, redirect ke halaman sebelumnya
        if (!$tb_laporan_babin) {
            return redirect()->back()->with('gagal', 'Data laporan Tidak Ditemukan dan Anda Tidak Memiliki Akses laporan Tersebut &#128540');
        }

        $tb_babin = $this->m_babin->getBabinByUserId();

        $data = [
            'title' => 'Admin | Halaman Cek Data Laporan',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_laporan_babin' => $tb_laporan_babin,
            'tb_babin' => $tb_babin
        ];

        return view('admin/laporan/edit', $data);
    }

    public function update($id_laporan_babin)
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
            'id_babin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Nama Babin Yang Bertanggung Jawab !'
                ]
            ],
            'judul_laporan' => [
                'rules' => "required|trim|min_length[5]|max_length[90]",
                'errors' => [
                    'required' => 'Kolom Judul Tidak Boleh Kosong !',
                    'min_length' => 'Judul Tidak Boleh Kurang Dari 5 Karakter !',
                    'max_length' => 'Judul Tidak Boleh Melebihi 90 Karakter !',
                ]
            ],
            'tanggal_laporan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Tanggal Kegiatan Tidak Boleh Kosong !',
                ]
            ],
            'jenis_kegiatan' => [
                'rules' => "required|trim|min_length[5]|max_length[50]",
                'errors' => [
                    'required' => 'Kolom Jenis Kegiatan Tidak Boleh Kosong !',
                    'min_length' => 'Jenis Kegiatan Tidak Boleh Kurang Dari 5 Karakter !',
                    'max_length' => 'Jenis Kegiatan Tidak Boleh Melebihi 50 Karakter !',
                ]
            ],
            'uraian_kegiatan' => [
                'rules' => "required",
                'errors' => [
                    'required' => 'Kolom Isi Kegiatan Tidak Boleh Kosong !',
                ]
            ],
            'hasil_kegiatan' => [
                'rules' => "required",
                'errors' => [
                    'required' => 'Kolom Hasil Kegiatan Tidak Boleh Kosong !',
                ]
            ],
        ])) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Panggil helper updateFile untuk multiple files
        $uploadedFiles = uploadMultiple('file_foto', 'dokumen/laporan_foto_kegiatan/');

        // Jika ada file yang diunggah, simpan data file yang diunggah ke tb_file_foto dan relasinya ke tb_galeri
        if (!empty($uploadedFiles)) {
            // Hapus file lama jika ada file baru yang diunggah
            $oldFileNames = explode(', ', $this->request->getPost('old_file_foto'));
            foreach ($oldFileNames as $oldFileName) {
                if (file_exists(ROOTPATH . 'public/' . $oldFileName)) {
                    unlink(ROOTPATH . 'public/' . $oldFileName);
                }
            }

            // Hapus relasi lama dari tb_galeri_laporan dan tb_file_foto_laporan
            $this->db->table('tb_galeri_laporan')->where('id_laporan_babin', $id_laporan_babin)->delete();
            $this->db->table('tb_file_foto_laporan')->whereIn('file_foto', $oldFileNames)->delete();

            // Simpan file baru
            foreach ($uploadedFiles as $fileName) {
                $this->db->table('tb_file_foto_laporan')->insert([
                    'file_foto' => $fileName,
                ]);

                // Dapatkan ID file foto yang baru saja disimpan
                $idFileFoto = $this->db->insertID();

                // Relasikan file foto dengan foto yang sudah disimpan sebelumnya
                $this->db->table('tb_galeri_laporan')->insert([
                    'id_laporan_babin' => $id_laporan_babin,
                    'id_file_foto_laporan' => $idFileFoto,
                ]);
            }
        } else {
            // Jika tidak ada file baru yang diunggah, gunakan file lama
            $uploadedFiles = explode(', ', $this->request->getPost('old_file_foto'));
        }

        // Simpan data ke dalam database
        $this->m_laporan->update($id_laporan_babin, [
            'id_babin' => $this->request->getPost('id_babin'),
            'judul_laporan' => $this->request->getPost('judul_laporan'),
            'tanggal_laporan' => $this->request->getPost('tanggal_laporan'),
            'jenis_kegiatan' => $this->request->getPost('jenis_kegiatan'),
            'uraian_kegiatan' => $this->request->getPost('uraian_kegiatan'),
            'hasil_kegiatan' => $this->request->getPost('hasil_kegiatan'),
            'lokasi_kegiatan' => $this->request->getPost('lokasi_kegiatan'),
            'file_foto' => implode(', ', $uploadedFiles) // Simpan nama file baru atau lama ke database
        ]);

        // Set flash message untuk sukses
        session()->setFlashdata('pesan', 'Data Berhasil Diubah !');

        return redirect()->to('/admin/laporan');
    }

    public function delete()
    {
        $id_laporan_babin = $this->request->getPost('id_laporan_babin');

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Dapatkan ID file laporan yang terkait dengan laporan yang akan dihapus
            $dataFiles = $this->m_laporan->getFilesById($id_laporan_babin);

            if (empty($dataFiles)) {
                throw new \Exception('Tidak ada file yang ditemukan untuk id_laporan_babin.');
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

            // Hapus entri dari tb_galeri_laporan
            $this->m_laporan->deleteFilesAndEntries($id_laporan_babin);

            // Hapus entri dari tb_laporan_babin
            $db->table('tb_laporan_babin')->where('id_laporan_babin', $id_laporan_babin)->delete();

            // Hapus entri dari tb_file_foto_laporan yang tidak terkait dengan laporan lain
            $db->table('tb_file_foto_laporan')
                ->whereNotIn('id_file_foto_laporan', function ($builder) use ($id_laporan_babin) {
                    $builder->select('id_file_foto_laporan')
                        ->from('tb_galeri_laporan')
                        ->where('id_laporan_babin !=', $id_laporan_babin);
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
        $id_laporan_babin = $this->request->getPost('id_laporan_babin');

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Dapatkan ID file laporan yang terkait dengan laporan yang akan dihapus
            $dataFiles = $this->m_laporan->getFilesById($id_laporan_babin);

            if (empty($dataFiles)) {
                throw new \Exception('Tidak ada file yang ditemukan untuk id_laporan_babin.');
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

            // Hapus entri dari tb_galeri_laporan
            $this->m_laporan->deleteFilesAndEntries($id_laporan_babin);

            // Hapus entri dari tb_laporan_babin
            $db->table('tb_laporan_babin')->where('id_laporan_babin', $id_laporan_babin)->delete();

            // Hapus entri dari tb_file_foto_laporan yang tidak terkait dengan laporan lain
            $db->table('tb_file_foto_laporan')
                ->whereNotIn('id_file_foto_laporan', function ($builder) use ($id_laporan_babin) {
                    $builder->select('id_file_foto_laporan')
                        ->from('tb_galeri_laporan')
                        ->where('id_laporan_babin !=', $id_laporan_babin);
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
        $totalData = $this->m_laporan->getTotalLaporan();
        // Keluarkan total data sebagai JSON response
        return $this->response->setJSON(['total' => $totalData]);
    }
}
