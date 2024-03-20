<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - ABC Laboratories</title>
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
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            margin-left: 500px; /* Adjusted margin-left to shift the form to the right */
        }


        h1 {
            margin-bottom: 30px;
            color: #003d7f; /* Updated color for the heading */
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px; /* Increased padding for better visibility */
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            padding-left: 35px; /* Added padding for icon */
        }

        input[type="text"]::placeholder,
        input[type="password"]::placeholder {
            color: #aaa;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #003d7f; /* Updated background color */
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .input-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }
    </style>
</head>
<body>

<div class="container">
    <h1><i class="fas fa-user-lock"></i> Admin Login</h1>
    <form action="admin_login_process.php" method="post">
        <div style="position: relative;">
            <i class="fas fa-user input-icon"></i>
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div style="position: relative;">
            <i class="fas fa-lock input-icon"></i>
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <input type="submit" value="Login">
    </form>
</div>

</body>
</html>
