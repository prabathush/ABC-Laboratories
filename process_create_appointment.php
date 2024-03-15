<?php
// Include the necessary files and initialize the session if needed
require_once "db_connection.php";
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and perform validation
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $appointment_date = $_POST["appointment_date"];
    $appointment_time = $_POST["appointment_time"];
    $appointment_type = $_POST["appointment_type"];
    $section = $_POST["section"];

    // Validate form data (you can add your validation logic here)

    // Store the appointment data in the session or temporary storage
    $_SESSION["appointment_data"] = [
        "name" => $name,
        "email" => $email,
        "phone" => $phone,
        "appointment_date" => $appointment_date,
        "appointment_time" => $appointment_time,
        "appointment_type" => $appointment_type,
        "section" => $section
    ];

    // Redirect the user to the payment page
    header("Location: payment.php");
    exit();
}
?>
