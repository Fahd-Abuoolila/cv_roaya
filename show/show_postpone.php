<?php
    if (!isset($_GET['employid'])) {
        header("Location: ../index");
        exit();
    }
    include '../php/session.php';

    if (!isset($_SESSION['employ'])) {
        header("Location: ../index");
        exit();
    }

    $employ_data = $_SESSION['employ'];

    if ($_GET['employid'] != $employ_data['employ_id']) {
        header("Location: ../index");
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
        <link rel='icon' href='../img/logo_icon.png'>
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
            require('../inc/config.php');
            $IDuse = $_GET['employid'];
            $item = mysqli_query($conection, "SELECT * FROM employs WHERE employ_id=$IDuse");
            $employ = mysqli_fetch_array($item);

            $ID = $_POST['id'];
            $select = mysqli_query($conection, "SELECT * FROM employee_postpone WHERE employ_id=$ID");
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
                                                <?php echo $employ['employ_name']?>
                                            </p>
                                        </a>
                                        <div class='dropdown-divider m-0'></div>
                                        <a class='dropdown-item' id="email" onclick="copyToClipboard(this.id)">
                                            <i class="fa-regular fa-envelope"></i>
                                            <p class='mx-2'>
                                                <?php echo $employ['employ_email']?>
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
                include '../addition/menu.php';
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
                        <span style="color: #007bff;">
                            <?php echo $data['employ_name']?> 
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
                                    <?php echo $data['employ_name']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    صورة الموظف
                                </td>
                                <td>
                                    <img style='height: 260px;' src='../uploads/<?php echo $data['photoOFemploy']?>'>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    البريد الإلكتروني
                                </td>
                                <td>
                                    <?php echo $data['employ_email']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الوظيفة المطلوبة
                                </td>
                                <td>
                                    <?php echo $data['job_name']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الموقف من التجنيد
                                </td>
                                <td>
                                    <?php echo $data['enlistment']?>
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
                                    الديانة
                                </td>
                                <td>
                                    <?php echo $data['religion']?>
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
                                    تاريخ الميلاد
                                </td>
                                <td>
                                    <?php echo $data['dateOFbirth']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    محل الميلاد
                                </td>
                                <td>
                                    <?php echo $data['placeOFbirth']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    العنوان
                                </td>
                                <td>
                                    <?php echo $data['address']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    شارع
                                </td>
                                <td>
                                    <?php echo $data['address_street']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    رقم الهاتف
                                </td>
                                <td>
                                    <?php echo $data['numberOFphpne']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    صورة البطاقة 
                                </td>
                                <td class='d-flex'>
                                    <img class='w-50' src='../uploads/<?php echo $data['frontOFcard']?>'>
                                    <img class='w-50' src='../uploads/<?php echo $data['backOFcard']?>'>
                                </td>
                            </tr>
                        </table>
                        <table class="space" style='opacity: 0; border:none;'></table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    المؤهلات العملية
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    جهة الدراسة
                                </td>
                                <td>
                                    <?php echo $data['sideOFstudy']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    التخصص
                                </td>
                                <td>
                                    <?php echo $data['specialization']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    سنه التخرج
                                </td>
                                <td>
                                    <?php echo $data['graduation_year']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    المؤهل الدراسي
                                </td>
                                <td>
                                    <?php echo $data['educational_qualification']?>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr class="no">
                                <th colspan='12'>
                                    الدورات التدريبية
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    اسم الدورة
                                </td>
                                <td>
                                    <?php echo $data['course_name']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    مكان الدورة
                                </td>
                                <td>
                                    <?php echo $data['course_location']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    مده الدورة
                                </td>
                                <td>
                                    <?php echo $data['course_duration']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    نوع الشهادة
                                </td>
                                <td>
                                    <?php echo $data['typeOFcertificate']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    صورة شهادة الدورات التدريبية
                                </td>
                                <td>
                                    <img style='width: 100%;height: 700px;' src='../uploads/<?php echo $data['photoOFcertificate']?>'>
                                </td>
                            </tr>
                        </table>
                        <table class="space2" style='opacity: 0; border:none;'></table>
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
                                    <?php echo $data['job_name_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    جهة العمل
                                </td>
                                <td>
                                    <?php echo $data['job_duration_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الفترة من
                                </td>
                                <td>
                                    <?php echo $data['pointOFstart_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الي
                                </td>
                                <td>
                                    <?php echo $data['pointOFend_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الراتب
                                </td>
                                <td>
                                    <?php echo $data['salary_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    سبب ترك العمل
                                </td>
                                <td>
                                    <?php echo $data['reasonFORleaving_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    هل تعمل في الوقت الحالي
                                </td>
                                <td>
                                    <?php echo $data['do_you_work_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    صورة شهادة الخبرة العملية 
                                </td>
                                <td>
                                    <img style='width: 100%;height: 500px;' src="../uploads/<?php echo $data['attached_1']?>">
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    الواجبات و المسئوليات اثناء عملك
                                </td>
                                <td>
                                    <?php echo $data['responsibilities_1']?>
                                </td>
                            </tr>
                        </table>
                        <table class="space3" style='opacity: 0; border:none;'></table>
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
                        <table class="space4" style='opacity: 0; border:none;'></table>
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
                        <table class="space5" style='opacity: 0; border:none;'></table>
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
                        <table class="space6" style='opacity: 0; border:none;'></table>
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
                                    <?php echo $data['person_employer_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    عنوان الاتصال
                                </td>
                                <td>
                                    <?php echo $data['person_address_1']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    رقم الهاتف
                                </td>
                                <td>
                                    <?php echo $data['person_phone_1']?>
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
                                    <?php echo $data['person_employer_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    عنوان الاتصال
                                </td>
                                <td>
                                    <?php echo $data['person_address_2']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    رقم الهاتف
                                </td>
                                <td>
                                    <?php echo $data['person_phone_2']?>
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
                                    <?php echo $data['person_name_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الوظيفة
                                </td>
                                <td>
                                    <?php echo $data['person_employer_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    عنوان الاتصال
                                </td>
                                <td>
                                    <?php echo $data['person_address_3']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    رقم الهاتف
                                </td>
                                <td>
                                    <?php echo $data['person_phone_3']?>
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
            name.innerHTML = "<?php echo $employ['employ_name']?>";
        </script>
        <script>
            if(<?php echo $employ['ability']?> == true){
                document.querySelector('.settings').style.display = 'block';
            }else{
                document.querySelector('.settings').style.display = 'none';
            }
        </script>
    </body>
</html>