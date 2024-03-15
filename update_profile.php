<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("location: userlogin.php");
    exit();
}

// Include database connection
require_once "db_connection.php";

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function updateUser($name, $email, $address, $contact, $dob, $userId) {
        $sql = "UPDATE users SET name = :name, email = :email, address = :address, contact = :contact, dob = :dob WHERE id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":address", $address, PDO::PARAM_STR);
        $stmt->bindParam(":contact", $contact, PDO::PARAM_STR);
        $stmt->bindParam(":dob", $dob, PDO::PARAM_STR);
        $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
        $stmt->execute();
    }
}

// Get user input
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$dob = $_POST['dob'];

// Get user ID from session
$userId = $_SESSION['user_id'];

// Instantiate User class
$user = new User($pdo);
// Update user data in the database
$user->updateUser($name, $email, $address, $contact, $dob, $userId);

// Redirect back to profile page
header("location: userdashboard.php");
exit();
?>
