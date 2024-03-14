<?php
// Include the database connection file
include 'db_connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];

    // Connect to the database
    try {
        $pdo = new PDO(
            "mysql:host=localhost;dbname=abc laboratories;charset=utf8",
            "root",
            ""
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit();
    }

    // Prepare and execute SQL query to insert user data into the database
    try {
        $sql = "INSERT INTO users (name, email, address, contact, dob, password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $address, $contact, $dob, $password]);

        // Redirect to success page
        header("Location: admin_dashboard.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}
?>
