<?php
$host = 'localhost';
$db   = 'sipencakdatabase';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    // Hash password '123456'
    $hash = password_hash('123456', PASSWORD_DEFAULT);
    
    // Reset User (Operator) 'admin'
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE username = 'admin'");
    $stmt->execute([$hash]);
    echo "Updated users (Operator 'admin') password.<br>";
    
    // Reset UserPT (Admin) 'user'
    $stmt2 = $pdo->prepare("UPDATE userpts SET password = ? WHERE username = 'user'");
    $stmt2->execute([$hash]);
    echo "Updated userpts (Admin 'user') password.<br>";
    
    echo "SUCCESS";
    
} catch (\PDOException $e) {
    echo "Failed: " . $e->getMessage();
}
