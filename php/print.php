<?php
    use Knp\Snappy\Pdf;
    if(isset($_GET['export'])){
        require('../inc/config.php');
        $ID = $_GET['data_id'];
        $from_table = $_GET['from_table'];

        $select = mysqli_query($conection, "SELECT * FROM $from_table WHERE employ_id=$ID");
        $data = mysqli_fetch_array($select);

        $name = $data['first_name'] . ' ' . $data['second_name']. ' ' . $data['third_name']. ' ' . $data['last_name'];
        $name = str_replace(" ", "_", $name);
        
        require 'pdf/vendor/autoload.php';
        
        
        $snappy = new Pdf(__DIR__ . '/pdf/wkhtmltox/bin/wkhtmltopdf.exe');
        
        
        $snappy->setOption('page-size', 'A4');
        $snappy->setOption('zoom', 1.0);
        
        $snappy->setOption('no-images', false); // تأكد أن الصور مسموح بها
        $snappy->setOption('enable-local-file-access', true); // ضروري لو الصور محلية
        
        $snappy->setOption('encoding', 'UTF-8');
        $snappy->setOption('enable-local-file-access', true); // مهم إذا استخدمت CSS أو خط خارجي
        
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="'. $name .'_CV.pdf"');
        
        
        // HTML فيه نص عربي + خط يدعم العربية
        $html = '
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="description" content="Free Web tutorials">
                    <meta name="keywords" content="HTML, CSS, JavaScript">
                    <meta name="autdor" content="John Doe">
                    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
                    <link rel="icon" href="C:\xampp\htdocs\work_FAHD\roaya_form\img\Roaya_icon.png">
                    <title>Print CV</title>
                    <style>
                        @import url("https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap");
        
                        body {
                            direction: rtl;
                            font-family: "Cairo", sans-serif;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            flex-direction: column;
                        }
                    </style>
                </head>
                <body>
                    <div class="div_1" style="width: 100%; text-align: center; line-height: 15px;">
                        <h2>نموذج السيرة الذاتية</h2>
                        <h2>Personal History Form</h2>
                    </div>
                    <table style="width: 100%; border: 2px solid black; border-collapse: collapse; text-align: center;">
                        <tr>
                            <td style="width: 33%; border: 2px solid black;">
                                <div style="font-weight: bold;color: #5baa59;">رؤية باي لحلول السداد و البرمجيات</div>
                                <div style="margin-top: 10px;">إدارة الموارد البشرية</div>
                            </td>
                            <td style="width: 34%; border: 2px solid black;">
                                <img src="C:\xampp\htdocs\work_FAHD\roaya_form\img\Roaya.png" style="margin-top: 10px; width: 250px; height: auto;" />
                            </td>
                            <td style="width: 33%; border: 2px solid black;">
                                <div style="font-weight: bold;">Roaya Pay for Payment Solutions<br>and Software</div>
                                <div style="margin-top: 10px;">Human Resources Management</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 33%; border: 2px solid black; text-align: center;padding: 5px 0;" colspan="3">
                                <span style="font-weight: bold;color:#005db4;"> طلب توظيف في شركة رؤية باي لحلول السداد و البرمجيات </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 33%; border: 2px solid black; text-align: right; " colspan="3">
                                <span style="font-weight: bold; margin-right: 25px; margin-left: 550px;"> معلومات شخصية </span>
                                <span style="font-weight: bold;"> Personal Information </span>
                            </td>
                        </tr>
                    </table>
                ';
        $html .= "
            <table style='width: 100%; border: 2px solid black; border-collapse: collapse; text-align: center;'>
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                        <span style='margin-right: 5px; margin-left: 30px;' >الأسم الأول</span>
                        <span  >First Name</span>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                        <span style='margin-right: 5px; margin-left: 30px;'>أسم الأب</span>
                        <span >Middle Name</span>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                        <span style='margin-right: 1px; margin-left: 6px;'>أسم الجد</span>
                        <span >Grand Father". "'" . "s  Name</span>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                        <span style='margin-right: 1px; margin-left: 6px;'>أسم العائلة</span>
                        <span >Family Name</span>
                    </td>
                </tr>
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        {$data['first_name']}
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        {$data['second_name']}
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        {$data['third_name']}
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        {$data['last_name']}
                    </td>
                </tr>
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                        <span style='margin-right: 5px; margin-left: 30px;' > الرقم القومي</span>
                        <span  > National ID</span>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                        <span style='margin-right: 5px; margin-left: 30px;'> تاريخ الاصدار</span>
                        <span > Date of Issue</span>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                        <span style='margin-right: 1px; margin-left: 6px;'> مكان الأصدار</span>
                        <span > Place of Issue</span>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                        <span style='margin-right: 1px; margin-left: 6px;'> الجنسية</span>
                        <span > Nationality</span>
                    </td>
                </tr>
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        {$data['national_id']}
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        {$data['date_of_issue']}
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        {$data['place_of_issue']}
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        {$data['nationality']}
                    </td>
                </tr>

                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                        <span style='margin-right: 5px; margin-left: 20px;' > مكان الميلاد</span>
                        <span  >Place of Birth</span>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                        <span style='margin-right: 5px; margin-left: 30px;'>تاريخ الميلاد </span>
                        <span >Date of Birth</span>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                        <span style='margin-right: 1px; margin-left: 6px;'> الرقم التأميني  </span>
                        <span style='margin-right: 1px; margin-left: 6px;'> Insurance No.</span>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                        <span style='margin-right: 1px; margin-left: 6px;'> التجنيد </span>
                        <span >conscription</span>
                    </td>
                </tr>
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[place_of_birth]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[date_of_birth]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[insurance_num]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[conscription]
                    </td>
                </tr>

                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd;'colspan='2'>
                        <span style='margin-right: 5px; margin-left: 30px;' >الحالة الأجتماعية </span>
                        <span >Marital Status </span>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                        <span style='margin-right: 1px; margin-left: 6px;'> عدد الأبناء</span>
                        <span >No. of Children</span>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                        <span style='margin-right: 1px; margin-left: 6px;'> الوظيفة المطلوبة </span>
                        <span >Job Required </span>
                    </td>
                </tr>
                <tr class='row'>
        ";
        if($data['marital_status']== 'أعزب'){
            $html .= "
                <td style='width: 25%; border: 2px solid black;'>
                    <span style='margin-right: 1px; margin-left: 6px;'> أعزب </span>
                    <span >
                        <input type='checkbox' checked />
                    </span>
                    <span style='margin-right: 1px; margin-left: 6px;'> Single </span>
                </td>
                <td style='width: 25%; border: 2px solid black;'>
                    <span style='margin-right: 1px; margin-left: 6px;'> متزوج </span>
                    <span >
                        <input type='checkbox' />
                    </span>
                    <span style='margin-right: 1px; margin-left: 6px;'> Married </span>
                </td>
                <td style='width: 25%; border: 2px solid black;'>
                    -
                </td>
            ";
        }else if($data['marital_status'] == 'متزوج'){
            $html .= "
                <td style='width: 25%; border: 2px solid black;'>
                    <span style='margin-right: 1px; margin-left: 6px;'> أعزب </span>
                    <span >
                        <input type='checkbox' />
                    </span>
                    <span style='margin-right: 1px; margin-left: 6px;'> Single </span>
                </td>
                <td style='width: 25%; border: 2px solid black;'>
                    <span style='margin-right: 1px; margin-left: 6px;'> متزوج </span>
                    <span >
                        <input type='checkbox' checked />
                    </span>
                    <span style='margin-right: 1px; margin-left: 6px;'> Married </span>
                </td>
                <td style='width: 25%; border: 2px solid black;'>
                    $data[Num_of_children]
                </td>
            ";
        }
        $html .= "
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[job_required]
                    </td>
                </tr>
            </table>
        ";
        $html .= "
            <table style='width: 100%; border: 2px solid black; border-collapse: collapse; text-align: center;'>
                <tr>
                    <td style='width: 33%; border: 2px solid black; text-align: right; ' colspan='3'>
                        <span style='font-weight: bold; margin-right: 25px; margin-left: 550px;'> معلومات إضافية </span>
                        <span style='font-weight: bold;'> Additional Information </span>
                    </td>
                </tr>

                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                        <span style='margin-right: 5px; margin-left: 30px;' > الهاتف </span>
                        <span  >Tel.No.</span>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                        <span style='margin-right: 5px; margin-left: 30px;'> الهاتف </span>
                        <span >Tel.No.</span>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                        <span style='margin-right: 1px; margin-left: 6px;'> محل السكن </span>
                        <span >Place of Residence</span>
                    </td>
                </tr>
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[number_tel_1]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[number_tel_2]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[place_of_residence]
                    </td>
                </tr>

                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                        <span style='margin-right: 5px; margin-left: 30px;' > مركز / الحي </span>
                        <span  >Centre / City</span>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                        <span style='margin-right: 5px; margin-left: 30px;'> المحاظة </span>
                        <span >Governorate</span>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                        <span style='margin-right: 1px; margin-left: 6px;'> الرمز البريدي </span>
                        <span >Area Code</span>
                    </td>
                </tr>
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[centre]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[governorate]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[area_code]
                    </td>
                </tr>
            </table>
            <table style='width: 100%; border: 2px solid black; border-collapse: collapse; text-align: center;'>
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                        <span style='margin-right: 5px; margin-left: 30px;' > البريد الألكتروني </span>
                    </td>
                    <td style='width: 50%; border: 2px solid black;color: #f00; font-size: 20px;' colspan='2'>
                        $data[employ_email]
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                        <span >Email Address</span>
                    </td>
                </tr>
            </table>
            <table style='width: 100%; border: 2px solid black; border-collapse: collapse; text-align: center;'>
                <tr>
                    <td style='width: 33%; border: 2px solid black; text-align: right; ' colspan='6'>
                        <span style='font-weight: bold; margin-right: 25px; margin-left: 550px;'> المؤهلات العلمية </span>
                        <span style='font-weight: bold;'> Academic Qualifications </span>
                    </td>
                </tr>
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd; line-height: 15px;'>
                        <p > المؤهل العلمي </p>
                        <p  >Academic Qualification</p>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd; line-height: 15px;'>
                        <p > اسم الجامعة </p>
                        <p >University</p>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd; line-height: 15px;'>
                        <p >مكانها</p>
                        <p > locition </p>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd; line-height: 15px;'>
                        <p >مدة الدراسة</p>
                        <p >No. of Years</p>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd; line-height: 15px;'>
                        <p >المعدل التراكمي</p>
                        <p >GPA</p>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd; line-height: 15px;'>
                        <p > سنة التخرج </p>
                        <p >Year Graduated</p>
                    </td>
                </tr>
        ";
        if($data['academic_qualification_1'] != '' || $data['academic_qualification_1'] != null){
            $html .="
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[academic_qualification_1]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[university_1]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[locition_1]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[num_of_years_1]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[gpa_1]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[year_graduated_1]
                    </td>
                </tr>
            ";
        }else{
            $html .="
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                </tr>
            ";
        };
        if($data['academic_qualification_2'] != '' || $data['academic_qualification_2'] != null){
            $html .="
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[academic_qualification_2]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[university_2]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[locition_2]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[num_of_years_2]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[gpa_2]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[year_graduated_2]
                    </td>
                </tr>
            ";
        }else{
            $html .="
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                </tr>
            ";
        };
        if($data['academic_qualification_3'] != '' || $data['academic_qualification_3'] != null){
            $html .="
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[academic_qualification_3]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[university_3]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[locition_3]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[num_of_years_3]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[gpa_3]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[year_graduated_3]
                    </td>
                </tr>
            ";
        }else{
            $html .="
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                </tr>
            ";
        };  
        $html .="
            </table>
        ";
        $html .="
            <table style='width: 100%; border: 2px solid black; border-collapse: collapse; text-align: center;'>
                <tr>
                    <td style='width: 33%; border: 2px solid black; text-align: right; ' colspan='5'>
                        <span style='font-weight: bold; margin-right: 25px; margin-left: 550px;'>  الدورات التدريبية </span>
                        <span style='font-weight: bold;'> Training courses </span>
                    </td>
                </tr>
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd; line-height: 8px;'>
                        <p >  اسم الدورة </p>
                        <p  >Course Name</p>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd; line-height: 8px;'>
                        <p > المده </p>
                        <p >Duration</p>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd; line-height: 8px;'>
                        <p >الجهة التى اعدتها</p>
                        <p > sponsor </p>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd; line-height: 8px;'>
                        <p > تاريخها</p>
                        <p >Date</p>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd; line-height: 8px;'>
                        <p >مكانها</p>
                        <p >Location</p>
                    </td>
                </tr>
        ";
        if($data['course_name_1'] != '' || $data['course_name_1'] != null){
            $html .="
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[course_name_1]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[duration_1]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[sponsor_1]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[course_date_1]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[course_location_1]
                    </td>
                </tr>
            ";
        }else{
            $html .="
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                </tr>
            ";
        }
        if($data['course_name_2'] != '' || $data['course_name_2'] != null){
            $html .="
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[course_name_2]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[duration_2]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[sponsor_2]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[course_date_2]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[course_location_2]
                    </td>
                </tr>
            ";
        }else{
            $html .="
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                </tr>
            ";
        }
        if($data['course_name_3'] != '' || $data['course_name_3'] != null){
            $html .="
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[course_name_3]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[duration_3]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[sponsor_3]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[course_date_3]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[course_location_3]
                    </td>
                </tr>
            ";
        }else{
            $html .="
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                </tr>
            ";
        }
        if($data['course_name_4'] != '' || $data['course_name_4'] != null){
            $html .="
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[course_name_4]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[duration_4]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[sponsor_4]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[course_date_4]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[course_location_4]
                    </td>
                </tr>
            ";
        }else{
            $html .="
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                </tr>
            ";
        }
        if($data['course_name_5'] != '' || $data['course_name_5'] != null){
            $html .="
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[course_name_5]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[duration_5]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[sponsor_5]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[course_date_5]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[course_location_5]
                    </td>
                </tr>
            ";
        }else{
            $html .="
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                </tr>
            ";
        }
        $html .="
            </table>
        ";
        $html .="
            <table style='width: 100%; border: 2px solid black; border-collapse: collapse; text-align: center;margin-bottom: 10px;'>
                <tr>
                    <td style='width: 33%; border: 2px solid black; text-align: right; padding: 9px 0;' colspan='5'>
                        <span style='font-weight: bold; margin-right: 50px;'>توقيع الموظف على بيانات الصفحة الأولى / ..................................................................................... </span>
                    </td>
                </tr>
            </table>
            <table style='width: 100%; border: 2px solid black; border-collapse: collapse; text-align: center;'>
                <tr>
                    <td style='width: 33%; border: 2px solid black; text-align: right; ' colspan='6'>
                        <span style='font-weight: bold; margin-right: 25px; margin-left: 550px;'> الوظائف الاخيرة </span>
                        <span style='font-weight: bold;'> Last Jobs </span>
                    </td>
                </tr>

                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd; line-height: 15px;'>
                        <p >  اسم الجهة </p>
                        <p  >Empolyer Name</p>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd; line-height: 15px;'>
                        <p > اسم الوظيفة </p>
                        <p >Job Name</p>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd; line-height: 15px;'>
                        <p > التاريخ  من </p>
                        <p > Date From</p>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd; line-height: 15px;'>
                        <p > التاريخ  الى </p>
                        <p > Date To</p>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd; line-height: 15px;'>
                        <p >الراتب الأساسي</p>
                        <p > Basic Salary </p>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd; line-height: 15px;'>
                        <p >سبب ترك الوظيفة</p>
                        <p > Reason for Leaving </p>
                    </td>
                </tr>
        ";
        if($data['employer_name_1'] != '' || $data['employer_name_1'] != null){
            $html .="
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[employer_name_1]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[positica_1]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[date_from_1]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[date_to_1]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[basic_salary_1]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[reason_for_leaving_1]
                    </td>
                </tr>
            ";
        }else{
            $html .="
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                </tr>
            ";
        }
        if($data['employer_name_2'] != '' || $data['employer_name_2'] != null){
            $html .="
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[employer_name_2]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[positica_2]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[date_from_2]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[date_to_2]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[basic_salary_2]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[reason_for_leaving_2]
                    </td>
                </tr>
            ";
        }else{
            $html .="
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                </tr>
            ";
        }
        if($data['employer_name_3'] != '' || $data['employer_name_3'] != null){
            $html .="
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[employer_name_3]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[positica_3]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[date_from_3]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[date_to_3]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[basic_salary_3]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[reason_for_leaving_3]
                    </td>
                </tr>
            ";
        }else{
            $html .="
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                </tr>
            ";
        }
        if($data['employer_name_4'] != '' || $data['employer_name_4'] != null){
            $html .="
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[employer_name_4]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[positica_4]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[date_from_4]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[date_to_4]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[basic_salary_4]
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        $data[reason_for_leaving_4]
                    </td>
                </tr>
            ";
        }else{
            $html .="
                <tr class='row'>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                    <td style='width: 25%; border: 2px solid black;'>
                        -
                    </td>
                </tr>
            ";
        }
        $html .="
            </table>
        ";
        $html .="
            <table style='width: 100%; border: 2px solid black; border-collapse: collapse; text-align: center;'>
                <tr class='row'>
                    <td style='width: 33%; border: 2px solid black;background-color: #ddd;' colspan='2'>
                        <span style='margin-right: 5px; margin-left: 30px;' >  إجمالي الدخل الشهري لأخر وظيفة  </span>
                    </td>
                    <td style='width: 33%; border: 2px solid black;color: #5baa59; font-size: 20px;' colspan='1'>
                        $data[last_sallary]
                    </td>
                    <td style='width: 34%; border: 2px solid black;background-color: #ddd;' colspan='3'>
                        <span >Total Monthly Income from Last Job</span>
                    </td>
                </tr>
            </table>
            <table style='width: 100%; border: 2px solid black; border-collapse: collapse; text-align: center;'>
                <tr>
                    <td style='width: 33%; border: 2px solid black; text-align: right; ' colspan='6'>
                        <span style='font-weight: bold; margin-right: 120px; margin-left: 550px;'> المهارات </span>
                        <span style='font-weight: bold;'> Skills </span>
                    </td>
                </tr>
                <tr>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd; line-height: 15px;'>
                        <span > 1 </span>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd; line-height: 15px;'>
                        <span > 2 </span>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd; line-height: 15px;'>
                        <span > 3 </span>
                    </td>
                    <td style='width: 25%; border: 2px solid black;background-color: #ddd; line-height: 15px;'>
                        <span > 4 </span>
                    </td>
                </tr>
                <tr>
        ";
        if($data['skills_1'] != '' || $data['skills_1'] != null){
            $html .= "
                <td style='width: 25%; border: 2px solid black;'>
                    $data[skills_1]
                </td>
            ";
        }else{
            $html .= "
                <td style='width: 25%; border: 2px solid black;'>
                    -
                </td>
            ";
        }
        if($data['skills_2'] != '' || $data['skills_2'] != null){
            $html .= "
                <td style='width: 25%; border: 2px solid black;'>
                    $data[skills_2]
                </td>
            ";
        }else{
            $html .= "
                <td style='width: 25%; border: 2px solid black;'>
                    -
                </td>
            ";
        }
        if($data['skills_3'] != '' || $data['skills_3'] != null){
            $html .= "
                <td style='width: 25%; border: 2px solid black;'>
                    $data[skills_3]
                </td>
            ";
        }else{
            $html .= "
                <td style='width: 25%; border: 2px solid black;'>
                    -
                </td>
            ";
        }
        if($data['skills_4'] != '' || $data['skills_4'] != null){
            $html .= "
                <td style='width: 25%; border: 2px solid black;'>
                    $data[skills_4]
                </td>
            ";
        }else{
            $html .= "
                <td style='width: 25%; border: 2px solid black;'>
                    -
                </td>
            ";
        }
        $html .= "
                        </tr>
                    </table>
                    <table style='width: 100%; border: 2px solid black; border-collapse: collapse; text-align: center;'>
                        <tr>
                            <td style='width: ; border: 2px solid black; text-align: center; background: #ddd;' colspan='2'>
                                <span style='font-weight: bold;'> اللغات </span>
                            </td>
                            <td style='width: ; border: 2px solid black; text-align: center; background: #ddd;' colspan='3'>
                                <span style='font-weight: bold;'> القراءة </span>
                                <span style='font-weight: bold;'> Reading </span>
                            </td>
                            <td style='width: ; border: 2px solid black; text-align: center; background: #ddd;' colspan='3'>
                                <span style='font-weight: bold;'> الكتابة </span>
                                <span style='font-weight: bold;'> Writing </span>
                            </td>
                            <td style='width: ; border: 2px solid black; text-align: center; background: #ddd;' colspan='3'>
                                <span style='font-weight: bold;'> التحدث </span>
                                <span style='font-weight: bold;'> Speaking </span>
                            </td>
                            <td style='width: ; border: 2px solid black; text-align: center; background: #ddd;' colspan='2'>
                                <span style='font-weight: bold;'> Languages </span>
                            </td>
                        </tr>
                        <tr>
                            <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;' colspan='2'>
                                <span style='font-weight: bold;'>  </span>
                            </td>
        
                            <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                                <p style='font-weight: bold;'> جيد </p>
                                <p style='font-weight: bold;'> Good </p>
                            </td>
                            <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                                <p style='font-weight: bold;'> متوسط </p>
                                <p style='font-weight: bold;'> Fair </p>
                            </td>
                            <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                                <p style='font-weight: bold;'> ضعيف </p>
                                <p style='font-weight: bold;'> Poor </p>
                            </td>
        
                            <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                                <p style='font-weight: bold;'> جيد </p>
                                <p style='font-weight: bold;'> Good </p>
                            </td>
                            <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                                <p style='font-weight: bold;'> متوسط </p>
                                <p style='font-weight: bold;'> Fair </p>
                            </td>
                            <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                                <p style='font-weight: bold;'> ضعيف </p>
                                <p style='font-weight: bold;'> Poor </p>
                            </td>
        
                            <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                                <p style='font-weight: bold;'> جيد </p>
                                <p style='font-weight: bold;'> Good </p>
                            </td>
                            <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                                <p style='font-weight: bold;'> متوسط </p>
                                <p style='font-weight: bold;'> Fair </p>
                            </td>
                            <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                                <p style='font-weight: bold;'> ضعيف </p>
                                <p style='font-weight: bold;'> Poor </p>
                            </td>
        
                            <td style='width: ; border: 2px solid black; text-align: right; ' colspan='2'>
                                <span style='font-weight: bold;'>  </span>
                            </td>
                        </tr>        
                        <tr>
                            <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;' colspan='2'>
                                <span style='font-weight: bold;'> اللغة العربية</span>
                            </td>
        ";
        if($data['arabic_reading'] == 'جيد'){
            $html .="
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' checked/>
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
            ";
        }else if($data['arabic_reading'] == 'متوسط'){
            $html .="
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' checked/>
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
            ";
        }else if($data['arabic_reading'] == 'ضعيف'){
            $html .="
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' checked/>
                </td>
            ";
        }

        if($data['arabic_writing'] == 'جيد'){
            $html .="
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' checked/>
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
            ";
        }else if($data['arabic_writing'] == 'متوسط'){
            $html .="
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' checked/>
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
            ";
        }else if($data['arabic_writing'] == 'ضعيف'){
            $html .="
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' checked/>
                </td>
            ";
        }

        if($data['arabic_speaking'] == 'جيد'){
            $html .="
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' checked/>
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
            ";
        }else if($data['arabic_speaking'] == 'متوسط'){
            $html .="
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' checked/>
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
            ";
        }else if($data['arabic_speaking'] == 'ضعيف'){
            $html .="
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' checked/>
                </td>
            ";
        }

        $html .="
                            <td style='width: ; border: 2px solid black; text-align: center; ' colspan='2'>
                                <span style='font-weight: bold;'> arabic </span>
                            </td>
                        </tr>
                        <tr>
                            <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;' colspan='2'>
                                <span style='font-weight: bold;'> اللغة الأنجليزية</span>
                            </td>
        ";

        if($data['english_reading'] == 'جيد'){
            $html .="
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' checked/>
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
            ";
        }else if($data['english_reading'] == 'متوسط'){
            $html .="
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' checked/>
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
            ";
        }else if($data['english_reading'] == 'ضعيف'){
            $html .="
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' checked/>
                </td>
            ";
        }

        if($data['english_writing'] == 'جيد'){
            $html .="
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' checked/>
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
            ";
        }else if($data['english_writing'] == 'متوسط'){
            $html .="
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' checked/>
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
            ";
        }else if($data['english_writing'] == 'ضعيف'){
            $html .="
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' checked/>
                </td>
            ";
        }

        if($data['english_speaking'] == 'جيد'){
            $html .="
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' checked/>
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
            ";
        }else if($data['english_speaking'] == 'متوسط'){
            $html .="
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' checked/>
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
            ";
        }else if($data['english_speaking'] == 'ضعيف'){
            $html .="
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' />
                </td>
                <td style='width: ; border: 2px solid black; text-align: center; line-height: 10px;'>
                    <input type='checkbox' checked/>
                </td>
            ";
        }
        $html .="
                            <td style='width: ; border: 2px solid black; text-align: center; ' colspan='2'>
                                <span style='font-weight: bold;'> english </span>
                            </td>
                        </tr>
                    </table>
                    <table style='width: 100%; border: 2px solid black; border-collapse: collapse; text-align: center;'>
                        <tr>
                            <td style='width: 33%; border: 2px solid black; text-align: right; ' colspan='6'>
                                <span style='font-weight: bold; margin-right: 90px; margin-left: 580px;'> الهوايات </span>
                                <span style='font-weight: bold;'> Hobbies </span>
                            </td>
                        </tr>
                        <tr>
        ";
        if($data['hobbies_1'] != '' || $data['hobbies_1'] != null){
            $html .= "
                <td style='width: 25%; border: 2px solid black;'>
                    $data[hobbies_1]
                </td>
            ";
        }else{
            $html .= "
                <td style='width: 25%; border: 2px solid black;'>
                    -
                </td>
            ";
        }
        if($data['hobbies_2'] != '' || $data['hobbies_2'] != null){
            $html .= "
                <td style='width: 25%; border: 2px solid black;'>
                    $data[hobbies_2]
                </td>
            ";
        }else{
            $html .= "
                <td style='width: 25%; border: 2px solid black;'>
                    -
                </td>
            ";
        }
        $html .="
                        </tr>
                    </table>
                    <table style='width: 100%; border: 2px solid black; border-collapse: collapse; text-align: center;'>
                        <tr>
                            <td style='width: 33%; border: 2px solid black; text-align: right; ' colspan='6'>
                                <span style='font-weight: bold; margin-right: 40px; margin-left: 200px;'> أشخاص بإمكانك الاتصال بهم في الضرورة</span>
                                <span style='font-weight: bold;'> Persons you could call them in the necessary </span>
                            </td>
                        </tr>
                        <tr>
                            <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                                <span >  اسم الشخص </span>
                                <span  >Person Name</span>
                            </td>
                            <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                                <span >  صلة القرابة  </span>
                                <span  > Relation Ship </span>
                            </td>
                            <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                                <span > رقم الهاتف </span>
                                <span  > Mobile </span>
                            </td>
                            <td style='width: 25%; border: 2px solid black;background-color: #ddd;'>
                                <span >  العنوان </span>
                                <span  > Address </span>
                            </td>
                        </tr>
                        <tr>
                            <td style='width: 25%; border: 2px solid black;'>
                                $data[person_name_1]
                            </td>
                            <td style='width: 25%; border: 2px solid black;'>
                                $data[person_relationship_1]
                            </td>
                            <td style='width: 25%; border: 2px solid black;'>
                                $data[person_phone_1]
                            </td>
                            <td style='width: 25%; border: 2px solid black;'>
                                $data[person_address_1]
                            </td>
                        </tr>
                        <tr>
                            <td style='width: 25%; border: 2px solid black;'>
                                $data[person_name_2]
                            </td>
                            <td style='width: 25%; border: 2px solid black;'>
                                $data[person_relationship_2]
                            </td>
                            <td style='width: 25%; border: 2px solid black;'>
                                $data[person_phone_2]
                            </td>
                            <td style='width: 25%; border: 2px solid black;'>
                                $data[person_address_2]
                            </td>
                        </tr>
                    </table>
                    <h4 style='width: 640px; margin-right: 20px; color: #005db4; border-bottom: 1px solid #005db4;'>اتقدم اليكم ادارة شركة رؤية باى لحلول السداد و البرمجيات بطلب الانضمام للوظيفة الشاغلة.</h4>
                    <table style='width: 100%; text-align: center; margin-top: 50px;'>
                        <tr>
                            <td style='width: 25%;'>
                                <p style='margin-right: -150px;'>تفضلوا بقبول فائق الاحترام والتقدير </p>
                                <p style='margin-top: 20px;'>التوقيع/  ...................................................................... </p>
                                <p style='margin-top: 20px;'>التاريخ/  ...................................................................... </p>
                            </td>
                            <td style='width: 25%; text-align: center;'>
                                <div style='border: 2px solid #000;width:150px;height: 150px; border-radius: 50%;margin-right: 200px;'>
                                    <p style='margin-top: 60px;'>ختم الشركة</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <table style='width: 100%; border: 2px solid black; border-collapse: collapse; text-align: center;margin-top: 50px;'>
                        <tr>
                            <td style='width: 33%; border: 2px solid black;background-color: #ddd;padding: 15px;'>
                                <span > تقييم المدير المسئول </span>
                            </td>
                            <td style='width: 33%; border: 2px solid black;background-color: #ddd;padding: 15px;'>
                                <span > التقيم بناء على المقابله الشخصية </span>
                            </td>
                            <td style='width: 34%; border: 2px solid black;background-color: #ddd;padding: 15px;'>
                                <span > اعتماد التعين من رئيس مجلس الادارة </span>
                            </td>
                        </tr>
                        <tr>
                            <td style='width: 33%; border: 2px solid black;padding: 50px 20px;'>
                                
                            </td>
                            <td style='width: 33%; border: 2px solid black;padding: 50px 20px;'>
                                
                            </td>
                            <td style='width: 34%; border: 2px solid black;padding: 50px 20px;'>
                                
                            </td>
                        </tr>
                    </table>
                    <table style='height: 100%; width: 100%; border: 2px solid black; border-collapse: collapse; text-align: center; margin-top: 50px;'>
                        <tr>
                            <td style='border: 2px solid black;'>
                                <p>الصورة الشخصية</p>
                                <p>personal image</p>
                            </td>
                            <td style='border: 2px solid black; padding: 60px 20px 80px;'>
                                <img src='". __DIR__ ."uploads/$data[photoOFuser_up]' alt='Image' style='width: 270px; height: 320x; margin-bottom: -50px'/>
                            </td>
                        </tr>
                        <tr>
                            <td style='border: 2px solid black;'>
                                <p> صورة البطاقة / امام </p>
                                <p> front image </p>
                            </td>
                            <td style='border: 2px solid black; padding: 60px 20px 80px;'>
                                <img src='". __DIR__ ."uploads/$data[frontOFcard_up]' alt='Image' style='width: 550px; height: 300px; margin-bottom: -50px'/>
                            </td>
                        </tr>
                        <tr>
                            <td style='border: 2px solid black;'>
                                <p> صورة البطاقة / خلف </p>
                                <p> back image </p>
                            </td>
                            <td style='border: 2px solid black; padding: 60px 20px 80px;'>
                                <img src='". __DIR__ ."uploads/$data[backOFcard_up]' alt='Image' style='width: 550px; height: 300px; margin-bottom: -50px'/>
                            </td>
                        </tr>
                    </table>
                </body>
            </html>
        ";
        
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        echo $snappy->getOutputFromHtml($html);
    }