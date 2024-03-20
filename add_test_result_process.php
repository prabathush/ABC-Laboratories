<?php
session_start();

// Check if the technician is logged in


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
$test_name = $_POST["test_name"];
$test_date = $_POST["test_date"];
$result = $_POST["result"];
$remarks = $_POST["remarks"];
$user_id = $_POST["user_id"];
$technician_name = $_POST["technician_name"];
$doctor_name = $_POST["doctor_name"];

// Insert new test result into the database
$sql = "INSERT INTO test_results (test_name, test_date, result, remarks, technician_name, doctor_name, user_id) VALUES ('$test_name', '$test_date', '$result', '$remarks', '$technician_name', '$doctor_name','$user_id')";

if ($conn->query($sql) === TRUE) {
    // Redirect to the test results page after successful insertion
    header("Location: tech_test_results.php");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
