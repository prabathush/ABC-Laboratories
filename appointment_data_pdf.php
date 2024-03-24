<?php
// Include necessary files
include ("db_connection.php");
include ("dompdf/autoload.inc.php");

// Reference the Dompdf namespace
use Dompdf\Dompdf;

// Database connection details
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

// Query to retrieve appointment data
$sql = "SELECT * FROM appointments";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result && mysqli_num_rows($result) > 0) {
    // Instantiate Dompdf
    $dompdf = new Dompdf();
    
    // Start output buffering
    ob_start();
    
    // Include the HTML template
    require('appointment_pdf_template.php');
    
    // Get the contents of the output buffer
    $html = ob_get_contents();
    
    // Clean (erase) the output buffer
    ob_get_clean();
    
    // Load HTML content into Dompdf
    $dompdf->loadHtml($html);
    
    // Set paper size and orientation
    $dompdf->setPaper('A4', 'portrait');
    
    // Render the HTML as PDF
    $dompdf->render();
    
    // Output the generated PDF to the browser
    $dompdf->stream('appointment_details.pdf', ['Attachment' => false]);
} else {
    echo "No appointments found.";
}

// Close the MySQL connection
mysqli_close($conn);
?>
