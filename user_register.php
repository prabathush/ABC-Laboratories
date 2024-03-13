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
</head>
<body>
    <div class="container">
        <h2>User Registration</h2>
        <form action="register_process.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
            <label for="contact">Contact No:</label>
            <input type="text" id="contact" name="contact" required>
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
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
