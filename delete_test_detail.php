<?php

require_once 'TestDetails.php';
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Check if the ID parameter is provided
    if (isset($_GET['id'])) {
        // Create TestDetails object
        $testDetails = new TestDetails();

        // Delete the test detail with the provided ID
        $result = $testDetails->deleteTestDetail($_GET['id']);

        // Respond with appropriate status
        if ($result) {
            http_response_code(200);
            echo 'Test detail deleted successfully.';
        } else {
            http_response_code(500);
            echo 'Failed to delete test detail.';
        }
    } else {
        http_response_code(400);
        echo 'ID parameter is missing.';
    }
} 

?>