<?php
// Include the database connection file
require_once "db_connection.php";

// Check if the user is logged in and get the user ID from the session
session_start();
if(isset($_SESSION["user_id"])) {
    $userId = $_SESSION["user_id"];

    // Prepare and execute the query to fetch user details from the database
    $sql = "SELECT id, name, email, address, contact, dob FROM users WHERE id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch user details as an associative array
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if user details are found
    if ($user) {
        // Return user details as JSON response
        header("Content-Type: application/json");
        echo json_encode($user);
        exit();
    } else {
        // User details not found
        http_response_code(404);
        echo json_encode(array("message" => "User not found."));
    }
} else {
    // User is not logged in
    http_response_code(403);
    echo json_encode(array("message" => "Unauthorized access."));
}
?>
