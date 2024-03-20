<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician Registration</title>
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
        .register-container {
            max-width: 600px;
            padding: 30px; /* Increased padding for a bit bigger form */
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 750px; /* Adjusted margin-left */
            
        }
        h2 {
            margin-top: 0;
            color: #333;
            font-size: 24px;
            text-align: center;
        }
        form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
            
        }
        label {
            color: #333;
            font-weight: bold;
            display: block;
            width: 45%; /* Adjusted width for labels */
            margin-bottom: 10px; /* Adjusted margin */
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 45%; /* Adjusted width for input fields */
            padding: 12px; /* Increased padding */
            margin-bottom: 20px; /* Increased margin */
            border-radius: 5px;
            border: 1px solid #ccc;
            padding-left: 40px; /* Added padding for icon */
        }
        input[type="text"]::placeholder,
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
            width: auto; /* Adjusted width for submit button */
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .register-link {
            display: block;
            text-align: center;
            margin-top: 20px; /* Adjusted margin */
            color: #003d7f;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Technician Registration</h2>
        <form action="technician_register_process.php" method="post">
            <label for="name"><i class="fas fa-user"></i> Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="email"><i class="fas fa-envelope"></i> Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="phone"><i class="fas fa-phone"></i> Phone:</label>
            <input type="text" id="phone" name="phone" required>
            <label for="address"><i class="fas fa-map-marker-alt"></i> Address:</label>
            <input type="text" id="address" name="address" required>
            <label for="qualification"><i class="fas fa-graduation-cap"></i> Qualification:</label>
            <input type="text" id="qualification" name="qualification" required>
            <label for="experience"><i class="fas fa-briefcase"></i> Experience:</label>
            <input type="text" id="experience" name="experience" required>
            <label for="specialization"><i class="fas fa-cogs"></i> Specialization:</label>
            <input type="text" id="specialization" name="specialization" required>
            <label for="password"><i class="fas fa-lock"></i> Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Register">
        </form>
        
        <a href="technician_login.php" class="register-link">Already have an account? Click here to log in</a>
    </div>
</body>
</html>
