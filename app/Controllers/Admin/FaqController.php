<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class FaqController extends BaseController
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

        $tb_faq = $this->m_faq->getAllData();
        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_pengaduan->getUnreadEntries();
        $unreadCount = $this->m_pengaduan->countUnreadEntries();
        //END WAJIB//

        $data = [
            'title' => 'Admin | Halaman FAQ',
            'tb_faq' => $tb_faq,
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
        ];

        return view('admin/faq/index', $data);
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
            'title' => 'Admin | Halaman Tambah FAQ',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
        ];

        return view('admin/faq/tambah', $data);
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

        // Ambil data dari request
        $pertanyaan = $this->request->getPost('pertanyaan');
        $jawaban = $this->request->getPost('jawaban');

        //validasi input 
        if (!$this->validate([
            'pertanyaan' => [
                'rules' => "required|trim|min_length[5]",
                'errors' => [
                    'required' => 'Kolom Pertanyaan Tidak Boleh Kosong !',
                    'min_length' => 'Pertanyaan tidak boleh kurang dari 5 karakter !'
                ]
            ],
            'jawaban' => [
                'rules' => "required|trim|min_length[5]",
                'errors' => [
                    'required' => 'Kolom Jawaban Tidak Boleh Kosong !',
                    'min_length' => 'Jawaban tidak boleh kurang dari 5 karakter !'
                ]
            ],

        ])) {
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        $this->m_faq->save([
            'pertanyaan' => $pertanyaan,
            'jawaban' => $jawaban,
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan !');

        return redirect()->to('/admin/faq');
    }

    public function delete($id_faq)
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda Tidak Memiliki Akses !');
        }

        // Cek apakah metode yang digunakan adalah DELETE
        if ($this->request->getMethod() === 'delete') {
            // Hapus data berdasarkan ID yang diterima di URL
            if ($this->m_faq->delete($id_faq)) {
                return $this->response->setJSON(['success' => 'Data berhasil dihapus']);
            } else {
                return $this->response->setJSON(['error' => 'Gagal menghapus data']);
            }
        }

        return $this->response->setJSON(['error' => 'Metode tidak diizinkan']);
    }


    public function edit($id_faq)
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda Tidak Memiliki Akses !');
        }

        $tb_faq = $this->m_faq->getFaq($id_faq);
        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_pengaduan->getUnreadEntries();
        $unreadCount = $this->m_pengaduan->countUnreadEntries();
        //END WAJIB//

        $data = [
            'title' => 'Admin | Halaman Edit FAQ',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_faq' => $tb_faq,
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
        ];

        return view('admin/faq/edit', $data);
    }

    public function update($id_faq)
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
            'pertanyaan' => [
                'rules' => "required|min_length[5]",
                'errors' => [
                    'required' => 'Kolom Pertanyaan Tidak Boleh Kosong !',
                    'min_length' => 'Pertanyaan tidak boleh kurang dari 5 karakter !'
                ]
            ],
            'jawaban' => [
                'rules' => "required|min_length[5]",
                'errors' => [
                    'required' => 'Kolom Jawaban Tidak Boleh Kosong !',
                    'min_length' => 'Jawaban tidak boleh kurang dari 5 karakter !'
                ]
            ],

        ])) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());

            return redirect()->back()->withInput();
        }

        // Simpan data ke dalam database
        $this->m_faq->update($id_faq, [
            'pertanyaan' => $this->request->getPost('pertanyaan'),
            'jawaban' => $this->request->getPost('jawaban'),
        ]);

        // Set flash message untuk sukses
        session()->setFlashdata('pesan', 'Data Berhasil Diubah !');

        return redirect()->to('/admin/faq');
    }

    public function cek_data($id_faq)
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
            'title' => 'Admin | Halaman Cek Data FAQ',
            'tb_faq' => $this->m_faq->getAll($id_faq),
            'id_faq' => $this->m_faq->getid($id_faq),
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
        ];

        // print_r($data['tb_faq']); // Cetak nilai tb_faq untuk debugging

        return view('admin/faq/cek_data', $data);
    }
}
