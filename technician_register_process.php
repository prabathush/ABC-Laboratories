<?php

class TechnicianRegistration {
    private $conn;

    public function __construct($servername, $username, $password, $database) {
        // Create connection
        $this->conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function registerTechnician($name, $email, $phone, $address, $qualification, $experience, $specialization, $password) {
        // Prepare SQL statement
        $stmt = $this->conn->prepare("INSERT INTO technicians (name, email, phone, address, qualification, experience, specialization, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        // Bind parameters and execute the statement
        $stmt->bind_param("ssssssss", $name, $email, $phone, $address, $qualification, $experience, $specialization, $password);
        $stmt->execute();

        // Check if insertion was successful
        if ($stmt->affected_rows > 0) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }

    public function closeConnection() {
        // Close connection
        $this->conn->close();
    }
}

// Establish database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "abc laboratories";

// Create TechnicianRegistration object
$technicianRegistration = new TechnicianRegistration($servername, $username, $password, $database);

// Retrieve user input
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$qualification = $_POST['qualification'];
$experience = $_POST['experience'];
$specialization = $_POST['specialization'];
$password = $_POST['password'];

// Register technician
$technicianRegistration->registerTechnician($name, $email, $phone, $address, $qualification, $experience, $specialization, $password);

// Close database connection
$technicianRegistration->closeConnection();
?>
