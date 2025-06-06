<?php
    require '../php/auth_check.php';

    if (!isset($_SESSION['employ']['employ_id']) ) {
        session_unset();
        session_destroy();
         header("Location: ../login");
        exit;
    }
?>
<!DOCTYPE html>
<html lang='ar'>
    <head>
        <!-- meta -->
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta name='description' content='this system is private property'>
        <!-- link icon -->
        <link rel='icon' href='../img/Roaya_icon.png'>
        <!-- link css -->
        <link rel='stylesheet' href='../css/style.css'>
        <link rel='stylesheet' href='../css/staff_data.css'>
        <link rel='stylesheet' href='../css/menu.css'>
        <link rel='stylesheet' href='../css/all.min.css'>
        <link rel='stylesheet' href='../css/bootstrap.css'>
        <title>Roaya Pay</title>
    </head>
    <body>
        <?php
            include '../inc/config.php';
            include '../php/db.php';

            $IDuse = $_SESSION['employ']['employ_id'];
            $stmt = $pdo->prepare("SELECT * FROM users WHERE employ_id = :id");
            $stmt->execute(['id' => $IDuse]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            mysqli_query($conection, "UPDATE users SET location='index' WHERE employ_id=$IDuse");
            $ID = $_POST['id'];
            $select = mysqli_query($conection, "SELECT * FROM employee_specific WHERE employ_id=$ID");
            $data = mysqli_fetch_array($select);
        ?>
        <!-- header -->
        <div class='header'>
            <div>
                <a href='../index' class='navbar-brand'>
                    <img src='../img/logo.png' alt='' draggable='false'>
                </a>
                <div id='nav'> 
                    <div class='collapse navbar-collapse mx-2'>
                        <div>
                            <div class='dropdowns'>
                                <div class='dropdown mx-2 my-2'>
                                    <button class='btn dropdown-toggle' type='button' data-toggle='dropdown' aria-expanded='false'>
                                        <span id='employ_Name_Show'></span>
                                    </button>
                                    <div class='dropdown-menu'>
                                        <a class='dropdown-item' id="name" onclick="copyToClipboard(this.id)">
                                            <i class='fa fa-employ text-dark'></i>
                                            <p class='mx-2'>
                                                <?php echo $user['employ_name']?>
                                            </p>
                                        </a>
                                        <div class='dropdown-divider m-0'></div>
                                        <a class='dropdown-item' id="email" onclick="copyToClipboard(this.id)">
                                            <i class="fa-regular fa-envelope"></i>
                                            <p class='mx-2'>
                                                <?php echo $user['employ_email']?>
                                            </p>
                                        </a>
                                        <div class='dropdown-divider m-0'></div>
                                        <a class='dropdown-item bg-danger text-center text-light' style="cursor: pointer; border-radius: 0 0 3.5px 3.5px;" id="logout" onclick="logout()">
                                            <i class="fa-solid fa-unlock-keyhole"></i>
                                            <span class='mt-2'>
                                                Log Out
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='IconMenu'>
                        <span></span>
                        <span class='Active'></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- content -->
        <div class='content'>
            <!-- menu -->
            <div class='menu'>
                <ul>        
                    <li class='li'>
                        <a href='#' class=''>
                            <i class='fa-solid fa-parachute-box'></i>
                            <span>طلبات التوظيف</span>
                            <i class='fa fa-angle-left'></i>
                        </a>
                        <ul class='mm-collapse'>
                            <li>
                                <a href='../index?employid=<?php echo $user['employ_id']?>'>
                                    <i class='fas fa-file-invoice'></i>
                                    <span> الطلبات </span>
                                </a>
                            </li>
                            <li>
                                <a href='../del/index?employid=<?php echo $user['employ_id']?>'>
                                    <i class="fa-solid fa-trash"></i>
                                    <span> المحذوفات </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class='li'>
                        <a href='#' class=''>
                            <i class='fa-solid fa-employs-line'></i>
                            <span>قائمة المعينيين</span>
                            <i class='fa fa-angle-left'></i>
                        </a>
                        <ul class='mm-collapse'>
                            <li>
                                <a href='../index_appointed?employid=<?php echo $user['employ_id']?>' class=''>
                                    <i class='fa-solid fa-id-card-clip'></i>
                                    <span> المعينيين  </span>
                                </a>
                            </li>
                            <li>
                                <a href='../del/index_appointed?employid=<?php echo $user['employ_id']?>'>
                                    <i class="fa-solid fa-trash"></i>
                                    <span> المحذوفات </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class='li'>
                        <a href='#' class='active'>
                            <i class="fa-solid fa-signs-post"></i>
                            <span>قائمة المؤجلين</span>
                            <i class='fa fa-angle-left'></i>
                        </a>
                        <ul class='mm-collapse'>
                            <li>
                                <a href='../index_postpone?employid=<?php echo $user['employ_id']?>'>
                                    <i class='fa-solid fa-info'></i>
                                    <span> المؤجلين  </span>
                                </a>
                            </li>
                            <li>
                                <a href='../del/index_postpone?employid=<?php echo $user['employ_id']?>'>
                                    <i class="fa-solid fa-trash"></i>
                                    <span> المحذوفات  </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class='settings'>
                        <a href='../settings?employid=<?php echo $user['employ_id']?>&mood=create'>
                            <i class='fa fa-cog'></i>
                            <span>الاعدادات</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- show-board -->
            <div class='show-board'>
                <div class='title-info'>
                    <p>بيانات الموظفين</p>    
                    <div class='btns-export-group'>
                        <button class='btn export mx-2' id="export">التصدير الي pdf</butto>
                    </div>
                </div>
                <form novalidate>
                    <div class='modal-header text-light'>
                    <h5 class='modal-title' id='showdataTitle'>عرض استمارة الموظف 
                        <span style="color: #007bff;">
                            <?php echo"$data[first_name]"." "."$data[second_name]"." "."$data[third_name]"." "."$data[last_name]"  ?> 
                        </span>
                    </h5>
                    </div>
                </form>
                <div class='data-info'>
                    <div class='container' id="employee_specific" name='employee_specific'>
                        <div>
                            <p class='title text-dark'>
                                شــركـة ثقــة لخــدمـات الـدفـع الإلكـترونـي و الحــلول المــتكامـلة ش . م . م
                            </p>
                            <img src='../img/Roaya.png' alt="" draggable='false'>
                        </div>
                        <span>
                            الإستمارة الإلكترونية للموظف
                        </span>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    خاص بالموظف
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    الأســم
                                </td>
                                <td>
                                    <?php echo"$data[first_name]"." "."$data[second_name]"." "."$data[third_name]"." "."$data[last_name]"  ?> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    صورة الموظف
                                </td>
                                <td>
                                    <?="$data[national_id]"?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    البريد الإلكتروني
                                </td>
                                <td>
                                    <?php echo $data['date_of_issue']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الوظيفة المطلوبة
                                </td>
                                <td>
                                    <?php echo $data['place_of_issue']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الموقف من التجنيد
                                </td>
                                <td>
                                    <?php echo $data['nationality']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الجنسية
                                </td>
                                <td>
                                    <?php echo $data['place_of_birth']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الديانة
                                </td>
                                <td>
                                    <?php echo $data['date_of_birth']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الحالة الإجتماعية
                                </td>
                                <td>
                                    <?php echo $data['insurance_num']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    تاريخ الميلاد
                                </td>
                                <td>
                                    <?php echo $data['conscription']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    محل الميلاد
                                </td>
                                <td>
                                    <?php echo $data['marital_status']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    العنوان
                                </td>
                                <td>
                                    <?php echo $data['Num_of_children']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    شارع
                                </td>
                                <td>
                                    <?php echo $data['job_required']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    صورة شخصية 
                                </td>
                                <td class='d-flex justify-content-center'>
                                    <img class='' src='../uploads/<?php echo $data['photoOFuser_up']?>'>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    صورة البطاقة 
                                </td>
                                <td class='d-flex'>
                                    <img class='w-50' src='../uploads/<?php echo $data['frontOFcard_up']?>'>
                                    <img class='w-50' src='../uploads/<?php echo $data['backOFcard_up']?>'>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    العنوان
                                </td>
                                <td>
                                    <?php echo $data['number_tel_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    العنوان
                                </td>
                                <td>
                                    <?php echo $data['number_tel_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    العنوان
                                </td>
                                <td>
                                    <?php echo $data['place_of_residence']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    العنوان
                                </td>
                                <td>
                                    <?php echo $data['governorate']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    العنوان
                                </td>
                                <td>
                                    <?php echo $data['centre']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    العنوان
                                </td>
                                <td>
                                    <?php echo $data['area_code']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    العنوان
                                </td>
                                <td>
                                    <?php echo $data['employ_email']?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    1 المؤهلات العملية
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    جهة الدراسة
                                </td>
                                <td>
                                    <?php echo $data['academic_qualification_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    التخصص
                                </td>
                                <td>
                                    <?php echo $data['university_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    سنه التخرج
                                </td>
                                <td>
                                    <?php echo $data['locition_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    المؤهل الدراسي
                                </td>
                                <td>
                                    <?php echo $data['num_of_years_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    المؤهل الدراسي
                                </td>
                                <td>
                                    <?php echo $data['gpa_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    المؤهل الدراسي
                                </td>
                                <td>
                                    <?php echo $data['year_graduated_1']?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    2 المؤهلات العملية
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    جهة الدراسة
                                </td>
                                <td>
                                    <?php echo $data['academic_qualification_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    التخصص
                                </td>
                                <td>
                                    <?php echo $data['university_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    سنه التخرج
                                </td>
                                <td>
                                    <?php echo $data['locition_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    المؤهل الدراسي
                                </td>
                                <td>
                                    <?php echo $data['num_of_years_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    المؤهل الدراسي
                                </td>
                                <td>
                                    <?php echo $data['gpa_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    المؤهل الدراسي
                                </td>
                                <td>
                                    <?php echo $data['year_graduated_2']?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    3 المؤهلات العملية
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    جهة الدراسة
                                </td>
                                <td>
                                    <?php echo $data['academic_qualification_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    التخصص
                                </td>
                                <td>
                                    <?php echo $data['university_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    سنه التخرج
                                </td>
                                <td>
                                    <?php echo $data['locition_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    المؤهل الدراسي
                                </td>
                                <td>
                                    <?php echo $data['num_of_years_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    المؤهل الدراسي
                                </td>
                                <td>
                                    <?php echo $data['gpa_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    المؤهل الدراسي
                                </td>
                                <td>
                                    <?php echo $data['year_graduated_3']?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    1 الدورات التدريبية
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    اسم الدورة
                                </td>
                                <td>
                                    <?php echo $data['course_name_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    مكان الدورة
                                </td>
                                <td>
                                    <?php echo $data['duration_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    مده الدورة
                                </td>
                                <td>
                                    <?php echo $data['sponsor_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    نوع الشهادة
                                </td>
                                <td>
                                    <?php echo $data['course_date_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    صورة شهادة الدورات التدريبية
                                </td>
                                <td>
                                    <?="$data[course_location_1]" ?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    2 الدورات التدريبية
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    اسم الدورة
                                </td>
                                <td>
                                    <?php echo $data['course_name_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    مكان الدورة
                                </td>
                                <td>
                                    <?php echo $data['duration_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    مده الدورة
                                </td>
                                <td>
                                    <?php echo $data['sponsor_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    نوع الشهادة
                                </td>
                                <td>
                                    <?php echo $data['course_date_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    صورة شهادة الدورات التدريبية
                                </td>
                                <td>
                                    <?="$data[course_location_2]" ?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    3 الدورات التدريبية
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    اسم الدورة
                                </td>
                                <td>
                                    <?php echo $data['course_name_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    مكان الدورة
                                </td>
                                <td>
                                    <?php echo $data['duration_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    مده الدورة
                                </td>
                                <td>
                                    <?php echo $data['sponsor_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    نوع الشهادة
                                </td>
                                <td>
                                    <?php echo $data['course_date_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    صورة شهادة الدورات التدريبية
                                </td>
                                <td>
                                    <?="$data[course_location_3]" ?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    4 الدورات التدريبية
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    اسم الدورة
                                </td>
                                <td>
                                    <?php echo $data['course_name_4']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    مكان الدورة
                                </td>
                                <td>
                                    <?php echo $data['duration_4']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    مده الدورة
                                </td>
                                <td>
                                    <?php echo $data['sponsor_4']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    نوع الشهادة
                                </td>
                                <td>
                                    <?php echo $data['course_date_4']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    صورة شهادة الدورات التدريبية
                                </td>
                                <td>
                                    <?="$data[course_location_4]" ?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    5 الدورات التدريبية
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    اسم الدورة
                                </td>
                                <td>
                                    <?php echo $data['course_name_5']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    مكان الدورة
                                </td>
                                <td>
                                    <?php echo $data['duration_5']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    مده الدورة
                                </td>
                                <td>
                                    <?php echo $data['sponsor_5']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    نوع الشهادة
                                </td>
                                <td>
                                    <?php echo $data['course_date_5']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    صورة شهادة الدورات التدريبية
                                </td>
                                <td>
                                    <?="$data[course_location_5]" ?>
                                </td>
                            </tr>
                        </table>
                        <table class="no">
                            <tr>
                                <th colspan='12'>
                                    الخبرة العملية
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    مسمي الوظيفة
                                </td>
                                <td>
                                    <?php echo $data['employer_name_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    جهة العمل
                                </td>
                                <td>
                                    <?php echo $data['positica_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الفترة من
                                </td>
                                <td>
                                    <?php echo $data['date_from_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الي
                                </td>
                                <td>
                                    <?php echo $data['date_to_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الراتب
                                </td>
                                <td>
                                    <?php echo $data['basic_salary_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    سبب ترك العمل
                                </td>
                                <td>
                                    <?php echo $data['reason_for_leaving_1']?>
                                </td>
                            </tr>
                        </table>
                        <table class="no">
                            <tr>
                                <th colspan='12'>
                                    الخبرة العملية
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    مسمي الوظيفة
                                </td>
                                <td>
                                    <?php echo $data['employer_name_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    جهة العمل
                                </td>
                                <td>
                                    <?php echo $data['positica_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الفترة من
                                </td>
                                <td>
                                    <?php echo $data['date_from_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الي
                                </td>
                                <td>
                                    <?php echo $data['date_to_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الراتب
                                </td>
                                <td>
                                    <?php echo $data['basic_salary_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    سبب ترك العمل
                                </td>
                                <td>
                                    <?php echo $data['reason_for_leaving_2']?>
                                </td>
                            </tr>
                        </table>
                        <table class="no">
                            <tr>
                                <th colspan='12'>
                                    الخبرة العملية
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    مسمي الوظيفة
                                </td>
                                <td>
                                    <?php echo $data['employer_name_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    جهة العمل
                                </td>
                                <td>
                                    <?php echo $data['positica_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الفترة من
                                </td>
                                <td>
                                    <?php echo $data['date_from_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الي
                                </td>
                                <td>
                                    <?php echo $data['date_to_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الراتب
                                </td>
                                <td>
                                    <?php echo $data['basic_salary_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    سبب ترك العمل
                                </td>
                                <td>
                                    <?php echo $data['reason_for_leaving_3']?>
                                </td>
                            </tr>
                        </table>
                        <table class="no">
                            <tr>
                                <th colspan='12'>
                                    الخبرة العملية
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    مسمي الوظيفة
                                </td>
                                <td>
                                    <?php echo $data['employer_name_4']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    جهة العمل
                                </td>
                                <td>
                                    <?php echo $data['positica_4']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الفترة من
                                </td>
                                <td>
                                    <?php echo $data['date_from_4']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الي
                                </td>
                                <td>
                                    <?php echo $data['date_to_4']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الراتب
                                </td>
                                <td>
                                    <?php echo $data['basic_salary_4']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    سبب ترك العمل
                                </td>
                                <td>
                                    <?php echo $data['reason_for_leaving_4']?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td >
                                    هل تعمل في الوقت الحالي
                                </td>
                                <td>
                                    <?php echo $data['last_sallary']?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td >
                                    هل تعمل في الوقت الحالي
                                </td>
                                <td>
                                    <?php echo $data['skills_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الواجبات و المسئوليات اثناء عملك
                                </td>
                                <td>
                                    <?php echo $data['skills_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    هل تعمل في الوقت الحالي
                                </td>
                                <td>
                                    <?php echo $data['skills_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الواجبات و المسئوليات اثناء عملك
                                </td>
                                <td>
                                    <?php echo $data['skills_4']?>
                                </td>
                            </tr>
                        </table>
                        <?php
                            if($data['job_name_2'] != '' || $data['job_name_2'] != null){
                                echo "
                                    <table>
                                        <tr class='no'>
                                            <th colspan='12'>
                                                الخبرة العملية
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                مسمي الوظيفة
                                            </td>
                                            <td>
                                                $data[job_name_2]
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                جهة العمل
                                            </td>
                                            <td>
                                                $data[job_duration_2]
                                            </td>
                                        </tr>
                                        <tr>
                                            <td >
                                                الفترة من
                                            </td>
                                            <td>
                                                $data[pointOFstart_2]
                                            </td>
                                        </tr>
                                        <tr>
                                            <td >
                                                الي
                                            </td>
                                            <td>
                                                $data[pointOFend_2]
                                            </td>
                                        </tr>
                                        <tr>
                                            <td >
                                                الراتب
                                            </td>
                                            <td>
                                                $data[salary_2]
                                            </td>
                                        </tr>
                                        <tr>
                                            <td >
                                                سبب ترك العمل
                                            </td>
                                            <td>
                                                $data[reasonFORleaving_2]
                                            </td>
                                        </tr>
                                        <tr>
                                            <td >
                                                صورة شهادة الخبرة العملية 
                                            </td>
                                            <td>
                                                <img style='width: 100%;height: 500px;' src='../uploads/$data[attached_2]'>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td >
                                                الواجبات و المسئوليات اثناء عملك
                                            </td>
                                            <td>
                                                $data[responsibilities_2]
                                            </td>
                                        </tr>
                                    </table> 
                                ";
                            }
                        ?>
                        <?php
                            if($data['job_name_3'] != '' || $data['job_name_3'] != null){
                                echo "
                                    <table>
                                        <tr class='no'>
                                            <th colspan='12'>
                                                الخبرة العملية
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                مسمي الوظيفة
                                            </td>
                                            <td>
                                                $data[job_name_3]
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                جهة العمل
                                            </td>
                                            <td>
                                                $data[job_duration_3]
                                            </td>
                                        </tr>
                                        <tr>
                                            <td >
                                                الفترة من
                                            </td>
                                            <td>
                                                $data[pointOFstart_3]
                                            </td>
                                        </tr>
                                        <tr>
                                            <td >
                                                الي
                                            </td>
                                            <td>
                                                $data[pointOFend_3]
                                            </td>
                                        </tr>
                                        <tr>
                                            <td >
                                                الراتب
                                            </td>
                                            <td>
                                                $data[salary_3]
                                            </td>
                                        </tr>
                                        <tr>
                                            <td >
                                                سبب ترك العمل
                                            </td>
                                            <td>
                                                $data[reasonFORleaving_3]
                                            </td>
                                        </tr>
                                        <tr>
                                            <td >
                                                صورة شهادة الخبرة العملية 
                                            </td>
                                            <td>
                                                <img style='width: 100%;height: 500px;' src='../uploads/$data[attached_3]'>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td >
                                                الواجبات و المسئوليات اثناء عملك
                                            </td>
                                            <td>
                                                $data[responsibilities_3]
                                            </td>
                                        </tr>
                                    </table> 
                                ";
                            }  
                        ?>
                        <?php
                            if($data['job_name_4'] != '' || $data['job_name_4'] != null){
                                echo "
                                    <table>
                                        <tr class='no'>
                                            <th colspan='12'>
                                                الخبرة العملية
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                مسمي الوظيفة
                                            </td>
                                            <td>
                                                $data[job_name_4]
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                جهة العمل
                                            </td>
                                            <td>
                                                $data[job_duration_4]
                                            </td>
                                        </tr>
                                        <tr>
                                            <td >
                                                الفترة من
                                            </td>
                                            <td>
                                                $data[pointOFstart_4]
                                            </td>
                                        </tr>
                                        <tr>
                                            <td >
                                                الي
                                            </td>
                                            <td>
                                                $data[pointOFend_4]
                                            </td>
                                        </tr>
                                        <tr>
                                            <td >
                                                الراتب
                                            </td>
                                            <td>
                                                $data[salary_4]
                                            </td>
                                        </tr>
                                        <tr>
                                            <td >
                                                سبب ترك العمل
                                            </td>
                                            <td>
                                                $data[reasonFORleaving_4]
                                            </td>
                                        </tr>
                                        <tr>
                                            <td >
                                                صورة شهادة الخبرة العملية 
                                            </td>
                                            <td>
                                                <img style='width: 100%;height: 500px;' src='../uploads/$data[attached_4]'>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td >
                                                الواجبات و المسئوليات اثناء عملك
                                            </td>
                                            <td>
                                                $data[responsibilities_4]
                                            </td>
                                        </tr>
                                    </table>  
                                ";
                            }    
                        ?>
                        <table>
                            <tr class='no'>
                                <th colspan='12'>
                                    الشخص الاول الذي يمكن الرجوع اليه 
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    الاسم
                                </td>
                                <td>
                                    <?php echo $data['arabic_reading']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الوظيفة
                                </td>
                                <td>
                                    <?php echo $data['arabic_writing']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    عنوان الاتصال
                                </td>
                                <td>
                                    <?php echo $data['arabic_speaking']?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class='no'>
                                <th colspan='12'>
                                    الشخص الاول الذي يمكن الرجوع اليه 
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    الاسم
                                </td>
                                <td>
                                    <?php echo $data['english_reading']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الوظيفة
                                </td>
                                <td>
                                    <?php echo $data['english_writing']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    عنوان الاتصال
                                </td>
                                <td>
                                    <?php echo $data['english_speaking']?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class='no'>
                                <th colspan='12'>
                                    الشخص الاول الذي يمكن الرجوع اليه 
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    الاسم
                                </td>
                                <td>
                                    <?php echo $data['hobbies_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الوظيفة
                                </td>
                                <td>
                                    <?php echo $data['hobbies_2']?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class='no'>
                                <th colspan='12'>
                                    الشخص الاول الذي يمكن الرجوع اليه 
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    الاسم
                                </td>
                                <td>
                                    <?php echo $data['person_name_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الوظيفة
                                </td>
                                <td>
                                    <?php echo $data['person_relationship_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    عنوان الاتصال
                                </td>
                                <td>
                                    <?php echo $data['person_phone_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    رقم الهاتف
                                </td>
                                <td>
                                    <?php echo $data['person_address_1']?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class='no'>
                                <th colspan='12'>
                                    الشخص الاول الذي يمكن الرجوع اليه 
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    الاسم
                                </td>
                                <td>
                                    <?php echo $data['person_name_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الوظيفة
                                </td>
                                <td>
                                    <?php echo $data['person_relationship_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    عنوان الاتصال
                                </td>
                                <td>
                                    <?php echo $data['person_phone_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    رقم الهاتف
                                </td>
                                <td>
                                    <?php echo $data['person_address_2']?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- js files -->
        <script>
            let exportButton = document.querySelector('#export');
            let space = document.querySelector('.space');
            let space_2 = document.querySelector('.space2');
            let space_3 = document.querySelector('.space3');
            let space_4 = document.querySelector('.space4');
            let space_5 = document.querySelector('.space5');
            let space_6 = document.querySelector('.space6');
            function ExportToPDF() {
                space.innerHTML = `<br><br><br>`;
                space_2.innerHTML = `<br><br><br><br><br>`;
                space_3.innerHTML = `<br><br><br><br><br><br><br><br><br>`;
                space_4.innerHTML = `<br><br><br><br><br><br><br><br><br><br><br><br>`;
                space_5.innerHTML = `<br><br><br><br><br><br><br><br><br><br><br><br><br>`;
                space_6.innerHTML = `<br><br><br><br><br><br><br><br><br><br><br>`;
                var table = document.querySelector("#employee_specific");
                var opt = {
                    margin: -0.1,
                    filename: 'استمارة طلب وظيفة--<?php echo $data['employ_name']?>.pdf',
                    image: { type: 'jpeg', quality: 1 },
                    html2canvas: { scale: 3 },
                    jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
                };
                pdf(table, opt);
            }
            exportButton.onclick = function(){
                ExportToPDF();
            }
        </script>
        <!-- alert -->
        <div class="alert alert-success d-none" role="alert" id="alert"></div>
        <!-- js files -->
        <script src='../js/logout_2.js'></script>
        <script src='../js/main.js'></script>
        <script src='../js/jquery-3.7.0.min.js'></script>
        <script src='../js/popper.min.js'></script>
        <script src='../js/bootstrap.js'></script>
        <script src='../js/all.min.js'></script>
        <script src='../js/menu.js'></script>
        <script src='../js/staff_data.js'></script>
        <script src='../js/unpkg.com_xlsx@0.15.1_dist_xlsx.full.min.js'></script>
        <script src='../js/pdf.bundle.min.js'></script>
        <script src='../js/pdf.bundle.js'></script>
        <script>
            let name =document.querySelector('#employ_Name_Show');
            name.innerHTML = "<?php echo $user['employ_name']?>";
        </script>
        <script>
            if(<?php echo $user['ability']?> == true){
                document.querySelector('.settings').style.display = 'block';
            }else{
                document.querySelector('.settings').style.display = 'none';
            }
        </script>
    </body>
</html>