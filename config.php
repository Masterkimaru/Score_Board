<?php
// config.php
define('DB_HOST', 'sql200.infinityfree.com');
define('DB_NAME', 'if0_39075284_scoredb');
define('DB_USER', 'if0_39075284');
define('DB_PASS', '43apIqryzyO');

try {
  $pdo = new PDO(
    "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
    DB_USER,
    DB_PASS,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
  );
} catch (PDOException $e) {
  die("DB Connection Failed: " . $e->getMessage());
}