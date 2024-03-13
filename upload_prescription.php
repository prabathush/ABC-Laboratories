<?php
session_start();

class PrescriptionManager {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        // Create connection
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function insertPrescription($userId, $note, $deliveryAddress, $deliveryTime, $images) {
        // Prepare and execute SQL statement to insert prescription details
        $sql = "INSERT INTO prescriptions (user_id, note, delivery_address, delivery_time, image_1, image_2, image_3, image_4, image_5) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("issssssss", $userId, $note, $deliveryAddress, $deliveryTime, $image1, $image2, $image3, $image4, $image5);
        
        // Set image variables and perform file type validation
        $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
        for ($i = 0; $i < 5; $i++) {
            $image_tmp_name = $images['tmp_name'][$i];
            $image_type = $images['type'][$i];
            if (in_array($image_type, $allowed_types) && !empty($image_tmp_name)) {
                ${"image" . ($i + 1)} = $images['name'][$i];
            } else {
                // Invalid file type, handle error or display message
                // For now, let's skip uploading and setting the image variable
                continue;
            }
        }

        $stmt->execute();

        // Get ID of the last inserted prescription
        $prescriptionId = $stmt->insert_id;

        // Handle file uploads
        $uploadDir = 'uploads/';
        foreach ($images['tmp_name'] as $key => $tmpName) {
            $fileName = $images['name'][$key];
            $filePath = $uploadDir . $fileName;
            if (move_uploaded_file($tmpName, $filePath)) {
                // Update database with file path
                $columnName = "image_" . ($key + 1);
                $sql = "UPDATE prescriptions SET $columnName = ? WHERE id = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("si", $filePath, $prescriptionId);
                $stmt->execute();
            }
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        // Redirect to login page if user is not logged in
        header("Location: user_login.php");
        exit();
    }

    // Database connection information
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "abc laboratories";

    // Create PrescriptionManager object
    $prescriptionManager = new PrescriptionManager($servername, $username, $password, $dbname);

    // Get form data
    $note = $_POST['note'] ?? '';
    $deliveryAddress = $_POST['deliveryAddress'] ?? '';
    $deliveryTime = $_POST['deliveryTime'] ?? '';
    $userId = $_SESSION['user_id'];

    // Insert prescription
    $prescriptionManager->insertPrescription($userId, $note, $deliveryAddress, $deliveryTime, $_FILES['images']);

    // Close database connection
    $prescriptionManager->closeConnection();

    // Redirect to dashboard or display success message
    header("Location: user_dashboard.php");
    exit();
}
?>
