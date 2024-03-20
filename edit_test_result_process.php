<?php
session_start();



// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "abc laboratories";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$test_id = $_POST["test_id"]; // Assuming you're passing test ID through a hidden field
$test_name = $_POST["test_name"];
$test_date = $_POST["test_date"];
$result = $_POST["result"];
$remarks = $_POST["remarks"];
$user_id = $_POST["user_id"];
$technician_name = $_POST["technician_name"];
$doctor_name = $_POST["doctor_name"];


// Update test result in the database
$sql = "UPDATE test_results SET test_name='$test_name', test_date='$test_date', result='$result', remarks='$remarks', user_id='$user_id', technician_name='$technician_name', doctor_name='$doctor_name' WHERE result_id='$test_id'";

if ($conn->query($sql) === TRUE) {
    // Redirect to the test results page after successful update
    header("Location: tech_test_results.php");
    exit;
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
