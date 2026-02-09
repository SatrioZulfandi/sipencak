<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePtsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode_pt' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'perguruan_tinggi' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'aipt' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('pts', true);
    }

    public function down()
    {
        $this->forge->dropTable('pts', true);
    }
}
