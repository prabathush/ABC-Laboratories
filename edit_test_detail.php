<?php
require_once 'TestDetails.php';
require_once 'updatetest.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    // Get form data
    $id = $_POST['id'];
    $testName = $_POST['test_name'];
    $testType = $_POST['test_type'];
    $description = $_POST['description'];
    $normalRange = $_POST['normal_range'];
    $sampleType = $_POST['sample_type'];
    $price = $_POST['price'];
    $preparationInstructions = $_POST['preparation_instructions'];

    // Instantiate TestDetails object
    $testDetailsObj = new TestDetails();

    // Update test detail
    $result = $testDetailsObj->updateTestDetail($id, $testName, $testType, $description, $normalRange, $sampleType, $price, $preparationInstructions);

    // Check if update was successful
    if ($result) {
        // Redirect to admin dashboard or any other page
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // Handle update failure
        echo "Failed to update test detail.";
    }
} else {
    // Redirect to homepage or display an error message
    echo "Invalid request.";
}
?>
