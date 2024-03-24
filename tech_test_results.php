<?php
session_start();



$servername = "localhost";
    $username = "root";
    $password = ""; // Change this to your database password
    $dbname = "abc laboratories";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

// Fetch all test results
$sql = "SELECT * FROM test_results";
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Results exist, display them in a table
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Technician Test Results</title>
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

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th, td {
                padding: 12px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            th {
                background-color: #003d7f;
                color: white;
            }

            tr:hover {
                background-color: #f2f2f2;
            }

            .button-container {
                text-align: center;
                margin-top: 20px;
            }

            .button {
                background-color: #003d7f;
                color: white;
                padding: 12px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
                border-radius: 5px;
            }

            .edit-button {
                background-color: darkgreen;
            }

            .delete-button {
                background-color: darkred;
            }

            .edit-button:hover, .delete-button:hover {
                background-color: #003d7f;
            }
        </style>
    </head>
    <body>
    <header>
        <h1>Technician Test Results</h1>
    </header>

    <table>
        <tr>
            <th>Test Name</th>
            <th>User</th>
            <th>Test Date</th>
            <th>Result</th>
            <th>Remarks</th>
            <th>technician_name</th>
            <th>doctor_name</th>
            <th>Action</th>
        </tr>

        <?php

        
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row["test_name"]; ?></td>
                <td><?php echo $row["user_id"]; ?></td>
                <td><?php echo $row["test_date"]; ?></td>
                <td><?php echo $row["result"]; ?></td>
                <td><?php echo $row["remarks"]; ?></td>
                <td><?php echo $row["technician_name"]; ?></td>
                <td><?php echo $row["doctor_name"]; ?></td>
                <td>
                    <a class="button edit-button" href="edit_test_result.php?id=<?php echo $row["result_id"]; ?>">Edit</a>
                    <a class="button delete-button" href="delete_test_result.php?id=<?php echo $row["result_id"]; ?>">Delete</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>

    <div class="button-container">
        <a class="button" href="add_test_result.php">Add New Test Result</a>
    </div>

    </body>
    </html>

    <?php
} else {
    // No results found
    echo "No test results found.";
}

// Close database connection
$conn->close();
?>
