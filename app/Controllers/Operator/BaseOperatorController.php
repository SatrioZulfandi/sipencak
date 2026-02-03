<?php

namespace App\Controllers\Operator;

use App\Controllers\BaseController;

class BaseOperatorController extends BaseController
{
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        log_message('debug', 'BaseOperatorController dijalankan');
        if (!session()->get('isLoggedIn')) {
            redirect()->to('/login')->send();
            exit();
        }elseif(session()->get('role') != 'operator'){
            return redirect()->to('/home');
        }
    }
}
