<?php
include("db_connection.php");
include("dompdf/autoload.inc.php");

// Reference the Dompdf namespace
use Dompdf\Dompdf;

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

// Fetch patient data from the database
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    // Instantiate and use the dompdf class
    $dompdf = new Dompdf();
    ob_start(); // Start output buffering
    require('patient_data_pdf.php'); // Include the HTML template
    $html = ob_get_contents(); // Get the contents of the output buffer
    ob_get_clean(); // Clean (erase) the output buffer

    // Load HTML content into dompdf
    $dompdf->loadHtml($html);

    // Set paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to the browser
    $dompdf->stream('patient_data.pdf', ['Attachment' => false]);
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the MySQL connection
mysqli_close($conn);
?>
