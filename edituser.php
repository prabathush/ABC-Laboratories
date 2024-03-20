<!-- edituser.php -->
<?php include 'db_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            width: 600px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .form-group label {
            width: 120px;
            margin-right: 10px;
            text-align: right;
            font-weight: bold;
        }

        .form-group input {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group input[type="submit"] {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2>Edit User</h2>
            <?php
            // Retrieve user data based on provided ID
            $id = $_GET['id'];
            $sql = "SELECT * FROM users WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            <form action="edituserprocess.php" method="post">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?= $user['name'] ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?= $user['email'] ?>">
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="<?= $user['address'] ?>">
                </div>
                <div class="form-group">
                    <label for="contact">Contact:</label>
                    <input type="text" id="contact" name="contact" value="<?= $user['contact'] ?>">
                </div>
                <div class="form-group">
                    <label for="dob">DOB:</label>
                    <input type="date" id="dob" name="dob" value="<?= $user['dob'] ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" value="<?= $user['password'] ?>">
                </div>
                <div class="form-group">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="submit" value="Update">
                </div>
            </form>
        </div>
    </div>
</body>

</html>