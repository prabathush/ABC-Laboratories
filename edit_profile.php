<?php
// Include the database connection file
require_once "db_connection.php";

// Check if the user is logged in
session_start();
if (!isset($_SESSION["user_id"])) {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Get the user ID from the session
$userId = $_SESSION["user_id"];

// Fetch the user details from the database
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userId]);
$userProfile = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the user profile exists
if (!$userProfile) {
    // Redirect or display error if user profile not found
    echo "User profile not found.";
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Process the form submission to update the user profile
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $contact = $_POST["contact"];
    $dob = $_POST["dob"];

    // Update the user profile in the database
    $sql = "UPDATE users SET name = ?, email = ?, address = ?, contact = ?, dob = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $address, $contact, $dob, $userId]);

    // Redirect to the profile page after successful update
    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <!-- Add your CSS stylesheets or include them from external files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #001934;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Profile <i class="fas fa-user-edit" style="color: #001934;"></i></h2>
        <form action="edit_profile_process.php" method="post">
            <label for="name"><i class="fas fa-user" style="color: #001934;"></i> Name:</label>
            <input type="text" id="name" name="name" value="<?= $userProfile['name'] ?>" required><br><br>
            <label for="email"><i class="fas fa-envelope" style="color: #001934;"></i> Email:</label>
            <input type="email" id="email" name="email" value="<?= $userProfile['email'] ?>" required><br><br>
            <label for="address"><i class="fas fa-map-marker-alt" style="color: #001934;"></i> Address:</label>
            <input type="text" id="address" name="address" value="<?= $userProfile['address'] ?>" required><br><br>
            <label for="contact"><i class="fas fa-phone" style="color: #001934;"></i> Contact:</label>
            <input type="text" id="contact" name="contact" value="<?= $userProfile['contact'] ?>" required><br><br>
            <label for="dob"><i class="fas fa-calendar-alt" style="color: #001934;"></i> Date of Birth:</label>
            <input type="date" id="dob" name="dob" value="<?= $userProfile['dob'] ?>" required><br><br>
            <input type="submit" value="Update Profile">
        </form>
    </div>
</body>
</html>
