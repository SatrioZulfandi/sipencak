<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePencairansTable extends Migration
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
            'periode' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'kategori_penerima' => [
                'type'       => 'ENUM',
                'constraint' => ['Skema Pembiayaan Penuh', 'Skema Biaya Pendidikan'],
            ],
            'no_sk' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'semester' => [
                'type'       => 'ENUM',
                'constraint' => ['Ganjil', 'Genap'],
            ],
            'sptjm' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'sk_penetapan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'sk_pembatalan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'berita_acara' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Ajukan Mahasiswa', 'Finalisasi', 'Diproses', 'Selesai', 'Ditolak'],
                'default'    => 'Ajukan Mahasiswa',
            ],
            'alasan_tolak' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'tanggal_entry' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'tanggal_pengajuan' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'jumlah_mahasiswa' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('pencairans', true);
    }

    public function down()
    {
        $this->forge->dropTable('pencairans', true);
    }
}
