<?php
// Include the file containing the Database class
include 'db_connection.php';
include 'Database.php';
// User class to handle user details operations
class User extends Database {
    public function updateUserDetails($id, $name, $email, $address, $contact, $dob, $password) {
        try {
            // Get database connection
            $pdo = $this->getConnection();

            // Update user details in the database
            $sql = "UPDATE users SET name=?, email=?, address=?, contact=?, dob=?, password=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $email, $address, $contact, $dob, $password, $id]);

            // Redirect to users page after update
            header("Location: admin_dashboard.php");
            exit();
        } catch (PDOException $e) {
            // Handle exception
            echo "Error: " . $e->getMessage();
        }
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];

    // Instantiate User class
    $user = new User();
    // Call updateUserDetails method to update user details
    $user->updateUserDetails($id, $name, $email, $address, $contact, $dob, $password);
}
?>
