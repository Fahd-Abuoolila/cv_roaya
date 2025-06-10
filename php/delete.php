<?php
require('../inc/config.php');

$ID = $_POST['id'];
$table_name = '';
$page = '';
$type_database_table = $_POST['typedatabase'];
$TO_type_database_table = $_POST['TOtypedatabase'];
$reason = $_POST['reason'];
$reason_notes = $_POST['reason_notes'];

if ($type_database_table == 'defult') {
    $table_name = 'employee_specific';
    $page = 'index';
    mysqli_query($conection, "UPDATE $table_name SET reason='$reason' ,reason_notes='$reason_notes' WHERE employ_id=$ID" );
} else if ($type_database_table == 'employee_appointed') {
    $table_name = 'employee_appointed';
    $page = 'index_appointed';
    mysqli_query($conection, "UPDATE $table_name SET reason='$reason' ,reason_notes='$reason_notes' WHERE employ_id=$ID" );
} else if ($type_database_table == 'employee_postpone') {
    $table_name = 'employee_postpone';
    $page = 'index_postpone';
    mysqli_query($conection, "UPDATE $table_name SET reason='$reason' ,reason_notes='$reason_notes' WHERE employ_id=$ID" );
} else if ($type_database_table == 'settings') {
    $table_name = 'employs';
    $page = 'settings';
    mysqli_query($conection, "DELETE FROM $table_name WHERE employ_id=$ID");
}

if ($TO_type_database_table != '' && $TO_type_database_table != 'settings_delete') {
    $conection->query("INSERT INTO $TO_type_database_table(first_name, second_name , third_name,  last_name,  national_id,  date_of_issue,  place_of_issue,  nationality,  place_of_birth, date_of_birth, insurance_num, conscription, marital_status ,  Num_of_children,  job_required, frontOFcard_up, backOFcard_up, photoOFuser_up, number_tel_1,  number_tel_2,  place_of_residence,  governorate, centre,  area_code,  employ_email,  academic_qualification_1,  university_1, university_locition_1,  num_of_years_1,  gpa_1,  year_graduated_1,  academic_qualification_2,  university_2,  university_locition_2,  num_of_years_2,  gpa_2,  year_graduated_2,  academic_qualification_3,  university_3,  university_locition_3,  num_of_years_3,  gpa_3,  year_graduated_3,  course_name_1,  duration_1,  sponsor_1,  course_date_1,  course_location_1,  course_name_2,  duration_2,  sponsor_2,  course_date_2,  course_location_2,  course_name_3,  duration_3,  sponsor_3, course_date_3,  course_location_3,  course_name_4,  duration_4,  sponsor_4, course_date_4,  course_location_4,  course_name_5,  duration_5,  sponsor_5,  course_date_5,  course_location_5,  employer_name_1,  positica_1,  date_from_1,  date_to_1,  basic_salary_1,  reason_for_leaving_1,  employer_name_2, positica_2,  date_from_2,  date_to_2, basic_salary_2, reason_for_leaving_2, employer_name_3, positica_3, date_from_3, date_to_3, basic_salary_3, reason_for_leaving_3, employer_name_4, positica_4, date_from_4, date_to_4, basic_salary_4, reason_for_leaving_4, last_sallary, skills_1, skills_2, skills_3, skills_4, arabic_reading, arabic_writing, arabic_speaking, english_reading, english_writing, english_speaking, hobbies_1, hobbies_2, person_name_1, person_relationship_1, person_phone_1, person_address_1, person_name_2, person_relationship_2, person_phone_2, person_address_2 , reason, reason_notes) SELECT first_name, second_name , third_name,  last_name,  national_id,  date_of_issue,  place_of_issue,  nationality,  place_of_birth, date_of_birth, insurance_num, conscription, marital_status ,  Num_of_children,  job_required, frontOFcard_up, backOFcard_up, photoOFuser_up, number_tel_1,  number_tel_2,  place_of_residence,  governorate, centre,  area_code,  employ_email,  academic_qualification_1,  university_1, university_locition_1,  num_of_years_1,  gpa_1,  year_graduated_1,  academic_qualification_2,  university_2,  university_locition_2,  num_of_years_2,  gpa_2,  year_graduated_2,  academic_qualification_3,  university_3,  university_locition_3,  num_of_years_3,  gpa_3,  year_graduated_3,  course_name_1,  duration_1,  sponsor_1,  course_date_1,  course_location_1,  course_name_2,  duration_2,  sponsor_2,  course_date_2,  course_location_2,  course_name_3,  duration_3,  sponsor_3, course_date_3,  course_location_3,  course_name_4,  duration_4,  sponsor_4, course_date_4,  course_location_4,  course_name_5,  duration_5,  sponsor_5,  course_date_5,  course_location_5,  employer_name_1,  positica_1,  date_from_1,  date_to_1,  basic_salary_1,  reason_for_leaving_1,  employer_name_2, positica_2,  date_from_2,  date_to_2, basic_salary_2, reason_for_leaving_2, employer_name_3, positica_3, date_from_3, date_to_3, basic_salary_3, reason_for_leaving_3, employer_name_4, positica_4, date_from_4, date_to_4, basic_salary_4, reason_for_leaving_4, last_sallary, skills_1, skills_2, skills_3, skills_4, arabic_reading, arabic_writing, arabic_speaking, english_reading, english_writing, english_speaking, hobbies_1, hobbies_2, person_name_1, person_relationship_1, person_phone_1, person_address_1, person_name_2, person_relationship_2, person_phone_2, person_address_2 , reason, reason_notes FROM $table_name WHERE employ_id=$ID");
}

mysqli_query($conection, "DELETE FROM $table_name WHERE employ_id=$ID");

if ($page == 'settings') {
    header('location:../' . $page . "?employid=" . $IDemploy . "&mood=create");
} else {
    header('location:../' . $page . "?employid=" . $IDemploy);
}
?>