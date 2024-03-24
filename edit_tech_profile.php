<?php
session_start();

// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['technician_id'])) {
    header("Location: technician_login.php");
    exit();
}

// Retrieve technician details from session variables
$technician_id = $_SESSION['technician_id'];
$technician_name = $_SESSION['technician_name'];
$technician_email = $_SESSION['technician_email'];
$technician_phone = $_SESSION['technician_phone'];
$technician_address = $_SESSION['technician_address'];
$technician_qualification = $_SESSION['technician_qualification'];
$technician_experience = $_SESSION['technician_experience'];
$technician_specialization = $_SESSION['technician_specialization'];

// If form is submitted, update the technician details in the database and session variables
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form submission and update the technician details in the database
    
    // Assuming you have validated and sanitized the input data before updating the database
    
    // Update session variables with the new values
    $_SESSION['technician_name'] = $_POST['name'];
    $_SESSION['technician_email'] = $_POST['email'];
    $_SESSION['technician_phone'] = $_POST['phone'];
    $_SESSION['technician_address'] = $_POST['address'];
    $_SESSION['technician_qualification'] = $_POST['qualification'];
    $_SESSION['technician_experience'] = $_POST['experience'];
    $_SESSION['technician_specialization'] = $_POST['specialization'];
    
    // Redirect to technician profile page after updating
    header("Location: tech_profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Technician Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-top: 0;
            color: #333;
            font-size: 24px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"] {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            padding: 10px;
            background-color: #003d7f;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .fa {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Technician Profile</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="name"><i class="fas fa-user"></i> Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $technician_name; ?>">
            
            <label for="email"><i class="fas fa-envelope"></i> Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $technician_email; ?>">
            
            <label for="phone"><i class="fas fa-phone"></i> Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo $technician_phone; ?>">
            
            <label for="address"><i class="fas fa-address-card"></i> Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $technician_address; ?>">
            
            <label for="qualification"><i class="fas fa-graduation-cap"></i> Qualification:</label>
            <input type="text" id="qualification" name="qualification" value="<?php echo $technician_qualification; ?>">
            
            <label for="experience"><i class="fas fa-briefcase"></i> Experience:</label>
            <input type="text" id="experience" name="experience" value="<?php echo $technician_experience; ?>">
            
            <label for="specialization"><i class="fas fa-certificate"></i> Specialization:</label>
            <input type="text" id="specialization" name="specialization" value="<?php echo $technician_specialization; ?>">
            
            <input type="submit" value="Save Changes">
        </form>
    </div>
</body>
</html>
