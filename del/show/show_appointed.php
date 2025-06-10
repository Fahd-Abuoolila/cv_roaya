<?php
    if (!isset($_GET['employid'])) {
        header("Location: ../../index");
        exit();
    }
    include '../../php/session.php';
    if (!isset($_SESSION['employ'])) {
        header("Location: ../../index");
        exit();
    }
    $employ_data = $_SESSION['employ'];
    if ($_GET['employid'] != $employ_data['employ_id']) {
        header("Location: ../../index");
        exit();
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
        <link rel='icon' href='../../img/logo_icon.png'>
        <!-- link css -->
        <link rel='stylesheet' href='../../css/style.css'>
        <link rel='stylesheet' href='../../css/staff_data.css'>
        <link rel='stylesheet' href='../../css/menu.css'>
        <link rel='stylesheet' href='../../css/all.min.css'>
        <link rel='stylesheet' href='../../css/bootstrap.css'>
        <title>Theqa Pay</title>
    </head>
    <body>
        <?php
            require('../../inc/config.php');
            $IDuse = $_GET['userid'];
            $item = mysqli_query($conection, "SELECT * FROM users WHERE user_id=$IDuse");
            $user = mysqli_fetch_array($item);

            $ID = $_POST['id'];
            $select = mysqli_query($conection, "SELECT * FROM delete_appointed WHERE user_id=$ID");
            $data = mysqli_fetch_array($select);
        ?>
        <!-- header -->
        <div class='header'>
            <div>
                <a href='../../index.php' class='navbar-brand'>
                    <img src='../../img/logo.png' alt='' draggable='false'>
                </a>
                <div id='nav'> 
                    <div class='collapse navbar-collapse mx-2'>
                        <div>
                            <div class='dropdowns'>
                                <div class='dropdown mx-2 my-2'>
                                    <button class='btn dropdown-toggle' type='button' data-toggle='dropdown' aria-expanded='false'>
                                        <span id='User_Name_Show'></span>
                                    </button>
                                    <div class='dropdown-menu'>
                                        <a class='dropdown-item' id="name" onclick="copyToClipboard(this.id)">
                                            <i class='fa fa-user text-dark'></i>
                                            <p class='mx-2'>
                                                <?php echo $user['user_name']?>
                                            </p>
                                        </a>
                                        <div class='dropdown-divider m-0'></div>
                                        <a class='dropdown-item' id="email" onclick="copyToClipboard(this.id)">
                                            <i class="fa-regular fa-envelope"></i>
                                            <p class='mx-2'>
                                                <?php echo $user['user_email']?>
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
            <?php 
                include '../../php/addition/menu.php';
            ?>
            <!-- show-board -->
            <div class='data-info'>
                <div class='container' id="employee_specific" name='employee_specific'>
                    <div>
                        <p class='title text-dark text-center w-100'> شركــة رؤيــــة باي لحلول السداد و البرمجيات
                            ش . م . م</p>
                        <img src='../img/logo.png' alt="" draggable='false'>
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
                                <?php echo $data['first_name'] . ' ' . $data['second_name']. ' ' . $data['third_name']. ' ' . $data['last_name']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                الرقم القومي
                            </td>
                            <td>
                                <?php echo $data['national_id']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                تاريخ الأصدار 
                            </td>
                            <td>
                                <?php echo $data['date_of_issue']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                مكان الأصدار 
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
                                الحالة الأجتماعية
                            </td>
                            <td>
                                <?php echo $data['marital_status']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                عدد الأطفال
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
                                صورة شخصية
                            </td>
                            <td class='d-flex'>
                                <img class='w-50' src='../uploads/<?php echo __DIR__ . $data['photoOFuser_up']?>'>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                صورة البطاقة
                            </td>
                            <td class='d-flex'>
                                <img class='w-50' src='<?php echo __DIR__ . $data['frontOFcard_up']?>'>
                                <img class='w-50' src='<?php echo __DIR__ . $data['backOFcard_up']?>'>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                رقــم الهــاتـف 1
                            </td>
                            <td>
                                <?php echo $data['number_tel_1']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                رقــم الهــاتـف  2
                            </td>
                            <td>
                                <?php echo $data['number_tel_2']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                محل السكن
                            </td>
                            <td>
                                <?php echo $data['place_of_residence']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                محافظة
                            </td>
                            <td>
                                <?php echo $data['governorate']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                الحي
                            </td>
                            <td>
                                <?php echo $data['centre']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                الرمز البريدي
                            </td>
                            <td>
                                <?php echo $data['area_code']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                البريد الألكتروني 
                            </td>
                            <td>
                                <?php echo $data['employ_email']?>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr class='no'>
                            <th colspan='12'>
                                المؤهلات العلمية 1
                            </th>
                        </tr>
                        <tr>
                            <td>
                                لامؤهل العلمي  1
                            </td>
                            <td>
                                <?=$data['academic_qualification_1']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                اسم الجامعة 1
                            </td>
                            <td>
                                <?=$data['university_1']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                مكانها 1
                            </td>
                            <td>
                                <?=$data['locition_1']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                مدة الدراسة 1
                            </td>
                            <td>
                                <?=$data['num_of_years_1']?>
                            </td>
                        </tr>
                        <tr>
                            <td >
                                المعدل التراكمي 1
                            </td>
                            <td>
                                <?=$data['gpa_1']?>
                            </td>
                        </tr>
                        <tr>
                            <td >
                                سنة التخرج 1
                            </td>
                            <td>
                                <?=$data['year_graduated_1']?>
                            </td>
                        </tr>
                    </table>
                    <?php
                        if($data['academic_qualification_2'] != '' || $data['academic_qualification_2'] != null){
                            echo "
                                <table>
                                    <tr class='no'>
                                        <th colspan='12'>
                                            المؤهلات العلمية 2
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            لامؤهل العلمي  2
                                        </td>
                                        <td>
                                            $data[academic_qualification_1]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            اسم الجامعة 2
                                        </td>
                                        <td>
                                            $data[university_2]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            مكانها 2
                                        </td>
                                        <td>
                                            $data[locition_2]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            الدراسة 2
                                        </td>
                                        <td>
                                            $data[num_of_years_2]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >
                                            المعدل التراكمي 2
                                        </td>
                                        <td>
                                            $data[gpa_2]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >
                                            سنة التخرج 2
                                        </td>
                                        <td>
                                            $data[year_graduated_2]
                                        </td>
                                    </tr>
                                </table>
                            ";
                        }
                    ?>
                    <?php
                        if($data['academic_qualification_3'] != '' || $data['academic_qualification_3'] != null){
                            echo "
                                <table>
                                    <tr class='no'>
                                        <th colspan='12'>
                                            المؤهلات العلمية 3
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            لامؤهل العلمي  3
                                        </td>
                                        <td>
                                            $data[academic_qualification_3]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            اسم الجامعة 3
                                        </td>
                                        <td>
                                            $data[university_3]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            مكانها 3
                                        </td>
                                        <td>
                                            $data[locition_3]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            الدراسة 3
                                        </td>
                                        <td>
                                            $data[num_of_years_3]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >
                                            المعدل التراكمي 3
                                        </td>
                                        <td>
                                            $data[gpa_3]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >
                                            سنة التخرج 3
                                        </td>
                                        <td>
                                            $data[year_graduated_3]
                                        </td>
                                    </tr>
                                </table>
                            ";
                        }
                    ?>
                    <table>
                        <tr class='no'>
                            <th colspan='12'>
                                الدورات التدريبية  1
                            </th>
                        </tr>
                        <tr>
                            <td>
                                اسم الدورة   1
                            </td>
                            <td>
                                <?=$data['course_name_1']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                المدة 1
                            </td>
                            <td>
                                <?=$data['duration_1']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                الجهة التى اعدتها 1
                            </td>
                            <td>
                                <?=$data['sponsor_1']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                تاريخها 1
                            </td>
                            <td>
                                <?=$data['course_date_1']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                مكانها  1
                            </td>
                            <td>
                                <?=$data['course_location_1']?>
                            </td>
                        </tr>
                    </table>
                    <?php
                        if($data['course_name_2'] != '' || $data['course_name_2'] != null){
                            echo "
                                <table>
                                    <tr class='no'>
                                        <th colspan='12'>
                                            الدورات التدريبية  2
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            اسم الدورة   2
                                        </td>
                                        <td>
                                            $data[course_name_2]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            المدة 2
                                        </td>
                                        <td>
                                            $data[duration_2]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            الجهة التى اعدتها 2
                                        </td>
                                        <td>
                                            $data[sponsor_2]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            تاريخها 2
                                        </td>
                                        <td>
                                            $data[course_date_2]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            مكانها  2
                                        </td>
                                        <td>
                                            $data[course_location_2]
                                        </td>
                                    </tr>
                                </table>
                            ";
                        }
                    ?>
                    <?php
                        if($data['course_name_3'] != '' || $data['course_name_3'] != null){
                            echo "
                                <table>
                                    <tr class='no'>
                                        <th colspan='12'>
                                            الدورات التدريبية  3
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            اسم الدورة   3
                                        </td>
                                        <td>
                                            $data[course_name_3]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            المدة 3
                                        </td>
                                        <td>
                                            $data[duration_3]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            الجهة التى اعدتها 3
                                        </td>
                                        <td>
                                            $data[sponsor_3]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            تاريخها 3
                                        </td>
                                        <td>
                                            $data[course_date_3]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            مكانها  3
                                        </td>
                                        <td>
                                            $data[course_location_3]
                                        </td>
                                    </tr>
                                </table>
                            ";
                        }
                    ?>
                    <?php
                        if($data['course_name_4'] != '' || $data['course_name_4'] != null){
                            echo "
                                <table>
                                    <tr class='no'>
                                        <th colspan='12'>
                                            الدورات التدريبية  4
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            اسم الدورة   4
                                        </td>
                                        <td>
                                            $data[course_name_4]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            المدة 1
                                        </td>
                                        <td>
                                            $data[duration_4]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            الجهة التى اعدتها 1
                                        </td>
                                        <td>
                                            $data[sponsor_4]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            تاريخها 1
                                        </td>
                                        <td>
                                            $data[course_date_4]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            مكانها  1
                                        </td>
                                        <td>
                                            $data[course_location_4]
                                        </td>
                                    </tr>
                                </table>
                            ";
                        }
                    ?>
                    <?php
                        if($data['course_name_5'] != '' || $data['course_name_5'] != null){
                            echo "
                                <table>
                                    <tr class='no'>
                                        <th colspan='12'>
                                            الدورات التدريبية  5
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            اسم الدورة   5
                                        </td>
                                        <td>
                                            $data[course_name_5]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            المدة 5
                                        </td>
                                        <td>
                                            $data[duration_5]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            الجهة التى اعدتها 5
                                        </td>
                                        <td>
                                            $data[sponsor_5]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            تاريخها 5
                                        </td>
                                        <td>
                                            $data[course_date_5]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            مكانها  5
                                        </td>
                                        <td>
                                            $data[course_location_5]
                                        </td>
                                    </tr>
                                </table>
                            ";
                        }
                    ?>
                    <table>
                        <tr class='no'>
                            <th colspan='12'>
                                1 الوظائف الاخيرة
                            </th>
                        </tr>
                        <tr>
                            <td>
                                اسم الجهة 1
                            </td>
                            <td>
                                <?=$data['employer_name_1']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                اسم الوظيفة 1
                            </td>
                            <td>
                                <?=$data['positica_1']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                التاريخ من 1
                            </td>
                            <td>
                                <?=$data['date_from_1']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                التاريخ إلي 1
                            </td>
                            <td>
                                <?=$data['date_to_1']?>
                            </td>
                        </tr>
                        <tr>
                            <td >
                                الراتب الأساسي 1
                            </td>
                            <td>
                                <?=$data['basic_salary_1']?>
                            </td>
                        </tr>
                        <tr>
                            <td >
                                سبب ترك الوظيفة 1
                            </td>
                            <td>
                                <?=$data['reason_for_leaving_1']?>
                            </td>
                        </tr>
                    </table>
                    <?php
                        if($data['employer_name_2'] != '' || $data['employer_name_2'] != null){
                            echo "
                                <table>
                                    <tr class='no'>
                                        <th colspan='12'>
                                            2 الوظائف الاخيرة
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            اسم الجهة 2
                                        </td>
                                        <td>
                                            $data[employer_name_2]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            اسم الوظيفة 2
                                        </td>
                                        <td>
                                            $data[positica_2]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            التاريخ من 2
                                        </td>
                                        <td>
                                            $data[date_from_2]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            التاريخ إلي 2
                                        </td>
                                        <td>
                                            $data[date_to_2]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >
                                            الراتب الأساسي 2
                                        </td>
                                        <td>
                                            $data[basic_salary_2]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >
                                            سبب ترك الوظيفة 2
                                        </td>
                                        <td>
                                            $data[reason_for_leaving_2]
                                        </td>
                                    </tr>
                                </table>
                            ";
                        }
                    ?>
                    <?php
                        if($data['employer_name_3'] != '' || $data['employer_name_3'] != null){
                            echo "
                                <table>
                                    <tr class='no'>
                                        <th colspan='12'>
                                            3 الوظائف الاخيرة
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            اسم الجهة 3
                                        </td>
                                        <td>
                                            $data[employer_name_3]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            اسم الوظيفة 3
                                        </td>
                                        <td>
                                            $data[positica_3]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            التاريخ من 3
                                        </td>
                                        <td>
                                            $data[date_from_3]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            التاريخ إلي 3
                                        </td>
                                        <td>
                                            $data[date_to_3]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >
                                            الراتب الأساسي 3
                                        </td>
                                        <td>
                                            $data[basic_salary_3]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >
                                            سبب ترك الوظيفة 3
                                        </td>
                                        <td>
                                            $data[reason_for_leaving_3]
                                        </td>
                                    </tr>
                                </table>
                            ";
                        }
                    ?>
                    <?php
                        if($data['employer_name_4'] != '' || $data['employer_name_4'] != null){
                            echo "
                                <table>
                                    <tr class='no'>
                                        <th colspan='12'>
                                            4 الوظائف الاخيرة
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            اسم الجهة 4
                                        </td>
                                        <td>
                                            $data[employer_name_4]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            اسم الوظيفة 4
                                        </td>
                                        <td>
                                            $data[positica_4]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            التاريخ من 4
                                        </td>
                                        <td>
                                            $data[date_from_4]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            التاريخ إلي 4
                                        </td>
                                        <td>
                                            $data[date_to_4]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            الراتب الأساسي 4
                                        </td>
                                        <td>
                                            $data[basic_salary_4]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            سبب ترك الوظيفة 4
                                        </td>
                                        <td>
                                            $data[reason_for_leaving_4]
                                        </td>
                                    </tr>
                                </table>
                            ";
                        }
                    ?>
                    <table>
                        <tr class='no'>
                            <th colspan='12'>
                                إجمالي الدخل الشهري لأخر وظيفة
                            </th>
                        </tr>
                        <tr>
                            <td>
                                الراتب الاخير
                            </td>
                            <td>
                                <?=$data['last_sallary']?>
                            </td>
                        </tr>
                    </table>
                    <?php
                        if($data['skills_1'] != '' || $data['skills_1'] != null){
                            echo "
                                <table>
                                    <tr>
                                        <td>
                                            المهارة 1
                                        </td>
                                        <td>
                                            $data[skills_1]
                                        </td>
                                    </tr>
                                </table>
                            ";
                        }
                    ?>
                    <?php
                        if($data['skills_2'] != '' || $data['skills_2'] != null){
                            echo "
                                <table>
                                    <tr>
                                        <td>
                                            المهارة 2
                                        </td>
                                        <td>
                                            $data[skills_2]
                                        </td>
                                    </tr>
                                </table>
                            ";
                        }
                    ?>
                    <?php
                        if($data['skills_3'] != '' || $data['skills_3'] != null){
                            echo "
                                <table>
                                    <tr>
                                        <td>
                                            المهارة 3
                                        </td>
                                        <td>
                                            $data[skills_3]
                                        </td>
                                    </tr>
                                </table>
                            ";
                        }
                    ?>
                    <?php
                        if($data['skills_4'] != '' || $data['skills_4'] != null){
                            echo "
                                <table>
                                    <tr>
                                        <td>
                                            المهارة 4
                                        </td>
                                        <td>
                                            $data[skills_4]
                                        </td>
                                    </tr>
                                </table>
                            ";
                        }
                    ?>
                    <table>
                        <tr class='no'>
                            <th colspan='12'>
                                اللغة العربية
                            </th>
                        </tr>
                        <tr>
                            <td>
                                القراءة
                            </td>
                            <td>
                                <?=$data['arabic_reading']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                الكتابة
                            </td>
                            <td>
                                <?=$data['arabic_writing']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                التحدث
                            </td>
                            <td>
                                <?=$data['arabic_speaking']?>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr class='no'>
                            <th colspan='12'>
                                اللغة الإنجليزية
                            </th>
                        </tr>
                        <tr>
                            <td>
                                القراءة
                            </td>
                            <td>
                                <?=$data['english_reading']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                الكتابة
                            </td>
                            <td>
                                <?=$data['english_writing']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                التحدث
                            </td>
                            <td>
                                <?=$data['english_speaking']?>
                            </td>
                        </tr>
                    </table>
                    <?php
                        if($data['hobbies_1'] != '' || $data['hobbies_1'] != null){
                            echo "
                                <table>
                                    <tr>
                                        <td>
                                            الهواية 1
                                        </td>
                                        <td>
                                            $data[hobbies_1]
                                        </td>
                                    </tr>
                                </table>
                            ";
                        }
                    ?>
                    <?php
                        if($data['hobbies_2'] != '' || $data['hobbies_2'] != null){
                            echo "
                                <table>
                                    <tr>
                                        <td>
                                            الهواية 2
                                        </td>
                                        <td>
                                            $data[hobbies_2]
                                        </td>
                                    </tr>
                                </table>
                            ";
                        }
                    ?>
                    <table>
                        <tr class='no'>
                            <th colspan='12'>
                                اشخاص بأمكاننا الأتصال بهم وقت الضرورة 1
                            </th>
                        </tr>
                        <tr>
                            <td>
                                اسم الشخص 1
                            </td>
                            <td>
                                <?=$data['person_name_1']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                صلة القرابة 1
                            </td>
                            <td>
                                <?=$data['person_relationship_1']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                رقم الهاتف 1
                            </td>
                            <td>
                                <?=$data['person_phone_1']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                العنوان 1
                            </td>
                            <td>
                                <?=$data['person_address_1']?>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr class='no'>
                            <th colspan='12'>
                                اشخاص بأمكاننا الأتصال بهم وقت الضرورة 2
                            </th>
                        </tr>
                        <tr>
                            <td>
                                اسم الشخص 2
                            </td>
                            <td>
                                <?=$data['person_name_2']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                صلة القرابة 2
                            </td>
                            <td>
                                <?=$data['person_relationship_2']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                رقم الهاتف 2
                            </td>
                            <td>
                                <?=$data['person_phone_2']?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                العنوان 2
                            </td>
                            <td>
                                <?=$data['person_address_2']?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- js files -->
        <!-- <script>
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
                    filename: 'استمارة طلب وظيفة--<?php echo $data['user_name']?>.pdf',
                    image: { type: 'jpeg', quality: 1 },
                    html2canvas: { scale: 3 },
                    jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
                };
                pdf(table, opt);
            }
            exportButton.onclick = function(){
                ExportToPDF();
            }
        </script> -->
        <!-- alert -->
        <div class="alert alert-success d-none" role="alert" id="alert"></div>
        <!-- js files -->
        <script src='../../js/logout_3.js'></script>
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
            let name =document.querySelector('#User_Name_Show');
            name.innerHTML = "<?php echo $user['user_name']?>";
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