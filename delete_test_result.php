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

// Retrieve test ID from the URL parameter
$test_id = $_GET["id"];

// Delete the test result from the database
$sql = "DELETE FROM test_results WHERE result_id='$test_id'";

if ($conn->query($sql) === TRUE) {
    // Redirect to the test results page after successful deletion
    header("Location: tech_test_results.php");
    exit;
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
