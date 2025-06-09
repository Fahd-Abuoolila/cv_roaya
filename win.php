<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link -->
    <link rel='icon' href='img/Roaya_icon.png'>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- title -->
    <title>شركة رؤية باي &nbsp;&nbsp;|&nbsp;&nbsp; تم التسجيل بنجاح </title>
    <style>
        body {
            text-align: center;
            margin-top: 50px;
            font-family: Arial, sans-serif;
            background: #f0f0f0 !important;
        }
        h1 {
            color: green;
            font-size: 2.5em;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px #aaa;
        }
        img {
            width: 200px;
            height: 70vh;
            border: 2px solid #ddd;
            border-radius: 10px;
            box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="alert alert-success" role="alert">
        <h1 class=""> ! تم التسجيل بنجاح </h1>
        <h1 class=""> انظر الى البريد الألكتروني الخاص بك </h1>
    </div>
    <img src="img/m010t0669_a_gift_box_22mar23.jpg" alt="هدية" class="w-75">
    <!-- js -->
    <script src='js/jquery-3.7.0.min.js'></script>
    <script src='js/popper.min.js'></script>
    <script src='js/bootstrap.js'></script>
    <script src='js/all.min.js'></script>
</body>
</html>
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $first_name = $_POST['first_name'];
        $father_name = $_POST['father_name'];
        $grandpa_name = $_POST['grandpa_name'];
        $family_name = $_POST['family_name'];
        $useremail = $_POST['useremail'];

        require_once('php/mail/mail.php');
        $mail->setFrom('fahdabuoolila.px@gmail.com', 'ROAYA PAY');
        $mail->addAddress($useremail); 

        // $mail->SMTPDebug = 3; // أو 3 للحصول على تفاصيل أكثر
        $mail->Subject = 'طلب التوظيف في شركة رؤية باي';
        $mail->Body  = '<html>';
        $mail->Body .= '<head>';
        $mail->Body .= '<style>';
        $mail->Body .= "@import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap');";
        $mail->Body .= '</style>';
        $mail->Body .= '</style>';
        $mail->Body .= '</head>';
        $mail->Body .= '<body style="direction: rtl;">';
        $mail->Body .= '<h2>السلام عليكم</h2>';
        $mail->Body .= '<br>';
        $mail->Body .= '<div style="font-size: 18px; font-weight: 900;">';
        $mail->Body .= '<h3>نرحب بكم في شركة رؤية باي لحلول السداد و البرمجيات</h3>';
        $mail->Body .= '<p>الأستاذ/ة</p>' . '<p>'. $first_name . ' ' . $father_name . ' ' . $grandpa_name . ' ' . $family_name .'</p>';
        $mail->Body .= 'تم استلام طلب التوظيف الخاص بك بنجاح.<br>';
        $mail->Body .= 'سيتم الرد عليك قريبأ و انتظر مكالمة منا او رسالة بريد الكتروني او رسالة على تطبيق الواتساب<br>';
        $mail->Body .= 'شكراً لسيادتكم.<br>';
        $mail->Body .= ' </div>';
        $mail->Body .= '<img src="https://fahd-abuoolila.github.io/roaya_photo/The_End_Logo.png" alt="Roaya Pay" style="width: 100%; height: auto;">';
        $mail->Body .= '</body>';
        $mail->Body .= '</html>';
        $mail->send();
    }
?>