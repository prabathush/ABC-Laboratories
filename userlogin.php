<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('bg2.png'); /* Background image */
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
    background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 350px; /* Increased width for the container */
    text-align: center;
    margin-left: 350px; /* Adjusted margin-left to move the form to the right */
}

        h2 {
            margin-bottom: 30px;
            color: #003d7f; /* Text color */
        }

        label {
            color: #333; /* Label color */
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 16px;
            padding-left: 40px; /* Added padding for icon */
        }

        input[type="email"]::placeholder,
        input[type="password"]::placeholder {
            color: #aaa;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #003d7f; /* Button background color */
            border: none;
            border-radius: 5px;
            color: #fff; /* Button text color */
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #0056b3; /* Button background color on hover */
        }

        p {
            margin-top: 20px; /* Adjusted margin for the paragraph */
            color: #333; /* Text color */
        }

        p a {
            color: #003d7f; /* Link color */
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><i class="fas fa-user"></i> Patient Login</h2>
        <form action="userlogin_process.php" method="post">
            <label for="email"><i class="fas fa-envelope"></i> Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <label for="password"><i class="fas fa-lock"></i> Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <button type="submit"><i class="fas fa-sign-in-alt"></i> Login</button>
        </form>
        <p>Don't have an account? <a href="user_register.php">Register here</a></p>
    </div>
</body>
</html>
