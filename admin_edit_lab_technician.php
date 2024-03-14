<?php

class TechnicianEditor {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getTechnicianById($technicianId) {
        $sql = "SELECT * FROM technicians WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$technicianId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateTechnician($technicianId, $name, $email, $phone, $address, $qualification, $experience, $specialization) {
        $sql = "UPDATE technicians SET name = ?, email = ?, phone = ?, address = ?, qualification = ?, experience = ?, specialization = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name, $email, $phone, $address, $qualification, $experience, $specialization, $technicianId]);
    }
}

// Include database connection or any necessary files
require_once "db_connection.php";

// Check if technician ID is provided in the URL
if (isset($_GET['id'])) {
    $technicianId = $_GET['id'];

    // Instantiate TechnicianEditor object
    $technicianEditor = new TechnicianEditor($pdo);

    // Fetch technician details from the database based on the ID
    $technician = $technicianEditor->getTechnicianById($technicianId);

    if (!$technician) {
        // Redirect or display error if technician not found
        echo "Technician not found.";
        exit;
    }
} else {
    // Redirect or display error if technician ID is not provided
    echo "Technician ID is missing.";
    exit;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form submission and update technician details in the database
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $qualification = $_POST['qualification'];
    $experience = $_POST['experience'];
    $specialization = $_POST['specialization'];

    // Call updateTechnician method
    $success = $technicianEditor->updateTechnician($technicianId, $name, $email, $phone, $address, $qualification, $experience, $specialization);

    if ($success) {
        // Redirect to technician details page after successful update
        header("Location: admin_dashboard.php");
        exit;
    } else {
        echo "Failed to update technician.";
    }
}

?>

<!-- HTML form for editing technician details -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lab Technician</title>
<style>
    body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
</style>

</head>
<body>
    
    <div class="container">
        <h2>Edit Lab Technician</h2>
        <form action="admin_edit_lab_technician.php?id=<?= $technicianId ?>" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?= $technician['name'] ?? '' ?>" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= $technician['email'] ?? '' ?>" required><br>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?= $technician['phone'] ?? '' ?>" required><br>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?= $technician['address'] ?? '' ?>" required><br>
            <label for="qualification">Qualification:</label>
            <input type="text" id="qualification" name="qualification" value="<?= $technician['qualification'] ?? '' ?>" required><br>
            <label for="experience">Experience:</label>
            <input type="text" id="experience" name="experience" value="<?= $technician['experience'] ?? '' ?>" required><br>
            <label for="specialization">Specialization:</label>
            <input type="text" id="specialization" name="specialization" value="<?= $technician['specialization'] ?? '' ?>" required><br>
            <input type="submit" value="Update Technician">
        </form>
    </div>
</body>
</html>
