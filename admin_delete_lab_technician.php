<?php
class TechnicianDeleter {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function deleteTechnician($technicianId) {
        try {
            // Delete technician from the database
            $sql = "DELETE FROM technicians WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$technicianId]);

            // Redirect back to technicians list page after deletion
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

// Check if technician ID is provided in the URL
if (isset($_GET['id'])) {
    // Get technician ID from the URL
    $technicianId = $_GET['id'];

    // Instantiate TechnicianDeleter object
    $technicianDeleter = new TechnicianDeleter($pdo);

    // Call deleteTechnician method
    $technicianDeleter->deleteTechnician($technicianId);
} else {
    // Redirect or display error if technician ID is not provided
    echo "Technician ID is missing.";
    exit;
}
?>
