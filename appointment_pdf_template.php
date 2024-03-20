<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Appointment Details</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            color: #333;
            font-size: 8px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        .message {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border-left: 4px solid #007bff;
            text-align: center;
            font-style: italic;
        }
        .note {
            font-size: 12px;
            color: #777;
            margin-bottom: 10px;
        }
        .copyright {
            text-align: center;
            margin-top: 20px;
            color: #777;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Appointment Details</h1>
        <div class="message">
            <p>Welcome to the Appointment Details Page</p>
            <p>Here you can view all appointments in detail.</p>
        </div>
        <div class="note">
            <p>Note: This table displays detailed information about appointments.</p>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Appointment Type</th>
                <th>Section</th>
                <th>Created At</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['ID'] ?></td>
                <td><?= $row['user_id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['phone'] ?></td>
                <td><?= $row['appointment_date'] ?></td>
                <td><?= $row['appointment_time'] ?></td>
                <td><?= $row['appointment_type'] ?></td>
                <td><?= $row['section'] ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
            <?php } ?>
        </table>
        <div class="copyright">
            <p>&copy; <?= date('Y') ?> ABC Laboratories. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
