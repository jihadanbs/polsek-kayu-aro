<?php

namespace App\Controllers;

class RoleController extends BaseController
{
    protected $session;
    public function index()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        if (session()->get('id_jabatan') == 1) {
            return redirect()->to('admin/dashboard');
        }

        if (session()->get('id_jabatan') == 2) {
            return redirect()->to('staff/dashboard');
        }
    }
}
