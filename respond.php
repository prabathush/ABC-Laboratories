<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respond to Inquiry</title>
    <style>
       /* CSS styles for the Respond to Inquiry page */

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    text-align: center;
}

form {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"],
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

button[type="submit"] {
    background-color: #4caf50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>
    <h1>Respond to Inquiry</h1>
    <?php
    // Check if inquiry ID is provided in the URL
    if(isset($_GET['id'])) {
        // Retrieve inquiry ID from the URL
        $inquiry_id = $_GET['id'];
        
        // Include the necessary files and initialize the session if needed
        require_once "db_connection.php";
        session_start();

        // Retrieve the email address associated with the inquiry ID from the database
        $sql = "SELECT email FROM inquiries WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$inquiry_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $email = $row['email'] ; // Retrieve email address or set default value
        
        // Output the HTML form with the email address autofilled
        ?>
        <form action="send.php" method="post" style="max-width: 400px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
    <input type="hidden" name="email" value="<?= $email ?>">
    <label for="subject" style="color: #004da0; font-weight: bold;"><i class="fas fa-heading" style="color: #004da0;"></i> Subject:</label><br>
    <input type="text" id="subject" name="subject" placeholder="Subject" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;"><br>
    <label for="message" style="color: #004da0; font-weight: bold;"><i class="fas fa-comment" style="color: #004da0;"></i> Message:</label><br>
    <textarea id="message" name="message" placeholder="Message" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;"></textarea><br>
    <button type="submit" name="send" style="background-color: #004da0; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Send</button>
</form>

        <?php
    } else {
        // Inquiry ID not provided in the URL, display error message
        header("Location: admin_dashboard.php");
        exit();
    }
    ?>
</body>
</html>
