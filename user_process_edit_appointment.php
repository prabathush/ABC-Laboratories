<?php
// Include the necessary files and initialize the session if needed
require_once "db_connection.php";
session_start();

class AppointmentUpdater {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function updateAppointment($id, $name, $email, $phone, $appointment_date, $appointment_time, $appointment_type, $section) {
        try {
            // Example SQL query to update appointment details in the appointments table
            $sql = "UPDATE appointments SET name = ?, email = ?, phone = ?, appointment_date = ?, appointment_time = ?, appointment_type = ?, section = ? WHERE ID = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$name, $email, $phone, $appointment_date, $appointment_time, $appointment_type, $section, $id]);

            // Check if the update was successful
            if ($stmt->rowCount() > 0) {
                // Redirect the user to a relevant page
                header("Location: user_dashboard.php");
                exit(); // Ensure script execution stops after redirection
            } else {
                // If no rows were affected, display an error message
                echo "Error: No rows were updated.";
            }
        } catch (PDOException $e) {
            // Handle database errors or display an error message
            echo "Error: " . $e->getMessage();
        }
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve appointment ID from the form
    $appointmentId = $_POST["id"];

    // Retrieve form data and perform validation
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $appointment_date = $_POST["appointment_date"];
    $appointment_time = $_POST["appointment_time"];
    $appointment_type = $_POST["appointment_type"];
    $section = $_POST["section"];

    // Validate form data (you can add your validation logic here)

    // Instantiate AppointmentUpdater class
    $appointmentUpdater = new AppointmentUpdater($pdo);
    // Update the appointment in the database
    $appointmentUpdater->updateAppointment($appointmentId, $name, $email, $phone, $appointment_date, $appointment_time, $appointment_type, $section);
} else {
    // If the form is not submitted, redirect the user to the appropriate page or display an error message
    // Example: header("Location: appointment_form.php");
    // Example: exit();
}
?>
