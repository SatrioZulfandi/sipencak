<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ResetAdmin extends Seeder
{
    public function run()
    {
        // Reset password for username 'user' (Role Admin) to '123456'
        $this->db->table('userpts')->where('username', 'user')->update([
            'password' => password_hash('123456', PASSWORD_DEFAULT)
        ]);
        
        // Also reset for 'admin' (Role Operator) just in case
        $this->db->table('users')->where('username', 'admin')->update([
            'password' => password_hash('123456', PASSWORD_DEFAULT)
        ]);
    }
}
