<?php
class AppointmentEditor {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAppointmentById($appointmentId) {
        // Fetch appointment details from the database based on the ID
        $sql = "SELECT * FROM appointments WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$appointmentId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateAppointment($appointmentId, $name, $email, $phone, $appointmentDate, $appointmentTime, $appointmentType, $section) {
        try {
            // Update appointment details in the database
            $sql = "UPDATE appointments SET name = ?, email = ?, phone = ?, appointment_date = ?, appointment_time = ?, appointment_type = ?, section = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$name, $email, $phone, $appointmentDate, $appointmentTime, $appointmentType, $section, $appointmentId]);

            // Redirect to appointments list page after successful update
            header("Location: admin_dashboard.php");
            exit;
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
        }
    }
}

// Include database connection file
require_once "db_connection.php";

// Instantiate AppointmentEditor object
$appointmentEditor = new AppointmentEditor($pdo);

// Check if appointment ID is provided in the URL
if (isset($_GET['id'])) {
    // Get appointment ID from the URL
    $appointmentId = $_GET['id'];

    // Fetch appointment details
    $appointment = $appointmentEditor->getAppointmentById($appointmentId);

    if (!$appointment) {
        // Redirect or display error if appointment not found
        echo "Appointment not found.";
        exit;
    }

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $appointment_date = $_POST['appointment_date'];
        $appointment_time = $_POST['appointment_time'];
        $appointment_type = $_POST['appointment_type'];
        $section = $_POST['section'];

        // Update appointment details
        $appointmentEditor->updateAppointment($appointmentId, $name, $email, $phone, $appointment_date, $appointment_time, $appointment_type, $section);
    }
} else {
    // Redirect or display error if appointment ID is not provided
    echo "Appointment ID is missing.";
    exit;
}
?>

<!-- HTML form for editing appointment details with CSS styles -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="time"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Appointment</h2>
    <form action="admin_edit_appointment.php?id=<?= $appointmentId ?>" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= $appointment['name'] ?>" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= $appointment['email'] ?>" required><br>
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="<?= $appointment['phone'] ?>" required><br>
        <label for="appointment_date">Appointment Date:</label>
        <input type="date" id="appointment_date" name="appointment_date" value="<?= $appointment['appointment_date'] ?>" required><br>
        <label for="appointment_time">Appointment Time:</label>
        <input type="time" id="appointment_time" name="appointment_time" value="<?= $appointment['appointment_time'] ?>" required><br>
        <label for="appointment_type">Appointment Type:</label>
        <input type="text" id="appointment_type" name="appointment_type" value="<?= $appointment['appointment_type'] ?>" required><br>
        <label for="section">Section:</label>
        <input type="text" id="section" name="section" value="<?= $appointment['section'] ?>" required><br>
        <input type="submit" value="Update Appointment">
    </form>
</div>
</body>
</html>
