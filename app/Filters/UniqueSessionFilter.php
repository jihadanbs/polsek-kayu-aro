<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\UserModel;

class UniqueSessionFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $userModel = new UserModel();
        $userId = $session->get('id_user');
        $sessionToken = $session->get('session_token');

        if ($userId) {
            $user = $userModel->find($userId);

            if ($user && $user['session_token'] !== $sessionToken) {
                $session->destroy();
                return redirect()->to('/authentication/login')->with('gagal', 'Anda telah login di tab lain.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing here
    }
}
