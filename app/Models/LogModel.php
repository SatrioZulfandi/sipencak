<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table = 'activity_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id', 'username', 'role', 'action', 'menu', 'description', 'ip_address', 'user_agent', 'created_at'
    ];
    protected $useTimestamps = false; 

    // Helper to log activity
    public function log($action, $menu, $desc)
    {
        $session = session();
        $request = \Config\Services::request();
        
        $this->insert([
            'user_id'     => $session->get('id') ?? 0,
            'username'    => $session->get('username') ?? 'System',
            'role'        => $session->get('role') ?? 'guest',
            'action'      => $action,
            'menu'        => $menu,
            'description' => $desc,
            'ip_address'  => $request->getIPAddress(),
            'user_agent'  => (string)$request->getUserAgent(),
            'created_at'  => date('Y-m-d H:i:s')
        ]);
    }
}
