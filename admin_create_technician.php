<?php
class TechnicianCreator {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function createTechnician($name, $email, $phone, $address, $qualification, $experience, $specialization) {
        try {
            // Check if email already exists
            $checkEmailQuery = "SELECT COUNT(*) FROM technicians WHERE email = ?";
            $stmtCheckEmail = $this->pdo->prepare($checkEmailQuery);
            $stmtCheckEmail->execute([$email]);
            $emailExists = $stmtCheckEmail->fetchColumn();

            if ($emailExists) {
                // Redirect back to the create technician page with an error message
                header("Location: admin_create_technician.php?error=duplicate_email");
                exit;
            }

            // Insert new technician into the database
            $sql = "INSERT INTO technicians (name, email, phone, address, qualification, experience, specialization) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$name, $email, $phone, $address, $qualification, $experience, $specialization]);

            // Redirect to technicians page after successful creation
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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $qualification = $_POST["qualification"];
    $experience = $_POST["experience"];
    $specialization = $_POST["specialization"];

    // Instantiate TechnicianCreator object
    $technicianCreator = new TechnicianCreator($pdo);

    // Call createTechnician method
    $technicianCreator->createTechnician($name, $email, $phone, $address, $qualification, $experience, $specialization);
} else {
    // Redirect back to the create technician page if the form is not submitted
    header("Location: admin_dashboard.php");
    exit;
}
?>
