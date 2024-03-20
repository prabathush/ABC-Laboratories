<?php
// Include the database connection file
require_once "db_connection.php";

// Check if the ID parameter is provided in the URL
if(isset($_GET['id'])) {
    // Retrieve the appointment ID from the URL
    $appointmentId = $_GET['id'];

    // Prepare and execute the query to fetch appointment details
    $sql = "SELECT * FROM appointments WHERE ID = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $appointmentId, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch appointment details
    $appointment = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($appointment) {
        // Appointment found, display the edit form
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Appointment</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
}

h2 {
    text-align: center;
}

form {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
}

div {
    margin-bottom: 15px;
}

label {
    display: block;
    font-weight: bold;
}

input[type="text"],
input[type="email"],
input[type="date"],
input[type="time"],
select {
    width: calc(100% - 10px);
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: #007bff;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <h2>Edit Appointment</h2>
    <form action="user_process_edit_appointment.php" method="post">
        <input type="hidden" name="id" value="<?= $appointment['ID'] ?>">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?= $appointment['name'] ?>" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= $appointment['email'] ?>" required>
        </div>
        <div>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?= $appointment['phone'] ?>" required>
        </div>
        <div>
            <label for="date">Appointment Date:</label>
            <input type="date" id="date" name="appointment_date" value="<?= $appointment['appointment_date'] ?>" required>
        </div>
        <div>
            <label for="time">Appointment Time:</label>
            <input type="time" id="time" name="appointment_time" value="<?= $appointment['appointment_time'] ?>" required>
        </div>
        <div>
            <label for="type">Appointment Type:</label>
            <select id="type" name="appointment_type" required>
                <option value="Regular" <?= ($appointment['appointment_type'] == 'Regular') ? 'selected' : '' ?>>Regular</option>
                <option value="Urgent" <?= ($appointment['appointment_type'] == 'Urgent') ? 'selected' : '' ?>>Urgent</option>
            </select>
        </div>
        <div>
            <label for="section">Section:</label>
            <input type="text" id="section" name="section" value="<?= $appointment['section'] ?>" required>
        </div>
        <input type="submit" value="Update Appointment">
    </form>
</body>
</html>
<?php
    } else {
        // Appointment not found
        echo "Appointment not found.";
    }
} else {
    // ID parameter not provided in the URL
    echo "Appointment ID not provided.";
}
?>
