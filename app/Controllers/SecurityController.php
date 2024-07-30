<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class SecurityController extends Controller
{
    public function getNewCSRFToken()
    {
        // Hasilkan token CSRF baru
        $csrfHash = csrf_hash();

        // Kembalikan token CSRF dalam format JSON
        return $this->response->setJSON(['token' => $csrfHash]);
    }
}
