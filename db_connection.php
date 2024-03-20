<?php
// Database connection parameters
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
?>
