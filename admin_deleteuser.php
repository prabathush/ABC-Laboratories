<?php
// Include the database connection file
include 'db_connection.php';

class UserDeletion {
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

    public function deleteUser($user_id) {
        // Prepare and execute SQL query to delete user
        try {
            $sql = "DELETE FROM users WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$user_id]);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit();
        }
    }
}

// Check if user ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitize user ID input
    $user_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Instantiate UserDeletion object
    $userDeletion = new UserDeletion();

    // Delete user
    if ($userDeletion->deleteUser($user_id)) {
        // Redirect to users page after deletion
        header("Location: admin_dashboard.php#patientsContent");
        exit();
    }
} else {
    // Redirect to users page if user ID is not provided
    header("Location: login.html");
    exit();
}
?>
