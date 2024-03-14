<?php

require_once 'Database.php';

// Check if ID parameter is provided
if (isset($_GET['id'])) {
    // Sanitize the ID
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Instantiate Database class
    $db = new Database();

    // Delete the inquiry
    $db->query("DELETE FROM inquiries WHERE id = :id", ['id' => $id]);

    // Redirect back to inquiries page
    header("Location: admin_dashboard.php");
    exit();
}
?>
