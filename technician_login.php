<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('bg2.png');
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            max-width: 600px;
            padding: 30px; /* Increased padding for a bit bigger form */
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 800px; /* Adjusted margin-left */
        }
        h2 {
            margin-top: 0;
            color: #333;
            font-size: 24px;
            text-align: center;
        }
        form {
            text-align: center;
        }
        label {
            color: #333;
            font-weight: bold;
            display: block;
            margin-bottom: 10px; /* Adjusted margin */
        }
        input[type="email"],
        input[type="password"] {
            width: 80%; /* Adjusted width */
            padding: 12px; /* Increased padding */
            margin-bottom: 20px; /* Increased margin */
            border-radius: 5px;
            border: 1px solid #ccc;
            padding-left: 40px; /* Added padding for icon */
        }
        input[type="email"]::placeholder,
        input[type="password"]::placeholder {
            color: #aaa;
        }
        input[type="submit"] {
            padding: 12px 20px; /* Increased padding */
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
        .register-link {
            display: block;
            text-align: center;
            margin-top: 20px; /* Increased margin */
            color: #003d7f;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Technician Login</h2>
        <form action="technician_login_process.php" method="post">
            <label for="email"><i class="fas fa-envelope"></i> Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password"><i class="fas fa-lock"></i> Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Login">
        </form>
        <a href="technician_register.php" class="register-link">Don't have an account? Click here to register</a>
    </div>
</body>
</html>
