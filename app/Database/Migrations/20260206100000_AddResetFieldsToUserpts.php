<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddResetFieldsToUserpts extends Migration
{
    public function up()
    {
        $this->forge->addColumn('userpts', [
            'reset_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => true,
                'after'      => 'status',
            ],
            'reset_expired' => [
                'type'  => 'DATETIME',
                'null'  => true,
                'after' => 'reset_code',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('userpts', ['reset_code', 'reset_expired']);
    }
}
