<?php
// Require the file containing the Database class
require_once "db_connection.php";
require_once 'Database.php';
session_start();

class Appointment {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function bookAppointment($userId, $appointmentData) {
        try {
            // Example SQL query to insert appointment into the appointments table
            $sql = "INSERT INTO appointments (user_id, name, email, phone, appointment_date, appointment_time, appointment_type, section) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$userId, $appointmentData['name'], $appointmentData['email'], $appointmentData['phone'], $appointmentData['appointment_date'], $appointmentData['appointment_time'], $appointmentData['appointment_type'], $appointmentData['section']]);

            // Redirect the user to a relevant page or display a success message
            echo "Appointment booked successfully!";
            // Example: header("Location: appointment_confirmation.php");
            // Example: exit();
        } catch (PDOException $e) {
            // Handle database errors or display an error message
            echo "Error: " . $e->getMessage();
        }
    }
}

// Require db_connection.php for database connection
require_once "db_connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user ID from the session
    $userId = $_SESSION["user_id"];

    // Retrieve appointment data from the session
    $appointmentData = $_SESSION["appointment_data"];

    // Validate appointment data if needed

    // Instantiate Database class for database connection
    $database = new Database();
    $pdo = $database->getConnection();

    // Instantiate Appointment class
    $appointment = new Appointment($pdo);

    // Book appointment
    $appointment->bookAppointment($userId, $appointmentData);
} else {
    // If the form is not submitted, redirect the user to the appropriate page or display an error message
    // Example: header("Location: appointment_form.php");
    // Example: exit();
}
?>
