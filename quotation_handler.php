<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        // Redirect to login page if user is not logged in
        header("Location: user_login.php");
        exit();
    }

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

    // Get user's email address
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT email FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $recipient_email = $row['email'];
    } else {
        // User not found, handle error
        echo "Error: User not found.";
        exit();
    }

    // Get form data
    $drug = $_POST['drug'] ;
    $quantity = $_POST['quantity'] ;
    $price = $_POST['price'] ;

    // Insert quotation details into the database
    $sql = "INSERT INTO quotations (user_id, drug, quantity, price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isdd", $user_id, $drug, $quantity, $price);

    if ($stmt->execute()) {
        // Quotation details inserted successfully
        echo "Quotation details inserted successfully.";
    } else {
        // Error inserting quotation details
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>
