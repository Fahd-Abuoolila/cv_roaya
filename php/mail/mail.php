<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'fahdabuoolila.px@gmail.com';
    $mail->Password   = 'sinajguhwnpjmdhb';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL
    $mail->Port       = 465;

    // المرسل والمستلم
    $mail->setFrom('your_email@gmail.com', 'اسم المرسل');
    $mail->addAddress('receiver@example.com', 'اسم المستقبل'); 
    // $mail->addAttachment('/path/to/file.pdf', 'اسم_المرفق.pdf');

    $mail->isHTML(true);        //Set email format to HTML
    $mail->CharSet = "UTF-8"; 

    echo '✅ تم إرسال الرسالة بنجاح';
} catch (Exception $e) {
    echo "❌ فشل في الإرسال: {$mail->ErrorInfo}";
}
