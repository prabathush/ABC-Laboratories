<?php
session_start();

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

    // Retrieve user data from the database based on email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['password'])) {
            // Authentication successful, set session variables
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["user_name"] = $row["name"];
            // Redirect to dashboard or desired page
            header("location: user_dashboard.php");
            exit();
        } else {
            // Authentication failed, redirect back to login page with error message
            $_SESSION["error"] = "Invalid email or password. Please try again.";
            header("location: userlogin.php");
            exit();
        }
    } else {
        // No user found with the provided email, redirect back to login page with error message
        $_SESSION["error"] = "User not found. Please try again.";
        header("location: userlogin.php");
        exit();
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect back to login page if accessed directly
    header("location: userlogin.php");
    exit();
}
?>
