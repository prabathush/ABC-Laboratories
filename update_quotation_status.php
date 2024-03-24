<?php
// Start session
include 'fetch_quotations_php';
session_start();

class QuotationStatusUpdater {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        // Create connection
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($this->conn->connect_error) {
            // Return an error response if connection failed
            http_response_code(500);
            echo "Error: Connection failed.";
            exit();
        }
    }

    public function updateQuotationStatus($quotationId, $status) {
        // Update the status of the quotation in the database
        $sql = "UPDATE quotations SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $status, $quotationId);

        if ($stmt->execute()) {
            // Return a success response if update was successful
            echo "Quotation status updated successfully.";
        } else {
            // Return an error response if update failed
            http_response_code(500);
            echo "Error: Failed to update quotation status.";
        }
    }

    public function closeConnection() {
        // Close database connection
        $this->conn->close();
    }
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        // Return an error response if user is not logged in
        http_response_code(403);
        echo "Error: User is not logged in.";
        exit();
    }

    // Database connection information
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "abc laboratories";

    // Get quotation ID and new status from the POST request
    $quotationId = $_POST['quotationId'] ;
    $status = $_POST['status'] ;

    // Create instance of QuotationStatusUpdater
    $quotationStatusUpdater = new QuotationStatusUpdater($servername, $username, $password, $dbname);

    // Update the status of the quotation
    $quotationStatusUpdater->updateQuotationStatus($quotationId, $status);

    // Close database connection
    $quotationStatusUpdater->closeConnection();
} else {
    // Return an error response if request method is not POST
    http_response_code(405);
    echo "Error: Method Not Allowed.";
}
?>
