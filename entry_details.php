<?php
// Database connection parameters
$host = "localhost"; // Replace with your database host
$user = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$database = "admission"; // Replace with your database name

// Establish connection to the database
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
// Corrected $_POST keys
$name = $_POST['name'];
$Gender = $_POST['Gender'];
$date_of_birth = $_POST['date_of_birth'];
$mother_tongue = $_POST['mother_tongue'];
$student_aadhar_no = $_POST['student_aadhar_no'];
$father_name = $_POST['father_name'];
$father_occupation = $_POST['father_occupation'];
$father_aadhar_no = $_POST['father_aadhar_no'];
$phone_no = $_POST['phone_no'];
$child_id = $_POST['child_id'];
$ration_card_no = $_POST['ration_card_no'];
$residing_with = $_POST['residing_with'];
$guardian_name = $_POST['guardian_name'];
$guardian_occupation = $_POST['guardian_occupation'];
$nationality = $_POST['nationality'];
$state = $_POST['state'];
$religion = $_POST['religion'];
$caste = $_POST['caste'];
$sub_caste = $_POST['sub_caste'];
$residence = $_POST['residence'];
$previous_school = $_POST['previous_school'];
$school_code = $_POST['school_code'];
$previous_class = $_POST['previous_class'];
$medium_to_join = $_POST['medium_to_join'];
$eligible_for_promotion = $_POST['eligible_for_promotion'];
$record_sheet_no = $_POST['record_sheet_no'];
$record_sheet_date = $_POST['record_sheet_date'];
$class_joined = $_POST['class_joined'];
$joined_medium = $_POST['joined_medium'];
$childinfo_no = $_POST['childinfo_no'];
$first_language = $_POST['first_language'];
$second_language = $_POST['second_language'];
$personal_marks = $_POST['personal_marks'];
$remarks = $_POST['remarks'];


// SQL query to insert data into the database
$sql = "INSERT INTO details (
    Name, gender, date_of_birth, mother_tongue,student_aadhar_no, father_name, father_occupation, father_aadhar_no, 
    phone_no, child_id, ration_card_no,residing_with, guardian_name, guardian_occupation, nationality, state, 
    religion, caste, sub_caste, residence, previous_school, school_code, previous_class, medium_to_join, eligible_for_promotion, 
    record_sheet_no, record_sheet_date, class_joined, joined_medium, childinfo_no, first_language, 
    second_language, personal_marks, remarks
) VALUES (
    '$name', '$Gender', '$date_of_birth', '$mother_tongue', '$student_aadhar_no', '$father_name', '$father_occupation', 
    '$father_aadhar_no', '$phone_no', '$child_id', '$ration_card_no', '$residing_with', '$guardian_name', 
    '$guardian_occupation', '$nationality', '$state', '$religion', '$caste', '$sub_caste', '$residence', 
    '$previous_school', '$school_code', '$previous_class', '$medium_to_join', '$eligible_for_promotion', '$record_sheet_no', 
    '$record_sheet_date', '$class_joined', '$joined_medium', '$childinfo_no', '$first_language', 
    '$second_language', '$personal_marks', '$remarks'
)";

// Execute the query and check if it succeeds
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
