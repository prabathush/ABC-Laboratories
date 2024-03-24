<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Quotations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #e0e0e0;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #003d7f;
            color: white;
            text-transform: uppercase;
        }

        td {
            background-color: #f9f9f9;
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

// Fetch quotations data from the database
$sql = "SELECT * FROM quotations";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output table header
    echo "<table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Drug</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Created At</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["user_id"] . "</td>";
        echo "<td>" . $row["drug"] . "</td>";
        echo "<td>" . $row["quantity"] . "</td>";
        echo "<td>" . $row["price"] . "</td>";
        echo "<td>" . $row["created_at"] . "</td>";
        echo "<td>" . $row["status"] . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>"; // Close the table
} else {
    echo "No quotations found.";
}

$conn->close();
?>
</body>
</html>
