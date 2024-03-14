<?php

require_once 'Database.php';

class InquiryDeletion {
    private $db;

    public function __construct() {
        // Instantiate Database class
        $this->db = new Database();
    }

    public function deleteInquiry($id) {
        // Delete the inquiry
        $this->db->query("DELETE FROM inquiries WHERE id = :id", ['id' => $id]);
    }
}

// Check if ID parameter is provided
if (isset($_GET['id'])) {
    // Sanitize the ID
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Instantiate InquiryDeletion object
    $inquiryDeletion = new InquiryDeletion();

    // Delete the inquiry
    $inquiryDeletion->deleteInquiry($id);

    // Redirect back to inquiries page
    header("Location: admin_dashboard.php");
    exit();
}
?>
