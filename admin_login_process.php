<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username and password are provided
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        // Verify username and password (you can replace this with your authentication logic)
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Dummy authentication (replace with your actual authentication logic)
        if ($username === "admin" && $password === "admin") {
            // Set session variables
            $_SESSION["admin_logged_in"] = true;

            // Redirect to admin dashboard
            header("Location: admin_dashboard.php");
            exit;
        } else {
            // Set error message and redirect back to login page
            
            $_SESSION["login_error"] = "Invalid username or password.";
            header("Location: admin_login.php");
            exit;
        }
    }
}

// Redirect to login page with alert if accessed directly or if form data is missing
$_SESSION["login_error"] = "Please provide both username and password.";
header("Location: admin_login.php");
exit;
?>
