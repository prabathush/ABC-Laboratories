<?php
session_start();

// Check if the technician is logged in
if (!isset($_SESSION["technician_logged_in"]) || !$_SESSION["technician_logged_in"]) {
    header("Location: technician_login.php");
    exit;
}

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
$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$qualification = $_POST["qualification"];
$experience = $_POST["experience"];
$specialization = $_POST["specialization"];
$password = $_POST["password"];

// Update technician's profile in the database
$technician_id = $_SESSION["technician"]["id"]; // Assuming you store the technician's ID in the session upon login
$sql = "UPDATE technicians SET name='$name', email='$email', phone='$phone', address='$address', qualification='$qualification', experience='$experience', specialization='$specialization', password='$password' WHERE id='$technician_id'";

if ($conn->query($sql) === TRUE) {
    // Redirect to the profile page after successful update
    header("Location: tech_profile.php");
    exit;
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
