<?php

class AppointmentCreator {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function createAppointment($name, $email, $phone, $appointment_date, $appointment_time, $appointment_type, $section, $created_at) {
        $sql = "INSERT INTO appointments (name, email, phone, appointment_date, appointment_time, appointment_type, section, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name, $email, $phone, $appointment_date, $appointment_time, $appointment_type, $section, $created_at]);
    }
}

// Include database connection or any necessary files
require_once "db_connection.php";

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $appointment_type = $_POST['appointment_type'];
    $section = $_POST['section'];
    $created_at = date('Y-m-d H:i:s'); // Current date and time

    // Instantiate AppointmentCreator object
    $appointmentCreator = new AppointmentCreator($pdo);

    // Call createAppointment method
    $success = $appointmentCreator->createAppointment($name, $email, $phone, $appointment_date, $appointment_time, $appointment_type, $section, $created_at);

    if ($success) {
        // Redirect to appointments list page after successful creation
        header("Location: admin_dashboard.php");
        exit;
    } else {
        echo "Failed to create appointment.";
    }
}
?>
