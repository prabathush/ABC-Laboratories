<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection file
    require_once "db_connection.php";

    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $qualification = $_POST["qualification"];
    $experience = $_POST["experience"];
    $specialization = $_POST["specialization"];

    // SQL query to check if the email already exists in the database
$checkEmailQuery = "SELECT COUNT(*) FROM technicians WHERE email = ?";
$stmtCheckEmail = $pdo->prepare($checkEmailQuery);
$stmtCheckEmail->execute([$email]);
$emailExists = $stmtCheckEmail->fetchColumn();

if ($emailExists) {
    // Redirect back to the create technician page with an error message
    header("Location: admin_create_technician.php?error=duplicate_email");
    exit;
}

// If email is not duplicate, proceed with the insertion


    // SQL query to insert new technician into the database
    $sql = "INSERT INTO technicians (name, email, phone, address, qualification, experience, specialization) VALUES (?, ?, ?, ?, ?, ?, ?)";

    try {
        // Prepare the SQL statement
        $stmt = $pdo->prepare($sql);

        // Bind parameters and execute the statement
        $stmt->execute([$name, $email, $phone, $address, $qualification, $experience, $specialization]);

        // Redirect to technicians page after successful creation
        header("Location: admin_dashboard.php");
        exit;
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
} else {
    // Redirect back to the create technician page if the form is not submitted
    header("Location: admin_dashboard.php");
    exit;
}
?>
