<?php
session_start();

// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "abc laboratories";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user input
// Retrieve user input
$email = $_POST['email'];
$password = $_POST['password'];

// Query to fetch user details
$sql = "SELECT * FROM technicians WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found, set session variables
    $row = $result->fetch_assoc();
    $_SESSION['technician_id'] = $row['id'];
    $_SESSION['technician_name'] = $row['name'];
    $_SESSION['technician_email'] = $row['email'];
    $_SESSION['technician_phone'] = $row['phone'];
    $_SESSION['technician_address'] = $row['address'];
    $_SESSION['technician_qualification'] = $row['qualification'];
    $_SESSION['technician_experience'] = $row['experience'];
    $_SESSION['technician_specialization'] = $row['specialization'];
    
    // Redirect to technician dashboard or any other page after successful login
    header("Location: tech_dashboard.php");
} else {
    // User not found, redirect back to login page with error message
    $_SESSION['login_error'] = "Invalid email or password";
    header("Location: technician_login.php");
}


$conn->close();
?>
