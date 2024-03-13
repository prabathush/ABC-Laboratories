<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("location: userlogin.php");
    exit();
}

// Include database connection
include_once "db_connection.php";

// Get user input
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$dob = $_POST['dob'];

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Update user data in the database
$sql = "UPDATE users SET name = :name, email = :email, address = :address, contact = :contact, dob = :dob WHERE id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":name", $name, PDO::PARAM_STR);
$stmt->bindParam(":email", $email, PDO::PARAM_STR);
$stmt->bindParam(":address", $address, PDO::PARAM_STR);
$stmt->bindParam(":contact", $contact, PDO::PARAM_STR);
$stmt->bindParam(":dob", $dob, PDO::PARAM_STR);
$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
$stmt->execute();

// Redirect back to profile page
header("location: userdashboard.php");
exit();
?>
