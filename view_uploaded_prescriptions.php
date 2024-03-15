<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Uploaded Prescriptions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #555;
        }

        td {
            color: #333;
        }

        img {
            max-width: 100px;
            max-height: 100px;
            margin-right: 5px;
            margin-bottom: 5px;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .send-quote-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .send-quote-btn:hover {
            background-color: #45a049;
        }

        tr:nth-child(even) td {
            background-color: #e3f2fd;
        }

        tr:hover td {
            background-color: #ffcc80;
        }
    </style>
</head>
<body>
<?php
// Database connection information
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "abc laboratories";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch prescriptions data from the database
$sql = "SELECT * FROM prescriptions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output table header
    echo "<table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Note</th>
                    <th>Delivery Address</th>
                    <th>Delivery Time</th>
                    <th>Images</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["user_id"] . "</td>";
        echo "<td>" . $row["note"] . "</td>";
        echo "<td>" . $row["delivery_address"] . "</td>";
        echo "<td>" . $row["delivery_time"] . "</td>";
        // Display images with encoded URLs
        echo "<td>";
        for ($i = 1; $i <= 5; $i++) {
            $image_url = $row["image_" . $i];
            if (!empty($image_url)) {
                // Replace spaces and parentheses with HTML entities
                $image_url = str_replace(" ", "%20", $image_url);
                $image_url = str_replace("(", "%28", $image_url);
                $image_url = str_replace(")", "%29", $image_url);
                echo "<img src='" . $image_url . "' alt='Prescription Image'>";
            }
        }
        echo "</td>";
        // Button to send quote
        echo "<td><a href='prepare_quotations.php?user_id=" . $row["user_id"] . "' class='send-quote-btn'>Send Quote</a></td>";
        echo "</tr>";
    }
    echo "</tbody></table>"; // Close the table
} else {
    echo "No prescriptions found.";
}

$conn->close();
?>
</body>
</html>
