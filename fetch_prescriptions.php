<?php
// Manual database connection details
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

// Check if user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header("Location: userlogin.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Prepare and execute SQL statement to fetch prescriptions
$sql = "SELECT * FROM prescriptions WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

// Fetch prescriptions as associative array
$prescriptions = [];
while ($row = $result->fetch_assoc()) {
    $prescriptions[] = $row;
}

// Close database connection
$conn->close();

// Return prescriptions data as JSON
header('Content-Type: application/json');
echo json_encode($prescriptions);
?>
