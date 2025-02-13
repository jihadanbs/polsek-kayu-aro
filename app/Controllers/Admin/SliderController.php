<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class SliderController extends BaseController
{
    public function index()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda Tidak Memiliki Akses !');
        }

        $tb_slider_beranda = $this->m_slider->getAllData();
        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_pengaduan->getUnreadEntries();
        $unreadCount = $this->m_pengaduan->countUnreadEntries();
        //END WAJIB//

        $data = [
            'title' => 'Admin | Halaman Slider Beranda',
            'tb_slider_beranda' => $tb_slider_beranda,
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
        ];

        return view('admin/slider/index', $data);
    }

    public function tambah()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda Tidak Memiliki Akses !');
        }

        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_pengaduan->getUnreadEntries();
        $unreadCount = $this->m_pengaduan->countUnreadEntries();
        //END WAJIB//

        $data = [
            'title' => 'Admin | Halaman Tambah Slider Beranda',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
        ];

        return view('admin/slider/tambah', $data);
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

        // Validasi input 

        if (!$this->validate([
            'gambar_slider' => [
                'rules' => 'uploaded[gambar_slider]|mime_in[gambar_slider,image/jpg,image/jpeg,image/png,image/gif]|max_size[gambar_slider,5024]',
                'errors' => [
                    'uploaded' => 'Kolom Gambar Slider harus diisi',
                    'mime_in' => 'File yang diunggah harus berupa gambar dengan format JPG, JPEG, PNG, atau GIF',
                    'max_size' => 'Ukuran file tidak boleh lebih dari 5024 KB',
                ]
            ],
        ])) {
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Panggil helper uploadFile
        $uploadFile = uploadFile('gambar_slider', 'dokumen/slider/');

        if (!$uploadFile) {
            // Jika file tidak berhasil diunggah, tampilkan pesan error
            session()->setFlashdata('error', 'File gagal diunggah. Silakan coba lagi.');
            return redirect()->back()->withInput();
        }

        $this->m_slider->save([
            'gambar_slider' => $uploadFile,
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan &#128077;');

        return redirect()->to('/admin/slider');
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

        $id_slider_beranda = $this->request->getPost('id_slider_beranda');

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $dataFiles = $this->m_slider->getFilesById($id_slider_beranda);

            if (empty($dataFiles)) {
                throw new \Exception('Tidak ada file yang ditemukan untuk id_slider_beranda.');
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

            $this->m_slider->deleteById($id_slider_beranda);

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

    public function edit($id_slider_beranda)
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda Tidak Memiliki Akses !');
        }

        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login');
        }

        $tb_slider_beranda = $this->m_slider->getSlider($id_slider_beranda);
        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_pengaduan->getUnreadEntries();
        $unreadCount = $this->m_pengaduan->countUnreadEntries();
        //END WAJIB//

        $data = [
            'title' => 'Admin | Halaman Edit Data Slider Beranda',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_slider_beranda' => $tb_slider_beranda,
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
        ];

        return view('admin/slider/edit', $data);
    }
    public function update($id_slider_beranda)
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda Tidak Memiliki Akses !');
        }

        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login');
        }

        // Validasi input
        if (!$this->validate([
            'gambar_slider' => [
                'rules' => 'uploaded[gambar_slider]|mime_in[gambar_slider,image/jpg,image/jpeg,image/png,image/gif]|max_size[gambar_slider,5024]',
                'errors' => [
                    'uploaded' => 'Kolom Gambar Slider harus diisi',
                    'mime_in' => 'File yang diunggah harus berupa gambar dengan format JPG, JPEG, PNG, atau GIF',
                    'max_size' => 'Ukuran file tidak boleh lebih dari 5024 KB',
                ]
            ],
        ])) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Panggil helper updateFile
        $oldFileName = $this->request->getVar('old_gambar_slider');
        $newFileName = updateFile('gambar_slider', 'dokumen/slider/', $oldFileName);
        $this->m_slider->save([
            'id_slider_beranda' => $id_slider_beranda,
            'gambar_slider' => $newFileName // Simpan nama file baru ke database
        ]);

        // Set flash message untuk sukses
        session()->setFlashdata('pesan', 'Data Berhasil Diubah &#128077;');

        return redirect()->to('/admin/slider');
    }
}
