<?php
// Include the database connection file
include 'db_connection.php';

// Check if user ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitize user ID input
    $user_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Connect to the database
    try {
        $pdo = new PDO(
            "mysql:host=localhost;dbname=abc laboratories;charset=utf8",
            "root",
            ""
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit();
    }

    // Prepare and execute SQL query to delete user
    try {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id]);

        // Redirect to users page after deletion
        header("Location: admin_dashboard.php#patientsContent");
        exit();
       
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
} else {
    // Redirect to users page if user ID is not provided
    header("Location: login.html");
    exit();
}
?>
