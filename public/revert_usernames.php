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
    
    // 1. Rename 'admin' (currently in userpts) back to 'user'
    $stmt = $pdo->prepare("UPDATE userpts SET username = 'user' WHERE username = 'admin'");
    $stmt->execute();
    echo "Reverted PT Admin (userpts): admin -> user.<br>";
    
    // 2. Rename 'operator' (currently in users) back to 'admin'
    $stmt2 = $pdo->prepare("UPDATE users SET username = 'admin' WHERE username = 'operator'");
    $stmt2->execute();
    echo "Reverted System Admin (users): operator -> admin.<br>";
    
    echo "SUCCESS";
    
} catch (\PDOException $e) {
    echo "Failed: " . $e->getMessage();
}
