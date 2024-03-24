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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        td {
            background-color: #fff;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .edit-button {
            padding: 10px 20px;
            background-color: #003d7f;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
        }
        .edit-button:hover {
            background-color: #0056b3;
        }
        .edit-button i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Technician Profile</h2>
        <table>
            <tr>
                <th>Field</th>
                <th>Details</th>
            </tr>
            <tr>
                <td>Technician ID</td>
                <td><?php echo $technician_id; ?></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><?php echo $technician_name; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?php echo $technician_email; ?></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td><?php echo $technician_phone; ?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?php echo $technician_address; ?></td>
            </tr>
            <tr>
                <td>Qualification</td>
                <td><?php echo $technician_qualification; ?></td>
            </tr>
            <tr>
                <td>Experience</td>
                <td><?php echo $technician_experience; ?></td>
            </tr>
            <tr>
                <td>Specialization</td>
                <td><?php echo $technician_specialization; ?></td>
            </tr>
        </table>
        <div class="button-container">
        <button class="edit-button" onclick="location.href='tech_dashboard.php';">
        <i class="fas fa-arrow-left"></i> Go Back to Dashboard
    </button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button class="edit-button" onclick="location.href='edit_tech_profile.php';">
                <i class="fas fa-edit"></i> Edit Profile
            </button>
            </button>
           </body>
        </div>
    </div>
</body>
</html>
