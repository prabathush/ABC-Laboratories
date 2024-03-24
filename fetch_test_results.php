<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(array('error' => 'User is not logged in'));
    exit();
}

// Include database connection file
require_once 'db_connection.php';

// Fetch test results for the logged-in user
$user_id = $_SESSION['user_id'];
$sql = "SELECT test_name, test_date, result, remarks, technician_name, doctor_name FROM test_results WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$test_results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if test results were found
if ($test_results) {
    echo json_encode($test_results);
} else {
    echo json_encode(array('error' => 'No test results found'));
}
?>
