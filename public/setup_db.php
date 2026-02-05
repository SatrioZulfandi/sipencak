<?php
// Skript untuk update database manual
// Akses via: http://localhost:8080/setup_db.php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'sipencakdatabase'; // Sesuaikan dengan .env jika beda

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

echo "<h2>Database Setup Tool</h2>";

// 1. Cek Tabel activity_logs
$sql = "CREATE TABLE IF NOT EXISTS activity_logs (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NULL,
    username VARCHAR(100) NOT NULL,
    role VARCHAR(50) NULL,
    action VARCHAR(50) NOT NULL,
    menu VARCHAR(50) NOT NULL,
    description TEXT NULL,
    ip_address VARCHAR(45) NOT NULL,
    created_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

if ($conn->query($sql) === TRUE) {
    echo "✅ Tabel activity_logs aman.<br>";
} else {
    echo "❌ Error creating table: " . $conn->error . "<br>";
}

// 2. Cek kolom user_agent
$check = $conn->query("SHOW COLUMNS FROM activity_logs LIKE 'user_agent'");
if ($check->num_rows == 0) {
    // Kolom belum ada, tambahkan
    $sql = "ALTER TABLE activity_logs ADD COLUMN user_agent VARCHAR(255) NULL AFTER ip_address";
    if ($conn->query($sql) === TRUE) {
        echo "✅ Kolom 'user_agent' berhasil ditambahkan.<br>";
    } else {
        echo "❌ Error adding column: " . $conn->error . "<br>";
    }
} else {
    echo "✅ Kolom 'user_agent' sudah ada.<br>";
}

echo "<hr>Selesai. Silakan hapus file ini jika sudah tidak diperlukan.";
$conn->close();
?>
