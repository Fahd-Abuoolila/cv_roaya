<?php
    require '../../php/auth_check.php';

    if (!isset($_SESSION['employ']['employ_id']) ) {
        session_unset();
        session_destroy();
         header("Location: ../../login");
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
        <link rel='icon' href='../img/logo_icon.png'>
        <!-- link css -->
        <link rel='stylesheet' href='../css/style.css'>
        <link rel='stylesheet' href='../css/staff_data.css'>
        <link rel='stylesheet' href='../css/menu.css'>
        <link rel='stylesheet' href='../css/all.min.css'>
        <link rel='stylesheet' href='../css/bootstrap.css'>
        <title>Roaya Pay</title>
        <style>
            .menu > ul > li:nth-child(2):not(.open) > a ,
            .menu > ul > li:nth-child(2) > a + ul > li:nth-child(2) > a{
                background: #5aaa5791 !important;
            }
        </style>
    </head>
    <body>
        <?php
            require('../inc/config.php');
            $IDuse = $_SESSION['employ']['employ_id'];
            $item = mysqli_query($conection, "SELECT * FROM users WHERE employ_id=$IDuse");
            $user = mysqli_fetch_array($item);

            $ID = $_POST['id'];
            $select = mysqli_query($conection, "SELECT * FROM delete_postpone WHERE employ_id=$ID");
            $data = mysqli_fetch_array($select);
        ?>
        <!-- header -->
        <?php
            include '../addition/header_sub.php';
        ?>
        <!-- content -->
        <div class='content'>
            <!-- menu -->
            <?php
                include '../addition/menu_sub.php';
            ?>
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
                        <span style="color: #5aaa57;">
                            <?php echo"$data[first_name]"." "."$data[second_name]"." "."$data[third_name]"." "."$data[last_name]"  ?> 
                        </span>
                    </h5>
                    </div>
                </form>
                <div class='data-info'>
                    <div class='container' id="employee_specific" name='employee_specific'>
                        <div>
                            <p class='title text-dark'>
                                شركة رؤية باي لحلول السداد و البرمجيات
                            </p>
                            <img src='../../img/Roaya_icon.png' alt="" draggable='false'>
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
                                    الرقم القومي
                                </td>
                                <td>
                                    <?="$data[national_id]"?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    تاريخ الإصدار
                                </td>
                                <td>
                                    <?php echo $data['date_of_issue']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    مكان الإصدار
                                </td>
                                <td>
                                    <?php echo $data['place_of_issue']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الجنسية
                                </td>
                                <td>
                                    <?php echo $data['nationality']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    مكان الميلاد
                                </td>
                                <td>
                                    <?php echo $data['place_of_birth']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    تاريخ الميلاد
                                </td>
                                <td>
                                    <?php echo $data['date_of_birth']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الرقم التأميني
                                </td>
                                <td>
                                    <?php echo $data['insurance_num']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الموقف من التجنيد
                                </td>
                                <td>
                                    <?php echo $data['conscription']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الحالة الإجتماعية
                                </td>
                                <td>
                                    <?php echo $data['marital_status']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    عدد الابناء
                                </td>
                                <td>
                                    <?php echo $data['Num_of_children']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الوظيفة المطلوبة
                                </td>
                                <td>
                                    <?php echo $data['job_required']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    صورة البطاقة 
                                </td>
                                <td class='d-flex'>
                                    <img class='w-50' src='../../uploads/<?php echo $data['frontOFcard_up']?>'>
                                    <img class='w-50' src='../../uploads/<?php echo $data['backOFcard_up']?>'>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    صورة شخصية 
                                </td>
                                <td class='d-flex justify-content-center'>
                                    <img class='' src='../../uploads/<?php echo $data['photoOFuser_up']?>'>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    المعلومات الإضافية
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    رقم الهاتف 1
                                </td>
                                <td>
                                    <?php echo $data['number_tel_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    رقم الهاتف 2
                                </td>
                                <td>
                                    <?php echo $data['number_tel_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    محل السكن
                                </td>
                                <td>
                                    <?php echo $data['place_of_residence']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    المحافظة
                                </td>
                                <td>
                                    <?php echo $data['governorate']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    مركز / حي
                                </td>
                                <td>
                                    <?php echo $data['centre']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الرمز البريدي
                                </td>
                                <td>
                                    <?php echo $data['area_code']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    البريد الإلكتروني
                                </td>
                                <td>
                                    <?php echo $data['employ_email']?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    المؤهلات العلمية 1
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    المؤهل العلمي 1
                                </td>
                                <td>
                                    <?php echo $data['academic_qualification_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    اسم الجامعة 1
                                </td>
                                <td>
                                    <?php echo $data['university_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    مكانها 1
                                </td>
                                <td>
                                    <?php echo $data['university_locition_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    مده الدراسة 1
                                </td>
                                <td>
                                    <?php echo $data['num_of_years_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    المعدل التراكمي 1
                                </td>
                                <td>
                                    <?php echo $data['gpa_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    سنه التخرج 1
                                </td>
                                <td>
                                    <?php echo $data['year_graduated_1']?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    المؤهلات العلمية 2
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    المؤهل العلمي 2
                                </td>
                                <td>
                                    <?php echo $data['academic_qualification_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    اسم الجامعة 2
                                </td>
                                <td>
                                    <?php echo $data['university_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    مكانها 2
                                </td>
                                <td>
                                    <?php echo $data['university_locition_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    مده الدراسة 2
                                </td>
                                <td>
                                    <?php echo $data['num_of_years_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    المعدل التراكمي 2
                                </td>
                                <td>
                                    <?php echo $data['gpa_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    سنه التخرج 2
                                </td>
                                <td>
                                    <?php echo $data['year_graduated_2']?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    المؤهلات العلمية 3
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    المؤهل العلمي 3
                                </td>
                                <td>
                                    <?php echo $data['academic_qualification_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    اسم الجامعة 3
                                </td>
                                <td>
                                    <?php echo $data['university_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    مكانها 3
                                </td>
                                <td>
                                    <?php echo $data['university_locition_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    مده الدراسة 3
                                </td>
                                <td>
                                    <?php echo $data['num_of_years_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    المعدل التراكمي 3
                                </td>
                                <td>
                                    <?php echo $data['gpa_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    سنه التخرج 3
                                </td>
                                <td>
                                    <?php echo $data['year_graduated_3']?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    الدورات التدريبية 1
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    اسم الدوره 1
                                </td>
                                <td>
                                    <?php echo $data['course_name_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    المده 1
                                </td>
                                <td>
                                    <?php echo $data['duration_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الجهة التي اعدتها 1
                                </td>
                                <td>
                                    <?php echo $data['sponsor_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    تاريخها 1
                                </td>
                                <td>
                                    <?php echo $data['course_date_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    مكانها 1
                                </td>
                                <td>
                                    <?php echo $data['course_location_1']?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    الدورات التدريبية 2
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    اسم الدوره 2
                                </td>
                                <td>
                                    <?php echo $data['course_name_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    المده 2
                                </td>
                                <td>
                                    <?php echo $data['duration_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الجهة التي اعدتها 2
                                </td>
                                <td>
                                    <?php echo $data['sponsor_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    تاريخها 2
                                </td>
                                <td>
                                    <?php echo $data['course_date_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    مكانها 2
                                </td>
                                <td>
                                    <?php echo $data['course_location_2']?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    الدورات التدريبية 3
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    اسم الدوره 3
                                </td>
                                <td>
                                    <?php echo $data['course_name_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    المده 3
                                </td>
                                <td>
                                    <?php echo $data['duration_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الجهة التي اعدتها 3
                                </td>
                                <td>
                                    <?php echo $data['sponsor_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    تاريخها 3
                                </td>
                                <td>
                                    <?php echo $data['course_date_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    مكانها 3
                                </td>
                                <td>
                                    <?php echo $data['course_location_3']?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    الدورات التدريبية 4
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    اسم الدوره 4
                                </td>
                                <td>
                                    <?php echo $data['course_name_4']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    المده 4
                                </td>
                                <td>
                                    <?php echo $data['duration_4']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الجهة التي اعدتها 4
                                </td>
                                <td>
                                    <?php echo $data['sponsor_4']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    تاريخها 4
                                </td>
                                <td>
                                    <?php echo $data['course_date_4']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    مكانها 4
                                </td>
                                <td>
                                    <?php echo $data['course_location_4']?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    الدورات التدريبية 5
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    اسم الدوره 5
                                </td>
                                <td>
                                    <?php echo $data['course_name_5']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    المده 5
                                </td>
                                <td>
                                    <?php echo $data['duration_5']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الجهة التي اعدتها 5
                                </td>
                                <td>
                                    <?php echo $data['sponsor_5']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    تاريخها 5
                                </td>
                                <td>
                                    <?php echo $data['course_date_5']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    مكانها 5
                                </td>
                                <td>
                                    <?php echo $data['course_location_5']?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    الوظائف الأخيرة 1
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    اسم الجهة 1
                                </td>
                                <td>
                                    <?php echo $data['employer_name_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    اسم الوظيفة 1
                                </td>
                                <td>
                                    <?php echo $data['positica_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    التاريخ من 1
                                </td>
                                <td>
                                    <?php echo $data['date_from_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    التاريخ الي 1
                                </td>
                                <td>
                                    <?php echo $data['date_to_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الراتب الاساسي 1
                                </td>
                                <td>
                                    <?="$data[basic_salary_1]"?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    سبب ترك الوظيفة 1
                                </td>
                                <td>
                                    <?="$data[reason_for_leaving_1]"?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    الوظائف الأخيرة 2
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    اسم الجهة 2
                                </td>
                                <td>
                                    <?php echo $data['employer_name_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    اسم الوظيفة 2
                                </td>
                                <td>
                                    <?php echo $data['positica_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    التاريخ من 2
                                </td>
                                <td>
                                    <?php echo $data['date_from_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    التاريخ الي 2
                                </td>
                                <td>
                                    <?php echo $data['date_to_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الراتب الاساسي 2
                                </td>
                                <td>
                                    <?="$data[basic_salary_2]" ?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    سبب ترك الوظيفة 2
                                </td>
                                <td>
                                    <?="$data[reason_for_leaving_2]" ?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    الوظائف الأخيرة 3
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    اسم الجهة 3
                                </td>
                                <td>
                                    <?php echo $data['employer_name_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    اسم الوظيفة 3
                                </td>
                                <td>
                                    <?php echo $data['positica_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    التاريخ من 3
                                </td>
                                <td>
                                    <?php echo $data['date_from_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    التاريخ الي 3
                                </td>
                                <td>
                                    <?php echo $data['date_to_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الراتب الاساسي 3
                                </td>
                                <td>
                                    <?="$data[basic_salary_3]" ?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    سبب ترك الوظيفة 3
                                </td>
                                <td>
                                    <?="$data[reason_for_leaving_3]" ?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    الوظائف الأخيرة 4
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    اسم الجهة 4
                                </td>
                                <td>
                                    <?php echo $data['employer_name_4']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    اسم الوظيفة 4
                                </td>
                                <td>
                                    <?php echo $data['positica_4']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    التاريخ من 4
                                </td>
                                <td>
                                    <?php echo $data['date_from_4']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    التاريخ الي 4
                                </td>
                                <td>
                                    <?php echo $data['date_to_4']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الراتب الاساسي 4
                                </td>
                                <td>
                                    <?="$data[basic_salary_4]" ?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    سبب ترك الوظيفة 4
                                </td>
                                <td>
                                    <?="$data[reason_for_leaving_4]" ?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    إجمالي الدخل الشهري لأخر وظيفة
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    الراتب الأخير
                                </td>
                                <td>
                                    <?php echo $data['last_sallary']?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    المهارات
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    مهارة 1
                                </td>
                                <td>
                                    <?php echo $data['skills_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    مهارة 2
                                </td>
                                <td>
                                    <?php echo $data['skills_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    مهارة 3
                                </td>
                                <td>
                                    <?php echo $data['skills_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    مهارة 4
                                </td>
                                <td>
                                    <?php echo $data['skills_4']?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    اللغة العربية
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    القراءة
                                </td>
                                <td>
                                    <?php echo $data['arabic_reading']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الكتابة
                                </td>
                                <td>
                                    <?php echo $data['arabic_writing']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    التحدث
                                </td>
                                <td>
                                    <?php echo $data['arabic_speaking']?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    اللغة الإنجليزية
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    القراءة
                                </td>
                                <td>
                                    <?php echo $data['english_reading']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الكتابة
                                </td>
                                <td>
                                    <?php echo $data['english_writing']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    التحدث
                                </td>
                                <td>
                                    <?php echo $data['english_speaking']?>
                                </td>
                            </tr>
                        </table>
                        <table class="no">
                            <tr>
                                <th colspan='12'>
                                    الهوايات
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    الهواية 1
                                </td>
                                <td>
                                    <?php echo $data['hobbies_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الهواية 2
                                </td>
                                <td>
                                    <?php echo $data['hobbies_2']?>
                                </td>
                            </tr>
                        </table>
                        <table class="no">
                            <tr>
                                <th colspan='12'>
                                    اشخاص بأمكاننا الأتصال بهم وقت الضرورة
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    اسم الشخص 1
                                </td>
                                <td>
                                    <?php echo $data['person_name_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    صله القرابة 1
                                </td>
                                <td>
                                    <?php echo $data['person_relationship_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    رقم الهاتف 1
                                </td>
                                <td>
                                    <?php echo $data['person_phone_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    العنوان 1
                                </td>
                                <td>
                                    <?php echo $data['person_address_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    اسم الشخص 2
                                </td>
                                <td>
                                    <?php echo $data['person_name_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    صلة القرابة 2
                                </td>
                                <td>
                                    <?php echo $data['person_relationship_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    رقم الهاتف 2
                                </td>
                                <td>
                                    <?php echo $data['person_phone_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    العنوان 2
                                </td>
                                <td>
                                    <?php echo $data['person_address_2']?>
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
                    </div>
                </div>
            </div>
        </div>
        <!-- js files -->
        <?php
            include '../../addition/settings.php';
        ?>
        <!-- alert -->
        <div class="alert alert-success d-none" role="alert" id="alert"></div>
        <!-- js files -->
        <script src='../../js/logout_2.js'></script>
        <script src='../../js/main.js'></script>
        <script src='../../js/jquery-3.7.0.min.js'></script>
        <script src='../../js/popper.min.js'></script>
        <script src='../../js/bootstrap.js'></script>
        <script src='../../js/all.min.js'></script>
        <script src='../../js/menu.js'></script>
        <script src='../../js/staff_data.js'></script>
        <script src='../../js/unpkg.com_xlsx@0.15.1_dist_xlsx.full.min.js'></script>
        <script src='../../js/pdf.bundle.min.js'></script>
        <script src='../../js/pdf.bundle.js'></script>
        <script>
            // منع الرجوع للصفحة السابقة
            if (window.history && window.history.pushState) {
                window.history.pushState(null, null, window.location.href);
                window.onpopstate = function () {
                    window.history.pushState(null, null, window.location.href);
                };
            }

            if(<?php echo $user['ability']?> == true){
                document.querySelector('.settings').style.display = 'block';
            }else{
                document.querySelector('.settings').style.display = 'none';
            }
        </script>
    </body>
</html>