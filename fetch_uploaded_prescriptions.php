<?php
// Check if user is logged in

// Database connection information
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

// Fetch prescriptions uploaded by users
$sql = "SELECT * FROM prescriptions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $prescriptions = array();
    while ($row = $result->fetch_assoc()) {
        // Fetch images for each prescription (assuming you have a separate table for images)
        $images = array();
        $sql_images = "SELECT * FROM prescription_images WHERE prescription_id = " . $row['id'];
        $result_images = $conn->query($sql_images);
        if ($result_images->num_rows > 0) {
            while ($row_image = $result_images->fetch_assoc()) {
                // Assuming the image URLs are stored in a column named 'image_url'
                $images[] = array("url" => $row_image['image_url']);
            }
        }
        
        // Add prescription data to the prescriptions array
        $prescriptions[] = array(
            "id" => $row['id'],
            "note" => $row['note'],
            "delivery_address" => $row['delivery_address'],
            "delivery_time" => $row['delivery_time'],
            "images" => $images
        );
    }
    
    // Return prescriptions data as JSON
    echo json_encode($prescriptions);
} else {
    echo json_encode(array()); // Return an empty array if no prescriptions found
}

// Close database connection
$conn->close();
?>
