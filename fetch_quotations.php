<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        // Redirect to login page if user is not logged in
        header("Location: userlogin.php");
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

    // Get user ID
    $user_id = $_SESSION['user_id'];

    // Query to retrieve quotation details for the particular user
    $sql = "SELECT * FROM quotations WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();


    
    // Display quotation details
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"]. " - Drug: " . $row["drug"]. " - Quantity: " . $row["quantity"]. " - Price: " . $row["price"]. "<br>";
        }
    } else {
        echo "No quotation details found.";
    }

    // Close database connection
    $conn->close();
}
?>
