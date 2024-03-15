<?php
// Include the necessary files and initialize the session if needed
require_once "db_connection.php";
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and perform validation
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    // Validate form data (you can add your validation logic here)

    // Insert the inquiry into the database
    try {
        // Example SQL query to insert inquiry into the inquiries table
        $sql = "INSERT INTO inquiries (name, email, subject, message, status) VALUES (?, ?, ?, ?, 'Pending')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $subject, $message]);

        // Redirect the user to a relevant page or display a success message
        echo "<script>alert('Inquiry submitted successfully!'); window.location='user_dashboard.php';</script>";
        exit();
    } catch (PDOException $e) {
        // Handle database errors or display an error message
        echo "Error: " . $e->getMessage();
    }
} else {
    // If the form is not submitted, redirect the user to the appropriate page or display an error message
    // Example: header("Location: inquiry_form.php");
    // Example: exit();
}
?>
