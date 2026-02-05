<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LogModel;

class Log extends BaseController
{
    public function index()
    {
        $model = new LogModel();

        // FILTER: Hanya tampilkan log milik user yang sedang login
        $userId = session()->get('id');
        $role   = session()->get('role');

        $data = [
            'data'    => $model->where('user_id', $userId)
                               ->where('role', $role)
                               ->orderBy('created_at', 'DESC')
                               ->paginate(20, 'default'),
            'pager'   => $model->pager,
            'title'   => 'Log Aktivitas Saya'
        ];

        return view('admin/log_list', $data);
    }
}
