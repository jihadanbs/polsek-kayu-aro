<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class InformasiController extends BaseController
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
        $unread = $this->m_pengaduan->getUnreadEntries();
        $unreadCount = $this->m_pengaduan->countUnreadEntries();
        //END WAJIB//

        $tb_informasi_edukasi = $this->m_informasi->getAllDataByUser($id_user);
        $tb_kategori_informasi = $this->m_kategori_informasi->getAllDataByUser($id_user);

        $data = [
            'title' => 'Admin | Halaman Informasi Edukasi',
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_informasi_edukasi' => $tb_informasi_edukasi,
            'tb_kategori_informasi' => $tb_kategori_informasi
        ];

        return view('admin/informasi/index', $data);
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
        $unread = $this->m_pengaduan->getUnreadEntries();
        $unreadCount = $this->m_pengaduan->countUnreadEntries();
        //END WAJIB//

        $tb_informasi_edukasi = $this->m_informasi->getAllDataByUser($id_user);
        $tb_kategori_informasi = $this->m_kategori_informasi->getAllDataByUser($id_user);

        $data = [
            'title' => 'Admin | Halaman Tambah Informasi-Edukasi',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_informasi_edukasi' => $tb_informasi_edukasi,
            'tb_kategori_informasi' => $tb_kategori_informasi
        ];

        return view('admin/informasi/tambah', $data);
    }

    public function save()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda Tidak Memiliki Akses !');
        }

        //validasi input 
        $rules = [
            'id_kategori_informasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Nama Kategori Informasi !'
                ]
            ],
            'judul' => [
                'rules' => "required|is_unique_judul[tb_informasi_edukasi,id_kategori_informasi]|trim|min_length[5]",
                'errors' => [
                    'required' => 'Kolom Judul Tidak Boleh Kosong !',
                    'is_unique_judul' => 'Judul Sudah Terdaftar Untuk Nama Kategori Informasi Yang Sama, Silahkan Ganti Judul Lainnya !',
                    'min_length' => 'Judul Tidak Boleh Kurang Dari 5 Karakter !',
                ]
            ],
            'konten' => [
                'rules' => 'required|trim|min_length[5]',
                'errors' => [
                    'required' => 'Kolom Isi Konten Tidak Boleh Kosong !',
                    'min_length' => 'Isi Konten tidak boleh kurang dari 5 karakter !',
                ]
            ],
            'tanggal_diterbitkan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Masukkan Tanggal Konten !'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Masukkan Nama Si Penulis Konten !'
                ]
            ],
            'profile_penulis' => [
                'rules' => 'uploaded[profile_penulis]|max_size[profile_penulis,2048]|is_image[profile_penulis]',
                'errors' => [
                    'uploaded' => 'Foto Profile Penulis Informasi Wajib Diunggah !',
                    'max_size' => 'Ukuran Foto Tidak Boleh Lebih Dari 2MB !',
                    'is_image' => 'File Harus Berupa Gambar (JPEG, PNG, dll) !',
                ],
            ],
            'gambar' => [
                'rules' => 'uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]',
                'errors' => [
                    'uploaded' => 'Gambar Informasi Wajib Diunggah !',
                    'max_size' => 'Ukuran Gambar Tidak Boleh Lebih Dari 2MB !',
                    'is_image' => 'File Harus Berupa Gambar (JPEG, PNG, dll) !',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            // Kirim kembali ke form dengan error validasi
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $id_user = session()->get('id_user');

        $this->m_informasi->save([
            'id_user' => $id_user,
            'id_kategori_informasi' => $this->request->getPost('id_kategori_informasi'),
            'judul' => $this->request->getPost('judul'),
            'konten' => $this->request->getPost('konten'),
            'penulis' => $this->request->getPost('penulis'),
            'tanggal_diterbitkan' => $this->request->getPost('tanggal_diterbitkan'),
            'gambar' => uploadFileUmum('gambar', 'dokumen/gambar-edukasi/'),
            'profile_penulis' => uploadFileUmum('profile_penulis', 'dokumen/profile-penulis/'),
            'slug' => url_title($this->request->getPost('judul'), '-', true)
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan !');

        return redirect()->to('/admin/informasi');
    }

    public function delete()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda Tidak Memiliki Akses !');
        }

        $id_informasi = $this->request->getPost('id_informasi');

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $dataFiles = $this->m_informasi->getFilesById($id_informasi);

            if (empty($dataFiles)) {
                throw new \Exception('Tidak ada file yang ditemukan untuk id_informasi.');
            }

            foreach ($dataFiles[0] as $fileColumn => $filePath) {
                if (!empty($filePath)) {
                    $fullFilePath = ROOTPATH . 'public/' . $filePath;
                    if (is_file($fullFilePath)) {
                        if (!unlink($fullFilePath)) {
                            throw new \Exception('Gagal menghapus file: ' . $fullFilePath);
                        }
                    }
                }
            }

            $this->m_informasi->deleteById($id_informasi);

            $db->transComplete();

            if ($db->transStatus() === false) {
                $db->transRollback();
                return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data']);
            }

            $db->transCommit();
            return $this->response->setJSON(['status' => 'success', 'message' => 'Semua file dan data berhasil dihapus']);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data', 'error' => $e->getMessage()]);
        }
    }

    public function delete2()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda Tidak Memiliki Akses !');
        }

        $id_informasi = $this->request->getPost('id_informasi');

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $dataFiles = $this->m_informasi->getFilesById($id_informasi);

            if (empty($dataFiles)) {
                throw new \Exception('Tidak ada file yang ditemukan untuk id_informasi.');
            }

            foreach ($dataFiles[0] as $fileColumn => $filePath) {
                if (!empty($filePath)) {
                    $fullFilePath = ROOTPATH . 'public/' . $filePath;
                    if (is_file($fullFilePath)) {
                        if (!unlink($fullFilePath)) {
                            throw new \Exception('Gagal menghapus file: ' . $fullFilePath);
                        }
                    }
                }
            }

            $this->m_informasi->deleteById($id_informasi);

            $db->transComplete();

            if ($db->transStatus() === false) {
                $db->transRollback();
                return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data']);
            }

            $db->transCommit();
            return $this->response->setJSON(['status' => 'success', 'message' => 'Semua file dan data berhasil dihapus']);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data', 'error' => $e->getMessage()]);
        }
    }

    public function edit($id_informasi)
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login');
        }

        // Ambil id_user dari session
        $id_user = session()->get('id_user');

        // Pastikan data informasi milik user yang login
        $tb_informasi_edukasi = $this->m_informasi->where('id_user', $id_user)->find($id_informasi);
        $tb_kategori_informasi = $this->m_kategori_informasi->getAllDataByUser($id_user);

        if (!$tb_informasi_edukasi) {
            return redirect()->back()->with('gagal', 'Data informasi tidak ditemukan atau Anda tidak memiliki akses');
        }

        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_pengaduan->getUnreadEntries();
        $unreadCount = $this->m_pengaduan->countUnreadEntries();
        //END WAJIB//

        $data = [
            'title' => 'Admin | Halaman Edit Informasi-Edukasi',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_informasi_edukasi' => $tb_informasi_edukasi,
            'tb_kategori_informasi' => $tb_kategori_informasi,
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
        ];

        return view('admin/informasi/edit', $data);
    }
    public function update($id_informasi)
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda Tidak Memiliki Akses !');
        }

        //validasi input 
        $rules = [
            'id_kategori_informasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Nama Kategori Informasi !'
                ]
            ],
            'judul' => [
                'rules' => "required|trim|min_length[5]",
                'errors' => [
                    'required' => 'Kolom Judul Tidak Boleh Kosong !',
                    'min_length' => 'Judul Tidak Boleh Kurang Dari 5 Karakter !',
                ]
            ],
            'konten' => [
                'rules' => 'required|trim|min_length[5]',
                'errors' => [
                    'required' => 'Kolom Isi Konten Tidak Boleh Kosong !',
                    'min_length' => 'Isi Konten tidak boleh kurang dari 5 karakter !',
                ]
            ],
            'tanggal_diterbitkan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Masukkan Tanggal Konten !'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Masukkan Nama Si Penulis Konten !'
                ]
            ],
            'profile_penulis' => [
                'rules' => 'max_size[profile_penulis,2048]|is_image[profile_penulis]',
                'errors' => [
                    'max_size' => 'Ukuran Foto Tidak Boleh Lebih Dari 2MB !',
                    'is_image' => 'File Harus Berupa Gambar (JPEG, PNG, dll) !',
                ],
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,2048]|is_image[gambar]',
                'errors' => [
                    'max_size' => 'Ukuran Gambar Tidak Boleh Lebih Dari 2MB !',
                    'is_image' => 'File Harus Berupa Gambar (JPEG, PNG, dll) !',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            // Kirim kembali ke form dengan error validasi
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Handle file upload
        $oldFileName = $this->request->getPost('current_gambar'); // Nama file lama dari input hidden
        $oldFileProfile = $this->request->getPost('current_profile_penulis'); // Nama file lama dari input hidden

        $id_user = session()->get('id_user');

        $this->m_informasi->update($id_informasi, [
            'id_user' => $id_user,
            'judul' => $this->request->getPost('judul'),
            'konten' => $this->request->getPost('konten'),
            'penulis' => $this->request->getPost('penulis'),
            'slug' => url_title($this->request->getPost('judul'), '-', true),
            'tanggal_diterbitkan' => $this->request->getPost('tanggal_diterbitkan'),
            'id_kategori_informasi' => $this->request->getPost('id_kategori_informasi'),
            'gambar' => updateFileUmum('gambar', 'dokumen/gambar-edukasi/', $oldFileName),
            'profile_penulis' => updateFileUmum('profile_penulis', 'dokumen/profile-penulis/', $oldFileProfile)
        ]);

        // Set flash message untuk sukses
        session()->setFlashdata('pesan', 'Data Berhasil Diubah !');

        return redirect()->to('/admin/informasi');
    }

    public function cek_data($id_informasi)
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        // Cek apakah user adalah admin
        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login');
        }

        // Ambil id_user dari session
        $id_user_session = session()->get('id_user');

        // Ambil informasi berdasarkan id_informasi
        $informasi = $this->m_informasi->getInformasi($id_informasi);
        $tb_kategori_informasi = $this->m_kategori_informasi->getAllData();

        // Cek apakah informasi ada dan id_user yang login sama dengan id_user dari informasi
        if (!$informasi || $informasi->id_user != $id_user_session) {
            return redirect()->back()->with('gagal', 'Data informasi tidak ditemukan atau Anda tidak memiliki akses');
        }

        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_pengaduan->getUnreadEntries();
        $unreadCount = $this->m_pengaduan->countUnreadEntries();
        //END WAJIB//

        $data = [
            'title' => 'Admin | Halaman Cek Data',
            'tb_informasi_edukasi' => [$informasi], // Pastikan dikirim sebagai array
            'dokumen' => $informasi->additional_data,
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_kategori_informasi' => $tb_kategori_informasi
        ];

        return view('admin/informasi/cek_data', $data);
    }

    public function totalData($id_user)
    {
        $totalData = $this->m_informasi->getTotalInformasi($id_user);
        // Keluarkan total data sebagai JSON response
        return $this->response->setJSON(['total' => $totalData]);
    }
}
