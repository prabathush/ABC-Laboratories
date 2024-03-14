<?php
// Include database connection or any necessary files
require_once "db_connection.php";

// Check if technician ID is provided in the URL
if (isset($_GET['id'])) {
    $technicianId = $_GET['id'];

    // Delete technician from the database
    // Implement your own logic to delete technician based on the ID

    $sql = "DELETE FROM technicians WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$technicianId]);

    // Redirect back to technicians list page after deletion
    header("Location: admin_dashboard.php");
    exit;
} else {
    // Redirect or display error if technician ID is not provided
    echo "Technician ID is missing.";
    exit;
}
?>
