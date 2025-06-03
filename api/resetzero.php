<?php
session_start();
// تعريف دالة PHP
require_once '../php/db.php'; // تأكد من وجود ملف config.php الذي يحتوي على إعدادات الاتصال بقاعدة البيانات
function resetzero() {
    global $pdo; // تأكد إن $pdo معرف
    $pdo->prepare("UPDATE users SET failed_attempts = 0, last_failed_login = NULL WHERE employ_id = ?")
        ->execute([$_SESSION['employ_id']]);
    echo "done";
}

resetzero();

header('Location: ../login');
exit();