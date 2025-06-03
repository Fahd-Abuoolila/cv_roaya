<?php
    $host = 'localhost';
    $db = 'roaya_form_cv';
    $user = 'root';
    $pass = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("خطأ في الاتصال: " . $e->getMessage());
    }
?>
