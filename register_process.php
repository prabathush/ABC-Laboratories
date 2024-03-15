<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

class UserRegistration {
    private $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }

    public function registerUser($name, $email, $address, $contact, $dob, $password) {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and bind parameters
        $stmt = $this->conn->prepare("INSERT INTO users (name, email, address, contact, dob, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $email, $address, $contact, $dob, $hashed_password);
        $this->sendRegistrationEmail($email, $name, $password); // Registration successful

        
        // Execute query
        if ($stmt->execute()) {
            return true;
        } else {
            return false; // Registration failed
        }
    }

    // Function to send registration confirmation email
    private function sendRegistrationEmail($email, $name, $password) {
        $mail = new PHPMailer(true);

        $mail->isSMTP();// Set mailer to use SMTP
        $mail->CharSet = "utf-8";// set charset to utf8
        $mail->SMTPAuth = true;// Enable SMTP authentication
        $mail->SMTPSecure = 'tls';// Enable TLS encryption, `ssl` also accepted

        $mail->Host = 'smtp.gmail.com';// Specify main and backup SMTP servers
        $mail->Port = 587;// TCP port to connect to
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->isHTML(true);// Set email format to HTML

        $mail->Username = 'prabadhush23@gmail.com';// SMTP username
        $mail->Password = 'hnhewhkpqrimxfud';// SMTP password

        $mail->isHTML(true);

        $mail->setFrom('prabadhush23@gmail.com', 'ABC Laboratories');//Your application NAME and EMAIL
        $mail->Subject= 'Registration Confirmation';
        
        $mail->addAddress($email);
        
        // Build the email body with company logo, credentials, and a personalized message
        $emailBody = '<html><body>';
        $emailBody .= '<div style="background-color: #f4f4f4; padding: 20px;">';
        // $emailBody .= '<img src="https://example.com/logo.png" alt="ABC Laboratories Logo" style="max-width: 200px; margin-bottom: 20px;">';
        $emailBody .= '<h1 style="color: #004d99; font-size: 24px; margin-bottom: 20px;text-align: center;">Welcome to ABC Laboratories!</h1>';
        $emailBody .= '<p style="margin-bottom: 20px;">Dear ' . $name . ',</p>';
        $emailBody .= '<p style="margin-bottom: 20px;">We are pleased to inform you that your account has been successfully registered with ABC Laboratories.</p>';
        $emailBody .= '<p style="margin-bottom: 20px;">Your account details:</p>';
        $emailBody .= '<ul style="margin-bottom: 20px;">';
        $emailBody .= '<li><strong>Email:</strong> ' . $email . '</li>';
        $emailBody .= '<li><strong>Password:</strong> ' . $password . '</li>';
        $emailBody .= '</ul>';
        $emailBody .= '<p style="margin-bottom: 20px;">Thank you for choosing ABC Laboratories for your healthcare needs.</p>';
        $emailBody .= '<p style="margin-bottom: 20px;">Best regards,<br>ABC Laboratories Team</p>';
        $emailBody .= '</div>';
        $emailBody .= '<p style="font-size: 12px; color: #777777; text-align: center; margin-top: 20px;">';
        $emailBody .= 'This email is confidential and intended solely for the use of the individual to whom it is addressed. ';
        $emailBody .= 'If you have received this email in error, please notify us immediately and delete it from your system.<br> ';
        $emailBody .= 'Copyright © ' . date("Y") . ' ABC Laboratories. All rights reserved.';
        $emailBody .= '</p>';
        $emailBody .= '</body></html>';

        $mail->Body= $emailBody;

        $mail->send();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    // Get input values
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $password = $conn->real_escape_string($_POST['password']);

    // Instantiate UserRegistration object
    $userRegistration = new UserRegistration($conn);

    // Call registerUser method
    if ($userRegistration->registerUser($name, $email, $address, $contact, $dob, $password)) {
        // Registration successful, redirect to login page
        header("location: userlogin.php");
        exit();
    } else {
        // Registration failed, redirect back to registration page with error message
        $_SESSION["error"] = "Registration failed. Please try again.";
        header("location: user_register.php");
        exit();
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect back to registration page if accessed directly
    header("location: user_register.php");
    exit();
}
?>
