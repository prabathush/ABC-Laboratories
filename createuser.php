<!-- createuser.php -->
<?php include 'db_connection.php'; ?>

<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];
    
    // Insert new user into database
    $sql = "INSERT INTO users (name, email, address, contact, dob, password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $address, $contact, $dob, $password]);
    
    // Redirect to users page after creation
    header("Location: admin_dashbaord.php");
    exit();
}
?>
