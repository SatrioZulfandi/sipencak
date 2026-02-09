<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProdisTable extends Migration
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
            'id_pt' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'kode_prodi' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'nama_prodi' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('prodis', true);
    }

    public function down()
    {
        $this->forge->dropTable('prodis', true);
    }
}
