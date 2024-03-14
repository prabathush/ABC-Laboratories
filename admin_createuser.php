<?php
// Include the database connection file
include 'db_connection.php';

class UserRegistration {
    private $pdo;

    public function __construct() {
        // Connect to the database
        try {
            $this->pdo = new PDO(
                "mysql:host=localhost;dbname=abc laboratories;charset=utf8",
                "root",
                ""
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit();
        }
    }

    public function registerUser($name, $email, $address, $contact, $dob, $password) {
        // Prepare and execute SQL query to insert user data into the database
        try {
            $sql = "INSERT INTO users (name, email, address, contact, dob, password) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$name, $email, $address, $contact, $dob, $password]);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit();
        }
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];

    // Instantiate UserRegistration object
    $userRegistration = new UserRegistration();

    // Register user
    if ($userRegistration->registerUser($name, $email, $address, $contact, $dob, $password)) {
        // Redirect to success page
        header("Location: admin_dashboard.php");
        exit();
    }
}
?>
