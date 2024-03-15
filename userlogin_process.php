<?php
session_start();

class UserAuthenticator {
    private $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }

    public function authenticateUser($email, $password) {
        // Retrieve user data from the database based on email
        $stmt = $this->conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify password
            if (password_verify($password, $row['password'])) {
                // Authentication successful, set session variables
                $_SESSION["user_id"] = $row["id"];
                $_SESSION["user_name"] = $row["name"];
                return true;
            }
        }
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection information
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "abc laboratories";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get input values
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Instantiate UserAuthenticator object
    $authenticator = new UserAuthenticator($conn);

    // Call authenticateUser method
    if ($authenticator->authenticateUser($email, $password)) {
        // Authentication successful, redirect to dashboard
        header("Location: user_dashboard.php");
        exit();
    } else {
        // Authentication failed, set session error message
        $_SESSION["error"] = "Invalid email or password. Please try again.";
        // Redirect to login page
        echo "<script>alert('Invalid email or password. Please try again.'); window.location.href='userlogin.php';</script>";
        exit();
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect back to login page if accessed directly
    header("Location: userlogin.php");
    exit();
}
?>
