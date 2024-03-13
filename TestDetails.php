<?php

require_once 'Database.php';

class TestDetails {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getTestDetails() {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM test_details";
        $result = $conn->query($sql);
        $testDetails = [];
        if ($result && $result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $testDetails[] = $row;
            }
        }
        return $testDetails;
    }
    

    public function addTestDetail($testName, $testType, $description, $normalRange, $sampleType, $price, $preparationInstructions) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("INSERT INTO test_details (test_name, test_type, description, normal_range, sample_type, price, preparation_instructions) VALUES (:testName, :testType, :description, :normalRange, :sampleType, :price, :preparationInstructions)");
        $stmt->bindParam(":testName", $testName);
        $stmt->bindParam(":testType", $testType);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":normalRange", $normalRange);
        $stmt->bindParam(":sampleType", $sampleType);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":preparationInstructions", $preparationInstructions);
        
        // Execute the statement
        $result = $stmt->execute();
        unset($stmt); // Unset the statement object to free up resources
    
        return $result;
    }
    
    public function deleteTestDetail($id) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare('DELETE FROM test_details WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $result = $stmt->execute();
        $stmt->close();
        $this->db->closeConnection();
        return $result;
    }

    public function updateTestDetail($id, $testName, $testType, $description, $normalRange, $sampleType, $price, $preparationInstructions) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("UPDATE test_details SET test_name = :testName, test_type = :testType, description = :description, normal_range = :normalRange, sample_type = :sampleType, price = :price, preparation_instructions = :preparationInstructions WHERE id = :id");
        $stmt->bindParam(":testName", $testName);
        $stmt->bindParam(":testType", $testType);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":normalRange", $normalRange);
        $stmt->bindParam(":sampleType", $sampleType);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":preparationInstructions", $preparationInstructions);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        
        // Execute the statement
        $result = $stmt->execute();
        $stmt->closeCursor(); // Close cursor to allow the statement to be executed again
        return $result;
    }
    
    public function getTestDetailById($id) {
        $query = "SELECT * FROM test_details WHERE id = :id";
        $params = array(':id' => $id);
        $this->db->query($query);
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
}

?>
