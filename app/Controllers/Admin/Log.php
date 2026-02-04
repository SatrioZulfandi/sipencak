<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LogModel;

class Log extends BaseController
{
    public function index()
    {
        // SELF-HEALING: Force Create Table if not exists
        $db = \Config\Database::connect();
        $db->query("CREATE TABLE IF NOT EXISTS activity_logs (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            user_id INT(11) NULL,
            username VARCHAR(100) NOT NULL,
            role VARCHAR(50) NULL,
            action VARCHAR(50) NOT NULL,
            menu VARCHAR(50) NOT NULL,
            description TEXT NULL,
            ip_address VARCHAR(45) NOT NULL,
            created_at DATETIME NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

        $model = new LogModel();
        
        $data = [
            'data'    => $model->orderBy('created_at', 'DESC')->paginate(20, 'default'),
            'pager'   => $model->pager,
            'title'   => 'Log Aktivitas Admin'
        ];

        return view('admin/log_list', $data);
    }
}
