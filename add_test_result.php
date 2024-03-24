<?php
session_start();

// Check if the technician is logged in

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Test Result</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        header {
            background-color: #003d7f;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            width: 100%;
        }

        h1 {
            margin: 0;
            font-size: 24px;
        }

        form {
            width: 60%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group textarea {
            width: calc(100% - 12px);
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .form-group textarea {
            height: 100px;
        }

        .form-group button {
            background-color: darkgreen;
            color: white;
            padding: 12px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<header>
    <h1>Add New Test Result</h1>
</header>

<form action="add_test_result_process.php" method="POST">
    <div class="form-group">
        <label for="test_name">Test Name:</label>
        <input type="text" id="test_name" name="test_name" required>
    </div>
    <div class="form-group">
        <label for="test_date">Test Date:</label>
        <input type="date" id="test_date" name="test_date" required>
    </div>
    <div class="form-group">
        <label for="result">Result:</label>
        <input type="text" id="result" name="result" required>
    </div>
    <div class="form-group">
        <label for="technician_name">technician's name:</label>
        <input type="text" id="technician_name" name="technician_name" required>
    </div>
    <div class="form-group">
        <label for="doctor_name">Doctor's name:</label>
        <input type="text" id="doctor_name" name="doctor_name" required>
    </div>
    <div class="form-group">
        <label for="remarks">Remarks:</label>
        <textarea id="remarks" name="remarks"></textarea>
    </div>
    <div class="form-group">
        <label for="user_id">User ID:</label>
        <input type="text" id="user_id" name="user_id" required>
    </div>
    <div class="form-group">
        <button type="submit">Submit</button>
    </div>
</form>

</body>
</html>
