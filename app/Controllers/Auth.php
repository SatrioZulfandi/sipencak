<?php

namespace App\Controllers;

use App\Models\UserModel;

use App\Controllers\BaseController;
use App\Models\UserptModel;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();
        $modelpt = new UserptModel();
        $userpt = $modelpt->where('username', $username)->first();
        if ($user && password_verify($password, $user['password'])) {
            $session->set('isLoggedIn', true);
            $session->set('username', $user['username']);
            $session->set('nama', $user['nama']);
            $session->set('role', 'operator');
            $session->set('id', $user['id']);
            return redirect()->to('/dashboard');
        } elseif ($userpt && password_verify($password, $userpt['password']) && $userpt['status'] == 'aktif') {
            $session->set('isLoggedIn', true);
            $session->set('username', $userpt['username']);
            $session->set('role', 'admin');
            $session->set('id', $userpt['id']);
            $session->set('pt', $userpt['id_pt']);
            return redirect()->to('/dashboard');
        } else {
            return redirect()->to('/login')->with('error', 'Username atau Password salah.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
