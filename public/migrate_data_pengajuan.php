<?php

// Path: public/migrate_data_pengajuan.php

require_once '../app/Config/Paths.php';
require_once '../app/Config/Constants.php';

// Bootstrap CodeIgniter
$paths = new Config\Paths();
require_once $paths->systemDirectory . '/Common.php';

// Helper to get DB connection
use Config\Database;

try {
    $db = Database::connect();
    
    echo "Starting migration of data from 'mahasiswas' to 'pengajuan_mahasiswa'...\n";
    
    // 1. Ambil data mahasiswa yang punya id_pencairan (artinya sudah pernah diajukan)
    $query = $db->query("SELECT id, id_pencairan, status_pengajuan FROM mahasiswas WHERE id_pencairan IS NOT NULL");
    $mahasiswas = $query->getResultArray();
    
    echo "Found " . count($mahasiswas) . " records to migrate.\n";
    
    $count = 0;
    $errors = 0;
    
    foreach ($mahasiswas as $mhs) {
        // Cek apakah sudah ada di tabel baru (menghindari duplikat jika script dijalankan ulang)
        $exists = $db->table('pengajuan_mahasiswa')
            ->where('id_mahasiswa', $mhs['id'])
            ->where('id_pencairan', $mhs['id_pencairan'])
            ->countAllResults();
            
        if ($exists == 0) {
            $data = [
                'id_mahasiswa' => $mhs['id'],
                'id_pencairan' => $mhs['id_pencairan'],
                'status_pengajuan' => $mhs['status_pengajuan'],
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            if ($db->table('pengajuan_mahasiswa')->insert($data)) {
                $count++;
            } else {
                $errors++;
                echo "Failed to migrate mahasiswa ID: " . $mhs['id'] . "\n";
            }
        }
    }
    
    echo "Migration completed.\n";
    echo "Successfully migrated: $count records.\n";
    if ($errors > 0) {
        echo "Errors: $errors records.\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
