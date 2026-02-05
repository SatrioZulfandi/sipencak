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
    
    // 1. Rename Operator: 'admin' -> 'operator' (Table: users)
    $stmt = $pdo->prepare("UPDATE users SET username = 'operator' WHERE username = 'admin'");
    $stmt->execute();
    $countOp = $stmt->rowCount();
    echo "Renamed Operator (users): $countOp rows affected (admin -> operator).<br>";
    
    // 2. Rename Admin: 'user' -> 'admin' (Table: userpts)
    $stmt2 = $pdo->prepare("UPDATE userpts SET username = 'admin' WHERE username = 'user'");
    $stmt2->execute();
    $countAdm = $stmt2->rowCount();
    echo "Renamed Admin (userpts): $countAdm rows affected (user -> admin).<br>";
    
    echo "SUCCESS";
    
} catch (\PDOException $e) {
    echo "Failed: " . $e->getMessage();
}
