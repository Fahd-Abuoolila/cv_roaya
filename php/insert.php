<?php
    require('../inc/config.php');

    if(isset($_POST['submit'])){
        // table 1
        $first_name = trim($_POST['first_name']);
        $father_name = trim($_POST['father_name']);
        $grandpa_name = trim($_POST['grandpa_name']);
        $family_name = trim($_POST['family_name']);

        $full_name = $first_name . ' ' . $father_name . ' ' . $grandpa_name . ' ' . $family_name;
        
        $national_id = trim($_POST['national_id']);
        $date_of_issue = trim($_POST['date_of_issue']);
        $place_of_issue = trim($_POST['place_of_issue']);
        $nationality = trim($_POST['nationality']);
        $place_of_birth = trim($_POST['place_of_birth']);
        $date_of_birth = trim($_POST['date_of_birth']);
        $insurance_num = !empty(trim($_POST['insurance_num'])) ? $_POST['insurance_num'] : '-';
        $conscription = !empty(trim($_POST['conscription'])) ? $_POST['conscription'] : '-';
        $marital_status = trim($_POST['marital_status']);
        $number_of_children = trim(isset($_POST['number_of_children']));
        if($marital_status == "اعزب"){
            $number_of_children = '-';
        }else if($marital_status == "متزوج"){
            $number_of_children = trim(isset($_POST['number_of_children']));
        }
        $job_required = trim($_POST['job_required']);
        // Process frontOFcard
        $frontOFcard = $_FILES['frontOFcard'];
        $frontOFcard_location = !empty($frontOFcard['tmp_name']) ? $frontOFcard['tmp_name'] : null;
        $extension1 = pathinfo($frontOFcard['name'], PATHINFO_EXTENSION);
        $frontOFcard_name = $full_name . 'frontOFcard.' . $extension1;
        $frontOFcard_up = $frontOFcard_name ?  '../uploads/' . $frontOFcard_name : null;
        // Process backOFcard
        $backOFcard = $_FILES['backOFcard'];
        $backOFcard_location = !empty($backOFcard['tmp_name']) ? $backOFcard['tmp_name'] : null;
        $extension2 = pathinfo($backOFcard['name'], PATHINFO_EXTENSION);
        $backOFcard_name = $full_name . 'backOFcard.' . $extension2;
        $backOFcard_up = $backOFcard_name ?  '../uploads/' . $backOFcard_name : null;
        // Process photoOFuser
        $photoOFuser = $_FILES['photoOFuser'];
        $photoOFuser_location = !empty($photoOFuser['tmp_name']) ? $photoOFuser['tmp_name'] : null;
        $extension3 = pathinfo($photoOFuser['name'], PATHINFO_EXTENSION);
        $photoOFuser_name = $full_name . 'photoOFuser.' . $extension3;
        $photoOFuser_up = $photoOFuser_name ? '../uploads/' . $photoOFuser_name : null;
        // table 2
        $numberOFphone_1 = trim($_POST['numberOFphone_1']);
        $numberOFphone_2 = trim($_POST['numberOFphone_2']);
        $address = trim($_POST['address']);
        $governorateSelect = trim($_POST['governorateSelect']);
        $centerSelect = trim($_POST['centerSelect']);
        $mail_code = !empty(trim($_POST['mail_code'])) ? $_POST['mail_code'] : '-';
        $useremail = trim($_POST['useremail']);
        // table 3
        $academic_qualification_1 = trim($_POST['academic_qualification_1']);
        $university_1 = trim($_POST['university_1']);
        $locition_1 = trim($_POST['locition_1']);
        $num_of_year_1 = trim($_POST['num_of_year_1']);
        $gpa_1 = trim($_POST['gpa_1']);
        $year_graduated_1 = trim($_POST['year_graduated_1']);
        // table 4
        $academic_qualification_2 = trim($_POST['academic_qualification_2']);
        $university_2 = trim($_POST['university_2']);
        $locition_2 = trim($_POST['locition_2']);
        $num_of_year_2 = trim($_POST['num_of_year_2']);
        $gpa_2 = trim($_POST['gpa_2']);
        $year_graduated_2 = trim($_POST['year_graduated_2']);
        if($academic_qualification_2 == "" || $academic_qualification_2 == null || $academic_qualification_2 == "null" || $academic_qualification_2 == "undefined" || $academic_qualification_2 == ' '){
            $academic_qualification_2 = '-';
            $university_2 = '-';
            $locition_2 = '-';
            $num_of_year_2 = '-';
            $gpa_2 = '-';
            $year_graduated_2 = '-';
        }else{
            $academic_qualification_2 = trim($_POST['academic_qualification_2']);
            $university_2 = trim($_POST['university_2']);
            $locition_2 = trim($_POST['locition_2']);
            $num_of_year_2 = trim($_POST['num_of_year_2']);
            $gpa_2 = trim($_POST['gpa_2']);
            $year_graduated_2 = trim($_POST['year_graduated_2']);
        }
        // table 5
        $academic_qualification_3 = trim($_POST['academic_qualification_3']);
        $university_3 = trim($_POST['university_3']);
        $locition_3 = trim($_POST['locition_3']);
        $num_of_year_3 = trim($_POST['num_of_year_3']);
        $gpa_3 = trim($_POST['gpa_3']);
        $year_graduated_3 = trim($_POST['year_graduated_3']);
        if($academic_qualification_3 == "" || $academic_qualification_3 == null || $academic_qualification_3 == "null" || $academic_qualification_3 == "undefined" || $academic_qualification_3 == ' '){
            $academic_qualification_3 = '-';
            $university_3 = '-';
            $locition_3 = '-';
            $num_of_year_3 = '-';
            $gpa_3 = '-';
            $year_graduated_3 = '-';
        }else{
            $academic_qualification_3 = trim($_POST['academic_qualification_3']);
            $university_3 = trim($_POST['university_3']);
            $locition_3 = trim($_POST['locition_3']);
            $num_of_year_3 = trim($_POST['num_of_year_3']);
            $gpa_3 = trim($_POST['gpa_3']);
            $year_graduated_3 = trim($_POST['year_graduated_3']);
        }
        // table 6
        $course_name_1 = trim($_POST['course_name_1']);
        $duration_1 = trim($_POST['duration_1']);
        $sponsor_1 = trim($_POST['sponsor_1']);
        $date_1 = trim($_POST['date_1']);
        $locition_1 = trim($_POST['locition_1']);
        // table 8
        $course_name_2 = trim($_POST['course_name_2']);
        $duration_2 = trim($_POST['duration_2']);
        $sponsor_2 = trim($_POST['sponsor_2']);
        $date_2 = trim($_POST['date_2']);
        $locition_2 = trim($_POST['locition_2']);
        if($course_name_2 == "" || $course_name_2 == null || $course_name_2 == "null" || $course_name_2 == "undefined" || $course_name_2 == ' '){
            $course_name_2 = '-';
            $duration_2 = '-';
            $sponsor_2 = '-';
            $date_2 = '-';
            $locition_2 = '-';
        }else{
            $course_name_2 = trim($_POST['course_name_2']);
            $duration_2 = trim($_POST['duration_2']);
            $sponsor_2 = trim($_POST['sponsor_2']);
            $date_2 = trim($_POST['date_2']);
            $locition_2 = trim($_POST['locition_2']);
        }
        // table 9
        $course_name_3 = trim($_POST['course_name_3']);
        $duration_3 = trim($_POST['duration_3']);
        $sponsor_3 = trim($_POST['sponsor_3']);
        $date_3 = trim($_POST['date_3']);
        $locition_3 = trim($_POST['locition_3']);
        if($course_name_3 == "" || $course_name_3 == null || $course_name_3 == "null" || $course_name_3 == "undefined" || $course_name_3 == ' '){
            $course_name_3 = '-';
            $duration_3 = '-';
            $sponsor_3 = '-';
            $date_3 = '-';
            $locition_3 = '-';
        }else{
            $course_name_3 = trim($_POST['course_name_3']);
            $duration_3 = trim($_POST['duration_3']);
            $sponsor_3 = trim($_POST['sponsor_3']);
            $date_3 = trim($_POST['date_3']);
            $locition_3 = trim($_POST['locition_3']);
        }
        // table 10
        $course_name_4 = trim($_POST['course_name_4']);
        $duration_4 = trim($_POST['duration_4']);
        $sponsor_4 = trim($_POST['sponsor_4']);
        $date_4 = trim($_POST['date_4']);
        $locition_4 = trim($_POST['locition_4']);
        if($course_name_4 == "" || $course_name_4 == null || $course_name_4 == "null" || $course_name_4 == "undefined" || $course_name_4 == ' '){
            $course_name_4 = '-';
            $duration_4 = '-';
            $sponsor_4 = '-';
            $date_4 = '-';
            $locition_4 = '-';
        }else{
            $course_name_4 = trim($_POST['course_name_4']);
            $duration_4 = trim($_POST['duration_4']);
            $sponsor_4 = trim($_POST['sponsor_4']);
            $date_4 = trim($_POST['date_4']);
            $locition_4 = trim($_POST['locition_4']);
        }
        // table 11
        $course_name_5 = trim($_POST['course_name_5']);
        $duration_5 = trim($_POST['duration_5']);
        $sponsor_5 = trim($_POST['sponsor_5']);
        $date_5 = trim($_POST['date_5']);
        $locition_5 = trim($_POST['locition_5']);
        if($course_name_5 == "" || $course_name_5 == null || $course_name_5 == "null" || $course_name_5 == "undefined" || $course_name_5 == ' '){
            $course_name_5 = '-';
            $duration_5 = '-';
            $sponsor_5 = '-';
            $date_5 = '-';
            $locition_5 = '-';
        }else{
            $course_name_5 = trim($_POST['course_name_5']);
            $duration_5 = trim($_POST['duration_5']);
            $sponsor_5 = trim($_POST['sponsor_5']);
            $date_5 = trim($_POST['date_5']);
            $locition_5 = trim($_POST['locition_5']);
        }
        // table 12
        $employer_name_1 = trim($_POST['employer_name_1']);
        $positica_1 = trim($_POST['positica_1']);
        $date_from_1 = trim($_POST['date_from_1']);
        $date_to_1 = trim($_POST['date_to_1']);
        $basic_salary_1 = trim($_POST['basic_salary_1']);
        $reasons_for_leaving_1 = trim($_POST['reasons_for_leaving_1']);
        // table 13
        $employer_name_2 = trim($_POST['employer_name_2']);
        $positica_2 = trim($_POST['positica_2']);
        $date_from_2 = trim($_POST['date_from_2']);
        $date_to_2 = trim($_POST['date_to_2']);
        $basic_salary_2 = trim($_POST['basic_salary_2']);
        $reasons_for_leaving_2 = trim($_POST['reasons_for_leaving_2']);
        if($employer_name_2 == "" || $employer_name_2 == null || $employer_name_2 == "null" || $employer_name_2 == "undefined" || $employer_name_2 == ' '){
            $employer_name_2 = '-';
            $positica_2 = '-';
            $date_from_2 = '-';
            $date_to_2 = '-';
            $basic_salary_2 = '-';
            $reasons_for_leaving_2 = '-';
        }else{
            $employer_name_2 = trim($_POST['employer_name_2']);
            $positica_2 = trim($_POST['positica_2']);
            $date_from_2 = trim($_POST['date_from_2']);
            $date_to_2 = trim($_POST['date_to_2']);
            $basic_salary_2 = trim($_POST['basic_salary_2']);
            $reasons_for_leaving_2 = trim($_POST['reasons_for_leaving_2']);
        }
        // table 14
        $employer_name_3 = trim($_POST['employer_name_3']);
        $positica_3 = trim($_POST['positica_3']);
        $date_from_3 = trim($_POST['date_from_3']);
        $date_to_3 = trim($_POST['date_to_3']);
        $basic_salary_3 = trim($_POST['basic_salary_3']);
        $reasons_for_leaving_3 = trim($_POST['reasons_for_leaving_3']);
        if($employer_name_3 == "" || $employer_name_3 == null || $employer_name_3 == "null" || $employer_name_3 == "undefined" || $employer_name_3 == ' '){
            $employer_name_3 = '-';
            $positica_3 = '-';
            $date_from_3 = '-';
            $date_to_3 = '-';
            $basic_salary_3 = '-';
            $reasons_for_leaving_3 = '-';
        }else{
            $employer_name_3 = trim($_POST['employer_name_3']);
            $positica_3 = trim($_POST['positica_3']);
            $date_from_3 = trim($_POST['date_from_3']);
            $date_to_3 = trim($_POST['date_to_3']);
            $basic_salary_3 = trim($_POST['basic_salary_3']);
            $reasons_for_leaving_3 = trim($_POST['reasons_for_leaving_3']);
        }
        // table 15
        $employer_name_4 = trim($_POST['employer_name_4']);
        $positica_4 = trim($_POST['positica_4']);
        $date_from_4 = trim($_POST['date_from_4']);
        $date_to_4 = trim($_POST['date_to_4']);
        $basic_salary_4 = trim($_POST['basic_salary_4']);
        $reasons_for_leaving_4 = trim($_POST['reasons_for_leaving_4']);
        if($employer_name_4 == "" || $employer_name_4 == null || $employer_name_4 == "null" || $employer_name_4 == "undefined" || $employer_name_4 == ' '){
            $employer_name_4 = '-';
            $positica_4 = '-';
            $date_from_4 = '-';
            $date_to_4 = '-';
            $basic_salary_4 = '-';
            $reasons_for_leaving_4 = '-';
        }else{
            $employer_name_4 = trim($_POST['employer_name_4']);
            $positica_4 = trim($_POST['positica_4']);
            $date_from_4 = trim($_POST['date_from_4']);
            $date_to_4 = trim($_POST['date_to_4']);
            $basic_salary_4 = trim($_POST['basic_salary_4']);
            $reasons_for_leaving_4 = trim($_POST['reasons_for_leaving_4']);
        }
        // table 16
        $last_sallary = $_POST['last_sallary'];
        // table 17
        $skills_1 = !empty(trim($_POST['skills_1'])) ? $_POST['skills_1'] : '-';
        $skills_2 = !empty(trim($_POST['skills_2'])) ? $_POST['skills_2'] : '-';
        $skills_3 = !empty(trim($_POST['skills_3'])) ? $_POST['skills_3'] : '-';
        $skills_4 = !empty(trim($_POST['skills_4'])) ? $_POST['skills_4'] : '-';
        // table 18
        $arabic_reading = $_POST['arabic_reading'];
        $arabic_writing = $_POST['arabic_writing'];
        $arabic_speaking = $_POST['arabic_speaking'];
        // table 19
        $english_reading = $_POST['english_reading'];
        $english_writing = $_POST['english_writing'];
        $english_speaking = $_POST['english_speaking'];
        // table 20
        $hobbies_1 = !empty(trim($_POST['hobbies_1'])) ? $_POST['hobbies_1'] : '-';
        $hobbies_2 = !empty(trim($_POST['hobbies_2'])) ? $_POST['hobbies_2'] : '-';
        // table 22
        $person_name_1 = $_POST['person_name_1'];
        $person_relationship_1 = $_POST['person_relationship_1'];
        $person_phone_1 = $_POST['person_phone_1'];
        $person_address_1 = $_POST['person_address_1'];
        // table 23
        $person_name_2 = $_POST['person_name_2'];
        $person_relationship_2 = $_POST['person_relationship_2'];
        $person_phone_2 = $_POST['person_phone_2'];
        $person_address_2 = $_POST['person_address_2'];

        // Check if image files are actual images or fake images
        $check1 = $frontOFcard_location ? getimagesize($frontOFcard_location) : false;
        $check2 = $backOFcard_location ? getimagesize($backOFcard_location) : false;
        $check3 = $photoOFuser_location ? getimagesize($photoOFuser_location) : false;

        if($check1 !== false && $check2 !== false && $check3 !== false) {
            // Move the uploaded files to the target directory
            $uploadSuccess = true;
            if ($frontOFcard_location && !move_uploaded_file($frontOFcard_location, $frontOFcard_up)) $uploadSuccess = false;
            if ($backOFcard_location && !move_uploaded_file($backOFcard_location, $backOFcard_up)) $uploadSuccess = false;
            if ($photoOFuser_location && !move_uploaded_file($photoOFuser_location, $photoOFuser_up)) $uploadSuccess = false;

            if ($uploadSuccess = true) {
                // Insert data into the database
                $insert = "INSERT INTO employee_specific (
                first_name,
                second_name ,
                third_name, 
                last_name, 
                national_id, 
                date_of_issue, 
                place_of_issue, 
                nationality, 
                place_of_birth,
                date_of_birth,
                insurance_num,
                conscription,
                marital_status , 
                Num_of_children, 
                job_required,
                frontOFcard_up,
                backOFcard_up,
                photoOFuser_up,
                number_tel_1, 
                number_tel_2, 
                place_of_residence, 
                governorate,
                centre, 
                area_code, 
                employ_email, 
                academic_qualification_1, 
                university_1,
                locition_1, 
                num_of_years_1, 
                gpa_1, 
                year_graduated_1, 
                academic_qualification_2, 
                university_2, 
                locition_2, 
                num_of_years_2, 
                gpa_2, 
                year_graduated_2, 
                academic_qualification_3, 
                university_3, 
                locition_3, 
                num_of_years_3, 
                gpa_3, 
                year_graduated_3, 
                course_name_1, 
                duration_1, 
                sponsor_1, 
                course_date_1, 
                course_location_1, 
                course_name_2, 
                duration_2, 
                sponsor_2, 
                course_date_2, 
                course_location_2, 
                course_name_3, 
                duration_3, 
                sponsor_3,
                course_date_3, 
                course_location_3, 
                course_name_4, 
                duration_4, 
                sponsor_4,
                course_date_4, 
                course_location_4, 
                course_name_5, 
                duration_5, 
                sponsor_5, 
                course_date_5, 
                course_location_5, 
                employer_name_1, 
                positica_1, 
                date_from_1, 
                date_to_1, 
                basic_salary_1, 
                reason_for_leaving_1, 
                employer_name_2,
                positica_2, 
                date_from_2, 
                date_to_2,
                basic_salary_2,
                reason_for_leaving_2,
                employer_name_3,
                positica_3,
                date_from_3,
                date_to_3,
                basic_salary_3,
                reason_for_leaving_3,
                employer_name_4,
                positica_4,
                date_from_4,
                date_to_4,
                basic_salary_4,
                reason_for_leaving_4,
                last_sallary,
                skills_1,
                skills_2,
                skills_3,
                skills_4,
                arabic_reading,
                arabic_writing,
                arabic_speaking,
                english_reading,
                english_writing,
                english_speaking,
                hobbies_1,
                hobbies_2,
                person_name_1,
                person_relationship_1,
                person_phone_1,
                person_address_1,
                person_name_2,
                person_relationship_2,
                person_phone_2,
                person_address_2
                ) VALUES (
                '$first_name', 
                '$father_name' ,
                '$grandpa_name', 
                '$family_name', 
                '$national_id', 
                '$date_of_issue', 
                '$place_of_issue', 
                '$nationality', 
                '$place_of_birth', 
                '$date_of_birth', 
                '$insurance_num', 
                '$conscription' ,
                '$marital_status', 
                '$number_of_children',
                '$job_required', 
                '$frontOFcard_up', 
                '$backOFcard_up', 
                '$photoOFuser_up', 
                '$numberOFphone_1', 
                '$numberOFphone_2', 
                '$address', 
                '$governorateSelect', 
                '$centerSelect', 
                '$mail_code', 
                '$useremail', 
                '$academic_qualification_1', 
                '$university_1',
                '$locition_1', 
                '$num_of_year_1', 
                '$gpa_1', 
                '$year_graduated_1', 
                '$academic_qualification_2', 
                '$university_2', 
                '$locition_2', 
                '$num_of_year_2', 
                '$gpa_2', 
                '$year_graduated_2', 
                '$academic_qualification_3', 
                '$university_3', 
                '$locition_3', 
                '$num_of_year_3', 
                '$gpa_3', 
                '$year_graduated_3', 
                '$course_name_1', 
                '$duration_1', 
                '$sponsor_1', 
                '$date_1', 
                '$locition_1', 
                '$course_name_2', 
                '$duration_2', 
                '$sponsor_2', 
                '$date_2', 
                '$locition_2', 
                '$course_name_3', 
                '$duration_3', 
                '$sponsor_3', 
                '$date_3', 
                '$locition_3', 
                '$course_name_4', 
                '$duration_4', 
                '$sponsor_4', 
                '$date_4', 
                '$locition_4', 
                '$course_name_5', 
                '$duration_5', 
                '$sponsor_5', 
                '$date_5', 
                '$locition_5', 
                '$employer_name_1', 
                '$positica_1', 
                '$date_from_1', 
                '$date_to_1', 
                '$basic_salary_1', 
                '$reasons_for_leaving_1', 
                '$employer_name_2', 
                '$positica_2', 
                '$date_from_2', 
                '$date_to_2', 
                '$basic_salary_2', 
                '$reasons_for_leaving_2', 
                '$employer_name_3', 
                '$positica_3', 
                '$date_from_3', 
                '$date_to_3', 
                '$basic_salary_3', 
                '$reasons_for_leaving_3', 
                '$employer_name_4', 
                '$positica_4', 
                '$date_from_4', 
                '$date_to_4', 
                '$basic_salary_4', 
                '$reasons_for_leaving_4', 
                '$last_sallary', 
                '$skills_1', 
                '$skills_2', 
                '$skills_3', 
                '$skills_4', 
                '$arabic_reading', 
                '$arabic_writing', 
                '$arabic_speaking', 
                '$english_reading', 
                '$english_writing', 
                '$english_speaking', 
                '$hobbies_1', 
                '$hobbies_2', 
                '$person_name_1', 
                '$person_relationship_1', 
                '$person_phone_1', 
                '$person_address_1',
                '$person_name_2', 
                '$person_relationship_2', 
                '$person_phone_2', 
                '$person_address_2'
                )";
                if (mysqli_query($conection, $insert)) {
                    echo "انتظر التحميل";
                } else {
                    echo "Error: " . $insert . "<br>" . mysqli_error($conection);
                }
            } else {
                echo "Sorry, there was an error uploading your files.";
            }
            $data_to_send = [
                'first_name' => $first_name,
                'father_name' => $father_name,
                'grandpa_name' => $grandpa_name,
                'family_name' => $family_name,
                'useremail' => $useremail
            ];
            echo '<form id="redirectForm" action="../win" method="POST">';
            foreach ($data_to_send as $key => $value) {
                echo '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
            }
            echo '</form>';
            echo '<script>document.getElementById("redirectForm").submit();</script>';
        } else {
            require_once('php/mail/mail.php');
            $mail->setFrom('fahdabuoolila.px@gmail.com', 'ROAYA PAY');
            $mail->addAddress($useremail); 
            // $mail->addAddress('youssefmohamedz90334@gmail.com'); 

            $mail->Subject = 'طلب التوظيف في شركة رؤية باي';
            $mail->Body  = '<body style="direction: rtl;">';
            $mail->Body .= 'السلام عليكم.<br>';
            $mail->Body .= '<h2>نرحب بكم في شركة رؤية باي</h2>';
            $mail->Body .= '<p>الأستاذ/ة</p>' . '<p>'. $first_name . ' ' . $father_name . ' ' . $grandpa_name . ' ' . $family_name .'</p>';
            $mail->Body .= 'يوجد حطأ في التسجيل';
            $mail->Body .= 'الرجاء التسجيل مرة اخرى<br>';
            $mail->Body .= '<a href="https://71a6-156-199-93-119.ngrok-free.app/roaya_form/create"> انقر هنا للتسجيل مرة اخرى </a> <br/>';
            $mail->Body .= 'شكراً لسيادتكم.<br>';
            $mail->Body .= '<img src="https://fahd-abuoolila.github.io/roaya_photo/Roaya.png" alt="Roaya Pay" style="width: 100%; height: auto;">';
            $mail->Body .= '</body>';
            $mail->send();
            echo "One or more files are not images.";
        }
    }
?>