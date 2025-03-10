<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class KategoriController extends BaseController
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

        $tb_kategori_informasi = $this->m_kategori_informasi->getAllDataByUser($id_user);
        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_pengaduan->getUnreadEntries();
        $unreadCount = $this->m_pengaduan->countUnreadEntries();
        //END WAJIB//

        $data = [
            'title' => 'Admin | Halaman Kategori Informasi Publik',
            'tb_kategori_informasi' => $tb_kategori_informasi,
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
        ];

        return view('admin/kategori/index', $data);
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

        // Cek apakah request datang dari AJAX
        if ($this->request->isAJAX()) {
            // Ambil data dari request AJAX
            $nama_kategori = $this->request->getPost('nama_kategori');
            $id_user = session()->get('id_user');

            // Validasi data
            if (empty($nama_kategori)) {
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Nama Kategori harus diisi!']);
            }

            // Cek apakah nama_kategori sudah ada dalam database
            $existing_data = $this->m_kategori_informasi->where('nama_kategori', $nama_kategori)->where('id_user', $id_user)->first();

            if ($existing_data) {
                // Jika nama_kategori sudah ada dalam database, kirim pesan error
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Nama Kategori sudah ada dalam database!']);
            }

            // Simpan data ke dalam database dengan id_user
            $this->m_kategori_informasi->save([
                'nama_kategori' => $nama_kategori,
                'id_user' => $id_user
            ]);

            // Berikan respons jika berhasil
            return $this->response->setJSON(['success' => 'Data berhasil disimpan.']);
        }

        // Jika berhasil disimpan, kembalikan ke halaman yang diinginkan dengan pesan sukses
        return redirect()->to('admin/kategori_informasi');
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

        $id_user = session()->get('id_user');
        $id_kategori_informasi = $this->request->getPost('id_kategori_informasi');

        // Cek apakah kategori informasi tersebut milik user yang sedang login
        $kategori_informasi = $this->m_kategori_informasi->find($id_kategori_informasi);

        if (!$kategori_informasi || $kategori_informasi['id_user'] != $id_user) {
            return $this->response->setJSON(['error' => 'Anda tidak memiliki akses untuk menghapus data ini atau data tidak ditemukan.']);
        }

        if ($this->m_kategori_informasi->delete($id_kategori_informasi)) {
            return $this->response->setJSON(['success' => 'Data berhasil dihapus.']);
        } else {
            return $this->response->setJSON(['error' => 'Gagal menghapus data.']);
        }
    }

    public function simpan_perubahan()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda Tidak Memiliki Akses !');
        }

        $id_user = session()->get('id_user');
        $dataToSave = $this->request->getPost('dataToSave');

        // Looping untuk validasi dan penyimpanan data
        foreach ($dataToSave as $data) {
            $id_kategori_informasi = $data['id_kategori_informasi'];
            $nama_kategori = $data['nama_kategori'];

            // Ambil data kategori informasi yang akan diubah
            $kategori_informasi = $this->m_kategori_informasi->find($id_kategori_informasi);

            // Cek apakah kategori informasi tersebut milik user yang sedang login
            if (!$kategori_informasi || $kategori_informasi['id_user'] != $id_user) {
                return $this->response->setJSON(['success' => false, 'message' => 'Anda tidak memiliki akses untuk mengubah data ini atau data tidak ditemukan.']);
            }

            // Cek apakah nama kategori sudah ada dalam database kecuali dirinya sendiri
            $existingData = $this->m_kategori_informasi
                ->where('nama_kategori', $nama_kategori)
                // ->where('id_kategori_informasi !=', $id_kategori_informasi)
                ->first();

            if ($existingData) {
                // Jika nama_kategori sudah ada di database, kirimkan pesan kesalahan
                return $this->response->setJSON(['success' => false, 'message' => 'Nama kategori sudah ada dalam database!']);
            }

            // Simpan perubahan ke database
            $this->m_kategori_informasi->update($id_kategori_informasi, [
                'nama_kategori' => $nama_kategori
            ]);
        }

        // Kirimkan respons ke client jika berhasil
        return $this->response->setJSON(['success' => true]);
    }
}
