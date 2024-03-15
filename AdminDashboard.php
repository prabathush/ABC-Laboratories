<?php

require_once 'TestDetails.php';
require_once 'Database.php';
require_once 'delete_test_detail.php';
require_once 'update_test_detail.php';

class AdminDashboard
{


    private $testDetailsObj;
    private $db; // Define the $db property
    public function __construct()
    {
        $this->testDetailsObj = new TestDetails();

        $this->db = new Database(); // Initialize the $db property
    }

    public function render()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Check if a delete request is made
            if (isset($_POST['delete_id'])) {
                $this->testDetailsObj->deleteTestDetail($_POST['delete_id']);
            }
            // Handle form submission
            $this->handleFormSubmission();
        }

        if (isset($_GET['action']) && $_GET['action'] === 'addTestDetails') {
            // Display the creation form for adding test details
            $this->renderAddTestDetailsForm();
        }

        $inquiries = $this->fetchInquiries();
        $appointments = $this->fetchAppointmentsFromDatabase();

        // Render the HTML content
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin Dashboard</title>
            <link rel="stylesheet" href="CSS/dashboard.css">
            <style>
                .create-form {
                    max-width: 800px;
                    margin: 0 auto;
                    background-color: #f9f9f9;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                }

                .form-row {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 20px;
                }

                .form-group {
                    flex: 0 0 48%;
                }

                .label-left {
                    text-align: left;
                }

                .label-right {
                    text-align: right;
                }

                .input-left {
                    text-align: left;
                }

                .input-right {
                    text-align: right;
                }

                .label-right,
                .input-right {
                    order: 2;
                }

                label {
                    font-weight: bold;
                    color: #333;
                }

                input[type="text"],
                input[type="number"],
                textarea {
                    width: 100%;
                    padding: 10px;
                    font-size: 16px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    box-sizing: border-box;
                    transition: border-color 0.3s;
                }

                input[type="text"]:focus,
                input[type="number"]:focus,
                textarea:focus {
                    border-color: #007bff;
                }

                textarea {
                    height: 100px;
                }

                .submit-btn {
                    width: 100%;
                    padding: 12px;
                    background-color: #007bff;
                    color: #fff;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    font-size: 16px;
                    transition: background-color 0.3s;
                }

                .submit-btn:hover {
                    background-color: #0056b3;
                }
            </style>
        </head>

        <body>
            <div class="dashboard">
                <nav class="sidebar">
                    <h2>Admin Dashboard</h2>
                    <hr>
                    <ul>
                        <li><a href="#" onclick="manageTestDetails()"> Test Details</a></li>
                        <li><a href="#" onclick="manageInquiries()"> Inquiries</a></li>
                        <li><a href="#" onclick="manageLabTechnicians()"> Lab Technicians</a></li>
                        <li><a href="#" onclick="manageAppointments()"> Appointments</a></li>
                        <li><a href="#" onclick="manageTestResults()"> Test Results</a></li>
                        <li><a href="#" onclick="managePatients()"> Patients</a></li>
                        
                        <li><a href="#" onclick="viewAnalytics()">Analytics</a></li>
                    </ul>
                </nav>
                <div class="main">
                    <header>
                        <h1>Welcome to Admin Dashboard</h1>
                    </header>
                    <div id="testDetailsContent" class="content">
                        <h2>Manage Test details</h2>
                        <!-- Test details table -->
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Test Name</th>
                                    <th>Test Type</th>
                                    <th>Description</th>
                                    <th>Normal Range</th>
                                    <th>Sample Type</th>
                                    <th>Price</th>
                                    <th>Preparation Instructions</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($this->testDetailsObj->getTestDetails() as $detail): ?>
                                    <tr>
                                        <td>
                                            <?= $detail["id"] ?>
                                        </td>
                                        <td>
                                            <?= $detail["test_name"] ?>
                                        </td>
                                        <td>
                                            <?= $detail["test_type"] ?>
                                        </td>
                                        <td>
                                            <?= $detail["description"] ?>
                                        </td>
                                        <td>
                                            <?= $detail["normal_range"] ?>
                                        </td>
                                        <td>
                                            <?= $detail["sample_type"] ?>
                                        </td>
                                        <td>
                                            <?= $detail["price"] ?>
                                        </td>
                                        <td>
                                            <?= $detail["preparation_instructions"] ?>
                                        </td>
                                        <td>
                                            <a href="editform.php?id=<?= $detail['id'] ?>" class="edit-btn">Edit</a>
                                            <button class="delete-btn" data-id="<?= $detail["id"] ?>">Delete</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <!-- Add Test Detail form -->
                        <h2>Add Test Detail</h2>
                        <form class="create-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="test_name">Test Name:</label>
                                    <input type="text" id="test_name" name="test_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="test_type">Test Type:</label>
                                    <input type="text" id="test_type" name="test_type" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea id="description" name="description" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="preparation_instructions">Preparation Instructions:</label>
                                    <textarea id="preparation_instructions" name="preparation_instructions" required></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="sample_type">Sample Type:</label>
                                    <input type="text" id="sample_type" name="sample_type" required>
                                </div>
                                <div class="form-group">
                                    <label for="normal_range">Normal Range:</label>
                                    <input type="text" id="normal_range" name="normal_range" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="price">Price:</label>
                                    <input type="number" id="price" name="price" required>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="submit-btn">Submit</button>
                        </form>
                    </div>

                    <div id="inquiriesContent" class="content" style="display: none; ">
                        <h2>Manage Inquiries</h2>
                        <!-- Inquiry table goes here -->
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($inquiries as $inquiry): ?>
                                    <tr>
                                        <td>
                                            <?= $inquiry['id'] ?>
                                        </td>
                                        <td>
                                            <?= $inquiry['name'] ?>
                                        </td>
                                        <td>
                                            <?= $inquiry['email'] ?>
                                        </td>
                                        <td>
                                            <?= $inquiry['subject'] ?>
                                        </td>
                                        <td>
                                            <?= $inquiry['message'] ?>
                                        </td>
                                        <td>
                                            <?= $inquiry['status'] ?>
                                        </td>
                                        <td>
                                            <a href="admin_respond.php?id=<?= $inquiry['id'] ?>" class="respond-btn">Respond</a>
                                            <a href="admin_delete_inquiry.php?id=<?= $inquiry['id'] ?>"
                                                class="delete-btn">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>



                    <div class="content" id="appointmentsContent" style="display: none;">
    <h2>Appointments</h2>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Appointment Type</th>
                <th>Section</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $host = "localhost";
            $dbname = "abc laboratories";
            $username = "root";
            $password = ""; // Replace with your actual database password

            try {
                // Establish a database connection
                $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
                // Set PDO error mode to exception
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // Display error message if connection fails
                die("Connection failed: " . $e->getMessage());
            }

            $sql = "SELECT * FROM appointments";
            $result = $pdo->query($sql);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>{$row['ID']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['phone']}</td>";
                echo "<td>{$row['appointment_date']}</td>";
                echo "<td>{$row['appointment_time']}</td>";
                echo "<td>{$row['appointment_type']}</td>";
                echo "<td>{$row['section']}</td>";
                echo "<td>{$row['created_at']}</td>";
                echo "<td><a href='admin_edit_appointment.php?id={$row['ID']}' class='edit-btn'>Edit</a> <a href='admin_delete_appointment.php?id={$row['ID']}' class='delete-btn'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="container">
        <h2>Create Appointment</h2>
        <form action="admin_create_appointment.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required><br><br>
            <label for="appointment_date">Appointment Date:</label>
            <input type="date" id="appointment_date" name="appointment_date" required><br><br>
            <label for="appointment_time">Appointment Time:</label>
            <input type="time" id="appointment_time" name="appointment_time" required><br><br>
            <label for="appointment_type">Appointment Type:</label>
            <input type="text" id="appointment_type" name="appointment_type" required><br><br>
            <label for="section">Section:</label>
            <input type="text" id="section" name="section" required><br><br>
            <input type="submit" value="Create Appointment">
        </form>
    </div>
</div>



                    <div id="patientsContent" class="content" style="display: none;">
                        <h2>User Details</h2>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                background-color: #f4f4f4;
                                margin: 0;
                                padding: 0;
                            }

                            .container {
                                max-width: 600px;
                                margin: 50px auto;
                                background-color: #fff;
                                padding: 20px;
                                border-radius: 8px;
                                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                            }

                            h2 {
                                text-align: center;
                                color: #333;
                            }

                            .form-row {
                                display: flex;
                                justify-content: space-between;
                                margin-bottom: 20px;
                            }

                            .form-row .form-group {
                                flex-basis: calc(33.33% - 10px);
                            }

                            .form-group {
                                margin-bottom: 15px;
                            }

                            label {
                                display: block;
                                font-weight: bold;
                                margin-bottom: 5px;
                            }

                            input[type="text"],
                            input[type="email"],
                            input[type="date"],
                            input[type="password"] {
                                width: 100%;
                                padding: 10px;
                                border: 1px solid #ccc;
                                border-radius: 4px;
                                box-sizing: border-box;
                            }

                            input[type="submit"] {
                                background-color: #4CAF50;
                                color: white;
                                padding: 12px 20px;
                                border: none;
                                border-radius: 4px;
                                cursor: pointer;
                                width: 100%;
                            }

                            input[type="submit"]:hover {
                                background-color: #45a049;
                            }
                        </style>
                        <div class="user-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Contact</th>
                                        <th>DOB</th>
                                        <th>Password</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $host = "localhost";
                                    $dbname = "abc laboratories";
                                    $username = "root";
                                    $password = ""; // Please replace this with your actual database password
                            
                                    try {
                                        // Establish a database connection
                                        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
                                        // Set PDO error mode to exception
                                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    } catch (PDOException $e) {
                                        // Display error message if connection fails
                                        die("Connection failed: " . $e->getMessage());
                                    }

                                    $sql = "SELECT * FROM users";
                                    $result = $pdo->query($sql);
                                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<tr>";
                                        echo "<td>{$row['id']}</td>";
                                        echo "<td>{$row['name']}</td>";
                                        echo "<td>{$row['email']}</td>";
                                        echo "<td>{$row['address']}</td>";
                                        echo "<td>{$row['contact']}</td>";
                                        echo "<td>{$row['dob']}</td>";
                                        echo "<td style='max-width: 150px; overflow: hidden; text-overflow: ellipsis;' title='{$row['password']}'>{$row['password']}</td>";

                                        echo "<td><a href='edituser.php?id={$row['id']}' class='edit-btn'>Edit</a> <a href='admin_deleteuser.php?id={$row['id']}' class='delete-btn'>Delete</a></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="container">
                            <h2>Create User</h2>
                            <form action="admin_createuser.php" method="post">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" id="name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" id="email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address:</label>
                                        <input type="text" id="address" name="address" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="contact">Contact:</label>
                                        <input type="text" id="contact" name="contact" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="dob">Date of Birth:</label>
                                        <input type="date" id="dob" name="dob" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input type="password" id="password" name="password" required>
                                    </div>
                                </div>
                                <input type="submit" value="Create User">
                            </form>
                        </div>
                    </div>

                    <div class="content" id="labTechniciansContent"  style="display: none;">
                        <h2>Technicians</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Qualification</th>
                                    <th>Experience</th>
                                    <th>Specialization</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
            $host = "localhost";
            $dbname = "abc laboratories";
            $username = "root";
            $password = ""; // Replace with your actual database password

            try {
                // Establish a database connection
                $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
                // Set PDO error mode to exception
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // Display error message if connection fails
                die("Connection failed: " . $e->getMessage());
            }

            $sql = "SELECT * FROM technicians";
            $result = $pdo->query($sql);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['address']}</td>";
                echo "<td>{$row['phone']}</td>";
                echo "<td>{$row['qualification']}</td>";
                echo "<td>{$row['experience']}</td>";
                echo "<td>{$row['specialization']}</td>";
                echo "<td><a href='admin_edit_lab_technician.php?id={$row['id']}' class='edit-btn'>Edit</a> <a href='admin_delete_lab_technician.php?id={$row['id']}' class='delete-btn'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
                            </tbody>
                        </table>


                        <div class="container">
                            <h2>Create Technician</h2>
                            <form action="admin_create_technician.php" method="post">
                                <label for="name">Name:</label>
                                <input type="text" id="name" name="name" required><br><br>
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" required><br><br>
                                <label for="phone">Phone:</label>
                                <input type="text" id="phone" name="phone" required><br><br>
                                <label for="address">Address:</label>
                                <input type="text" id="address" name="address" required><br><br>
                                <label for="qualification">Qualification:</label>
                                <input type="text" id="qualification" name="qualification" required><br><br>
                                <label for="experience">Experience:</label>
                                <input type="text" id="experience" name="experience" required><br><br>
                                <label for="specialization">Specialization:</label>
                                <input type="text" id="specialization" name="specialization" required><br><br>
                                <input type="submit" value="Create Technician">
                            </form>
                        </div>

                    </div>




                </div>

            </div>


            <script src="admin_dashboard.js"></script>




        </body>

        </html>
        <?php


    }

    private function handleFormSubmission()
    {
        // Collect form data
        $testName = $_POST['test_name'] ?? '';
        $testType = $_POST['test_type'] ?? '';
        $description = $_POST['description'] ?? '';
        $normalRange = $_POST['normal_range'] ?? '';
        $sampleType = $_POST['sample_type'] ?? '';
        $price = $_POST['price'] ?? '';
        $preparationInstructions = $_POST['preparation_instructions'] ?? '';

        // Add test detail
        $result = $this->testDetailsObj->addTestDetail($testName, $testType, $description, $normalRange, $sampleType, $price, $preparationInstructions);

        // Display success or error message based on result
        if ($result) {
            echo "<script>alert('Test detail added successfully.'); window.location.href = 'admin_dashboard.php';</script>";
        } else {
            echo "<script>alert('Failed to add test detail.'); window.location.href = 'admin_dashboard.php';</script>";
        }


    }

    // Method to delete appointment from the database
    private function deleteAppointment($appointmentId)
    {
        // Connect to the database (assuming $db is your database connection)
        $db = new Database();

        // Prepare the SQL statement
        $sql = "DELETE FROM appointments WHERE id = :appointment_id";

        // Prepare the query
        $stmt = $db->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':appointment_id', $appointmentId, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            // Appointment deleted successfully
            echo "<script>alert('Appointment deleted successfully.'); window.location.href = 'admin_dashboard.php';</script>";
        } else {
            // Failed to delete appointment
            echo "<script>alert('Failed to delete appointment.'); window.location.href = 'admin_dashboard.php';</script>";
        }


    }

    private function fetchInquiries()
    {
        // Fetch inquiries from the database
        $sql = "SELECT * FROM inquiries";
        return $this->db->query($sql);
    }

    private function fetchAppointmentsFromDatabase()
    {
        // Fetch inquiries from the database
        $sql = "SELECT * FROM appointments";
        return $this->db->query($sql);
    }







}
