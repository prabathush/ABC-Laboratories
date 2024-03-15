<?php
// Database class to handle database connection and operations
class Database {
    private $host = "localhost";
    private $dbname = "abc laboratories";
    private $username = "root";
    private $password = ""; // Please replace this with your actual database password
    protected $pdo;

    public function __construct() {
        try {
            // Establish a database connection
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password);
            // Set PDO error mode to exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Display error message if connection fails
            die("Connection failed: " . $e->getMessage());
        }
    }
}

// TestDetails class to handle test details operations
class TestDetails extends Database {
    public function updateTestDetails($id, $test_name, $test_type, $description, $normal_range, $sample_type, $price, $preparation_instructions) {
        try {
            // Update database record
            $sql = "UPDATE test_details SET test_name=?, test_type=?, description=?, normal_range=?, sample_type=?, price=?, preparation_instructions=? WHERE id=?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$test_name, $test_type, $description, $normal_range, $sample_type, $price, $preparation_instructions, $id]);
            
            // Redirect to test details page after update
            header("Location: admin_dashboard.php");
            exit();
        } catch (PDOException $e) {
            // Handle exception
            echo "Error: " . $e->getMessage();
        }
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $test_name = $_POST['test_name'];
    $test_type = $_POST['test_type'];
    $description = $_POST['description'];
    $normal_range = $_POST['normal_range'];
    $sample_type = $_POST['sample_type'];
    $price = $_POST['price'];
    $preparation_instructions = $_POST['preparation_instructions'];

    // Instantiate TestDetails class
    $testDetails = new TestDetails();
    // Call updateTestDetails method to update test details
    $testDetails->updateTestDetails($id, $test_name, $test_type, $description, $normal_range, $sample_type, $price, $preparation_instructions);
}
?>
