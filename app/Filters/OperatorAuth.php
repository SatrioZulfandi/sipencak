<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class OperatorAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Cek login
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Cek role
        if ($session->get('role') !== 'operator') {
            return redirect()->to('/home');
        }

        // Lolos semua cek, lanjut
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu digunakan di sini
    }
}
