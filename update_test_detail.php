<?php
require_once 'TestDetails.php';
require_once 'Database.php';

$testDetailsObj = new TestDetails();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect form data
    $testId = $_POST['id'] ?? '';
    $testName = $_POST['test_name'] ?? '';
    $testType = $_POST['test_type'] ?? '';
    $description = $_POST['description'] ?? '';
    $normalRange = $_POST['normal_range'] ?? '';
    $sampleType = $_POST['sample_type'] ?? '';
    $price = $_POST['price'] ?? '';
    $preparationInstructions = $_POST['preparation_instructions'] ?? '';

    // Update test detail
    $result = $testDetailsObj->updateTestDetail($testId, $testName, $testType, $description, $normalRange, $sampleType, $price, $preparationInstructions);

    // Display success or error message based on result
    if ($result) {
        echo "<script>alert('Test detail updated successfully.'); window.location.href = 'admin_dashboard.php';</script>";
    } else {
        echo "<script>alert('Failed to update test detail.'); window.location.href = 'admin_dashboard.php';</script>";
    }
} 
?>
