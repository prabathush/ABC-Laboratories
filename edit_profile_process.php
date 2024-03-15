<?php
session_start();

class UserProfileUpdater {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function updateProfile($userId, $name, $email, $address, $contact, $dob) {
        // Prepare and execute SQL query to update user profile
        $sql = "UPDATE users SET name = ?, email = ?, address = ?, contact = ?, dob = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name, $email, $address, $contact, $dob, $userId]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include database connection or any necessary files
    require_once "db_connection.php";

    // Get user ID from session or any other means
    $userId = $_SESSION['user_id']; // Example: Retrieve user ID from session

    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $dob = $_POST['dob'];

    // Instantiate UserProfileUpdater object
    $profileUpdater = new UserProfileUpdater($pdo);

    // Call updateProfile method
    if ($profileUpdater->updateProfile($userId, $name, $email, $address, $contact, $dob)) {
        // Redirect to profile page after successful update
        header("Location: user_dashboard.php");
        exit;
    } else {
        // Redirect or display error if update fails
        header("Location: edit_profile.php?error=update_failed");
        exit;
    }
} else {
    // Redirect or display error if form is not submitted
    header("Location: edit_profile.php");
    exit;
}
?>
