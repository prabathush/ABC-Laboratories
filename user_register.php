<?php
class UserRegistrationForm {
    public function __construct() {}

    public function render() {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-image: url('bg2.png');
            background-size: cover;
            background-position: right;
        }
        .container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-left: 700px;
    /* Adjusted margin-left to move the form to the right */
}
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            width: 200%;
            padding: 10px;
            background-color: #033b77;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        p {
            text-align: center;
            margin-top: 10px;
        }
        p a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body><br><br><br><br><br><br>
    <div class="container">
        <h2>Patient Registration</h2>
        <form action="register_process.php" method="post">
            <div>
                <label for="name"><i class="fas fa-user"></i> Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="email"><i class="fas fa-envelope"></i> Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="address"><i class="fas fa-map-marker-alt"></i> Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div>
                <label for="contact"><i class="fas fa-phone"></i> Contact No:</label>
                <input type="text" id="contact" name="contact" required>
                <label for="dob"><i class="fas fa-calendar-alt"></i> Date of Birth:</label>
                <input type="date" id="dob" name="dob" required>
                <label for="password"><i class="fas fa-lock"></i> Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="userlogin.php">Login here</a></p>
    </div>
</body>
</html>
<?php
    }
}

$userRegistrationForm = new UserRegistrationForm();
$userRegistrationForm->render();
?>
