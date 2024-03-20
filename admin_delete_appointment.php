<?php
class AppointmentDeleter {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function deleteAppointment($appointmentId) {
        try {
            // Delete appointment from the database
            $sql = "DELETE FROM appointments WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$appointmentId]);

            // Redirect back to appointments list page after deletion
            header("Location: admin_dashboard.php");
            exit;
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
        }
    }
}

// Include database connection file
require_once "db_connection.php";

// Check if appointment ID is provided in the URL
if (isset($_GET['id'])) {
    // Get appointment ID from the URL
    $appointmentId = $_GET['id'];

    // Instantiate AppointmentDeleter object
    $appointmentDeleter = new AppointmentDeleter($pdo);

    // Call deleteAppointment method
    $appointmentDeleter->deleteAppointment($appointmentId);
} else {
    // Redirect or display error if appointment ID is not provided
    echo "Appointment ID is missing.";
    exit;
}
?>
