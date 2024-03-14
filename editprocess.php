<?php
// editprocess.php

$host = "localhost";
$dbname = "abc laboratories";
$username = "root";
$password = ""; // Please replace this with your actual database password

try {
    // Establish a database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Display error message if connection fails
    die("Connection failed: " . $e->getMessage());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $test_name = $_POST['test_name'];
    $test_type = $_POST['test_type'];
    $description = $_POST['description'];
    $normal_range = $_POST['normal_range'];
    $sample_type = $_POST['sample_type'];
    $price = $_POST['price'];
    $preparation_instructions = $_POST['preparation_instructions'];
    
    // Update database record
    $sql = "UPDATE test_details SET test_name=?, test_type=?, description=?, normal_range=?, sample_type=?, price=?, preparation_instructions=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$test_name, $test_type, $description, $normal_range, $sample_type, $price, $preparation_instructions, $id]);
    
    // Redirect to test details page after update
    header("Location: admin_dashboard.php");
    exit();
}
?>
