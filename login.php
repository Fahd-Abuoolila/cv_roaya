<?php
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");
    header("Expires: 0");
    include 'php/session.php';

    require 'php/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='icon' href='img/Roaya_icon.png'>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
    <title>Roaya Pay | رؤية باي</title>
</head>
<body>
    <div class="overflow-screen">
        <div class='alert alert-info' role='alert' style='text-align:center; direction:rtl; '>
            <h4 style='color:rgb(245, 74, 74);'> تحذير ! </h4>
            <h6>الرجاء عدم اعادة تحميل للصفحة او الخروج منها حتى يتم رفع الحظر</h6>
        </div>"
    </div>
    <?php
        include 'inc/config.php';
        include 'php/db.php';

        function isAccountLocked($user) {
            if ($user['failed_attempts'] >= 5) {
                $last = strtotime($user['last_failed_login']);
                if (time() - $last < .5 * 60) { 
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        @$emailfalse = '';
        @$passfalse = '';

        @$email=$_POST['email'];
        @$password=$_POST['password'];

        // التحقق من إعادة تعيين المحاولات بعد 15 دقيقة
        // if (isset($user['last_failed_login']) && $user['last_failed_login']) {
        //     if (time() > strtotime($user['last_failed_login']) + 15 * 60) {
        //         $pdo->prepare("UPDATE users SET failed_attempts = 0, last_failed_login = NULL WHERE employ_id = ?")
        //             ->execute([$user['employ_id']]);
        //         // إعادة تحميل الصفحة تلقائياً بعد فك الحظر
        //         echo "<script>
        //             setTimeout(function() {
        //                 location.reload();
        //             }, 500); // إعادة تحميل الصفحة فوراً بعد فك الحظر
        //         </script>";
        //     }
        // }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_POST['submit'])){
                // $timeas24 = '';
                // echo "
                //     <script>
                //         const now = new Date();
                //         const hours = String(now.getHours()).padStart(2, '0');
                //         const minutes = String(now.getMinutes()).padStart(2, '0');
                //         const seconds = String(now.getSeconds()).padStart(2, '0');
                //         const currentTime24 = hours + ':' + minutes + ':' + seconds;
                //     </script>
                // ";
                    // $timeas24 = currentTime24;
                        

                
                $stmt = $pdo->prepare("SELECT * FROM users WHERE employ_email = :email");
                $stmt->execute(['email' => $email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    $_SESSION['employ_id'] = $user['employ_id'];
                    if ($password === $user['employ_password']) {          
                        // إعادة تعيين المحاولات الفاشلة
                        if ($user['last_failed_login'] == null || $user['failed_attempts'] <= 5) {
                            $pdo->prepare("UPDATE users SET failed_attempts = 0, last_failed_login = NULL WHERE employ_id = ?")
                                ->execute([$user['employ_id']]);
                            if($user['active'] == 'true'){
                                $_SESSION['employ'] = [
                                    'employ_id' => $user['employ_id'],
                                    'employ_name' => $user['employ_name'],
                                    'email' => $user['employ_email'],
                                ];
                                
                                $_SESSION['loggedin'] = true;

                                session_write_close();
                                header("Location: index");
                                echo "
                                    <script>
                                        location.replace('index')
                                    </script>
                                ";
                                exit();
                            }else{
                                echo"<div class='alert alert-warning' role='alert' style='text-align:center; direction:rtl; '>
                                    <h4 style='color:rgb(245, 74, 74);'>حسابك غير مفعل</h4>
                                    <h6>الرجاء التواصل مع المسئولين لتفعيل حسابك</h6>
                                </div>";
                            }
                        }else{
                            echo '<div class="alert alert-danger" role="alert" style="text-align:center; direction:rtl; ">
                                <h4>الحساب مغلق مؤقتًا</h4>
                                <span>باقي على الوقت</span>
                                <span id="minetes_remaining"></span>
                                <span >دقيقة</span>
                                <span >و <span id="seconds_remaining"></span> ثانية</span>
                            </div>';
                            echo "
                            <script>
                                document.querySelector('.overflow-screen').style.display = 'block';
                                let minetes_remaining = document.getElementById('minetes_remaining');
                                let seconds_remaining = document.getElementById('seconds_remaining');

                                let counter_minutes = 0;
                                let counter_seconds = 60;
                                minetes_remaining.innerText = counter_minutes;
                                seconds_remaining.innerText = counter_seconds;

                                console.log(counter_minutes, counter_seconds);

                                setInterval(function() {
                                    --counter_minutes;
                                    if (counter_minutes < 0) {
                                        counter_minutes = 0;
                                    }
                                    minetes_remaining.innerText = counter_minutes;
                                }, 60000);

                                setInterval(function() {
                                    counter_seconds--;
                                    if (counter_seconds < 0) {
                                        counter_seconds = 59;
                                    }
                                    seconds_remaining.innerText = counter_seconds;
                                }, 1000);
                                setTimeout(() => {
                                    window.location.replace('api/resetzero');
                                }, 60000); // إعادة تحميل الصفحة بعد 15 دقيقة

                            </script>";
                        }
                    }else {
                        $pdo->prepare("UPDATE users SET failed_attempts = failed_attempts + 1, last_failed_login = NOW() WHERE employ_id = ?")
                        ->execute([$user['employ_id']]);

                        echo"<div class='alert alert-danger' role='alert' style='text-align:center; direction:rtl; '>
                            ! الرجاء اكتب كلمة المرور صحيحة
                            <br> تحقق من كلمة المرور الذي كتبته 
                        </div>";
                        $passfalse = 'false';
                        $resetzero = function($employ_id){
                            global $pdo;
                            $pdo->prepare("UPDATE users SET failed_attempts = 0, last_failed_login = NULL WHERE employ_id = ?")
                                ->execute([$employ_id]);
                            echo "done";
                        };

                        if (isAccountLocked($user)) { // ماذال في الحظر
                            echo '<div class="alert alert-danger" role="alert" style="text-align:center; direction:rtl; ">
                                <h4>الحساب مغلق مؤقتًا</h4>
                                <span>باقي على الوقت</span>
                                <span id="minetes_remaining"></span>
                                <span >دقيقة</span>
                                <span >و <span id="seconds_remaining"></span> ثانية</span>
                            </div>';
                            echo "
                            <script>
                                document.querySelector('.overflow-screen').style.display = 'block';
                                let minetes_remaining = document.getElementById('minetes_remaining');
                                let seconds_remaining = document.getElementById('seconds_remaining');

                                let counter_minutes = 0;
                                let counter_seconds = 60;
                                minetes_remaining.innerText = counter_minutes;
                                seconds_remaining.innerText = counter_seconds;

                                console.log(counter_minutes, counter_seconds);

                                setInterval(function() {
                                    --counter_minutes;
                                    if (counter_minutes < 0) {
                                        counter_minutes = 0;
                                    }
                                    minetes_remaining.innerText = counter_minutes;
                                }, 60000);

                                setInterval(function() {
                                    counter_seconds--;
                                    if (counter_seconds < 0) {
                                        counter_seconds = 59;
                                    }
                                    seconds_remaining.innerText = counter_seconds;
                                }, 1000);
                                setTimeout(() => {
                                    window.location.replace('api/resetzero');
                                }, 60000); // إعادة تحميل الصفحة بعد 15 دقيقة

                            </script>";
                        }
                    }
                } else {
                    echo"
                        <div class='alert alert-danger' role='alert' style='text-align:center; direction:rtl; '>
                            <h3>
                                انت غير مسجل في الموقع
                            </h3>
                            <p>تواصل مع المسئولين</p>
                        </div>
                    ";
                    $emailfalse = 'false';
                }
            }else{
                echo "
                    <div class='alert alert-danger' role='alert' style='text-align:center; direction:rtl; '>
                        الرجاء ملئ جميع الحقول
                    </div>
                ";
            }
        }
        $_SESSION['location'] = 'login';
    ?>
    <div class="content">
        <div class="container">
            <div class="header">
                <div class="img">
                    <img src="img/Roaya.png" class="Roaya">
                </div>
                <div class="title">
                    <hr>
                    <div>
                        Login To Roaya Pay
                    </div>
                </div>
            </div>
            <form method="POST" id="loginForm">
                <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                <div>
                    <div>
                        <i class="fa-solid fa-user"></i>
                        <input type="email" id="mail" name="email" placeholder="Enter Your Email" required>
                    </div>
                    <div>
                        <i class="fa-solid fa-unlock"></i>
                        <input type="password" id="pass_1" name="password" placeholder="Enter Your Password" required>
                        <i class="fa-regular fa-eye-slash" id="show" onclick="show_password(this.id)"></i>
                    </div>
                </div>
                <div class="btns">
                    <button type="submit" id="submit" name="submit" class="btn btn-success w-100">
                        Login
                    </button>
                </div>
            </form>
            
            <?php
                $_SESSION['email'] = $email; 
            echo "
                <script>
                    const email = document.querySelector('#mail');
                    const password = document.querySelector('#pass_1');

                    email.value = '$email';
                    password.value = '$password';

                    if('$passfalse' == 'false'){
                        password.style.border = '1px solid red';
                        password.addEventListener('focus', function(){
                            password.style.boxShadow = '4px 4px 0 #dc3545';
                        });
                        password.addEventListener('blur', function() {
                            password.style.boxShadow = 'none';
                        });
                    }else if('$emailfalse' == 'false'){
                        email.style.border = '1px solid red';
                        email.addEventListener('focus', function(){
                            email.style.boxShadow = '4px 4px 0 #dc3545';
                        });
                        email.addEventListener('blur', function() {
                            email.style.boxShadow = 'none';
                        });
                    }
                </script>
            ";
            ?>
        </div>
    </div>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        // window.addEventListener('beforeunload', function (e) {
        //     e.preventDefault();
        //     e.returnValue = 'إعادة تحميل الصفحة ممنوعة';
        // });
        // window.addEventListener('keydown', function(e) {
        //     if (e.key === 'F5' || ((e.ctrlKey || e.metaKey) && e.key === 'r')) {
        //         e.preventDefault();
        //         alert('إعادة تحميل الصفحة ممنوعة');
        //     }
        // });
    </script>
    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/all.min.js"></script>
    <script src="js/log.js"></script>
</body>
</html>