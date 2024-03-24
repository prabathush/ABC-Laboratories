<?php
session_start();

// Check if the technician is logged in

// Retrieve test result details from the database based on the test ID
$test_id = $_GET["id"]; // Assuming the test ID is passed through the URL
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "abc laboratories"; // Replace 'your_database_name' with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die ("Connection failed: " . $conn->connect_error);
}

// Fetch test result details
$sql = "SELECT * FROM test_results WHERE result_id='$test_id'";
$result = $conn->query($sql);

// Check if the query was successful and test result exists
if ($result && $result->num_rows > 0) {
    $test_result = $result->fetch_assoc();
    $test_name = $test_result['test_name'];
    $test_date = $test_result['test_date'];
    $result = $test_result['result'];
    $remarks = $test_result['remarks'];
    $user_id = $test_result['user_id'];
    $technician_name = $test_result['technician_name'];
    $doctor_name = $test_result['doctor_name'];
} else {
    // Redirect to test results page if test result not found
    header("Location: tech_test_results.php");
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Test Result</title>
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
            background-color: #4CAF50;
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
        <h1>Edit Test Result</h1>
    </header>

    <form action="edit_test_result_process.php" method="POST">
        <input type="hidden" name="test_id" value="<?php echo $test_id; ?>">
        <div class="form-group">
            <label for="test_name">Test Name:</label>
            <input type="text" id="test_name" name="test_name" value="<?php echo $test_name; ?>" required>
        </div>
        <div class="form-group">
            <label for="test_date">Test Date:</label>
            <input type="date" id="test_date" name="test_date" value="<?php echo $test_date; ?>" required>
        </div>
        <div class="form-group">
            <label for="result">Result:</label>
            <input type="text" id="result" name="result" value="<?php echo $result; ?>" required>
        </div>
        <div class="form-group">
            <label for="remarks">Remarks:</label>
            <textarea id="remarks" name="remarks"><?php echo $remarks; ?></textarea>
        </div>
        <div class="form-group">
            <label for="user_id">user_id:</label>
            <input id="user_id" name="user_id" value="<?php echo $user_id; ?>">
        </div>
        <div class="form-group">
            <label for="technician_name">technician's name:</label>
            <input id="technician_name" name="technician_name" value="<?php echo $technician_name; ?>">
        </div>
        <div class="form-group">
            <label for="doctor_name">doctor's name:</label>
            <input id="doctor_name" name="doctor_name" value="<?php echo $doctor_name; ?>">
        </div>
        <div class="form-group">
            <button type="submit">Save Changes</button>
        </div>
    </form>

</body>

</html>