<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEmailFieldsToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'password',
            ],
            'reset_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => true,
                'after'      => 'email',
            ],
            'reset_expired' => [
                'type'   => 'DATETIME',
                'null'   => true,
                'after'  => 'reset_code',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'email');
        $this->forge->dropColumn('users', 'reset_code');
        $this->forge->dropColumn('users', 'reset_expired');
    }
}
