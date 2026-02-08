<?php
// Simple PDO migration script

$host = 'localhost';
$db   = 'sipencakdatabase';
$user = 'root';
$pass = ''; // Default XAMPP password
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    echo "Connected to database successfully.\n";
    
    // Select data to migrate
    $stmt = $pdo->query("SELECT id, id_pencairan, status_pengajuan FROM mahasiswas WHERE id_pencairan IS NOT NULL");
    $mahasiswas = $stmt->fetchAll();
    
    echo "Found " . count($mahasiswas) . " records to migrate.\n";
    
    $count = 0;
    
    $insertStmt = $pdo->prepare("INSERT IGNORE INTO pengajuan_mahasiswa (id_mahasiswa, id_pencairan, status_pengajuan, created_at) VALUES (?, ?, ?, NOW())");
    
    foreach ($mahasiswas as $mhs) {
        if ($insertStmt->execute([$mhs['id'], $mhs['id_pencairan'], $mhs['status_pengajuan']])) {
            if ($insertStmt->rowCount() > 0) {
                $count++;
            }
        }
    }
    
    echo "Migration completed. Migrated $count records.\n";

} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
