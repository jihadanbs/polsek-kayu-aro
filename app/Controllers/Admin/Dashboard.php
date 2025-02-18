<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        // WAJIB //
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_pengaduan->getUnreadEntries();
        $unreadCount = $this->m_pengaduan->countUnreadEntries();
        // END WAJIB //

        $data = [
            'title' => 'Admin | Dashboard',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            // WAJIB //
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            // END WAJIB //
        ];

        // Jika pengguna tidak login dan mencoba mengakses halaman admin dashboard, arahkan kembali dan beri pesan
        if (!$this->session->has('islogin') || session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        } else {
            return view('admin/dashboard/index', $data); // Tampilkan dashboard jika pengguna sudah login
        }
    }
}
