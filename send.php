<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Include necessary files and initialize session if needed
require_once "db_connection.php";
session_start();

if(isset($_POST["send"])){
    // Retrieve form data
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    try {
        // Send email
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

        $mail->setFrom('prabadhush23@gmail.com', 'Inquiries');//Your application NAME and EMAIL
        $mail->Subject= $subject;
        $mail->Body= $message;
        $mail->addAddress($email);

        $mail->send();

        // Update status in the inquiries table
        $status = "Resolved"; // Assuming "Resolved" is the new status after sending the response
        $inquiry_id = $_GET['id'];
        $sql = "UPDATE inquiries SET status = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$status, $inquiry_id]);

        echo
        "
        <script>
        alert('Response sent successfully');
        window.location.href ='admin_dashboard.php';
        </script>
        ";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
