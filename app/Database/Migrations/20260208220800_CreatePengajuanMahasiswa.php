<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengajuanMahasiswa extends Migration
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
            'id_mahasiswa' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'id_pencairan' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'status_pengajuan' => [
                'type'       => 'ENUM',
                'constraint' => ['Proses Pengajuan', 'Diajukan'],
                'default'    => 'Proses Pengajuan',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('id_mahasiswa');
        $this->forge->addKey('id_pencairan');
        // Unique constraint: 1 mahasiswa hanya bisa 1x per pencairan
        $this->forge->addUniqueKey(['id_mahasiswa', 'id_pencairan'], 'unique_mhs_pencairan');

        $this->forge->createTable('pengajuan_mahasiswa');
    }

    public function down()
    {
        $this->forge->dropTable('pengajuan_mahasiswa');
    }
}
