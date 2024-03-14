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
                        <li><a href="#" onclick="registerLabTechnician()"> Lab Technician</a></li>
                        <li><a href="#" onclick="addTestDetails()">Add Test Details</a></li>
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

                    <div id="inquiriesContent"  class="content" style="display: none; " >
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
                                        <td><?= $inquiry['id'] ?></td>
                                        <td><?= $inquiry['name'] ?></td>
                                        <td><?= $inquiry['email'] ?></td>
                                        <td><?= $inquiry['subject'] ?></td>
                                        <td><?= $inquiry['message'] ?></td>
                                        <td><?= $inquiry['status'] ?></td>
                                        <td>
                                            <a href="admin_respond.php?id=<?= $inquiry['id'] ?>" class="respond-btn">Respond</a>
                                            <a href="admin_delete_inquiry.php?id=<?= $inquiry['id'] ?>" class="delete-btn">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>



                    <div id="appointmentsContent" class="content" style="display: none;">
        <h2>Manage Appointments</h2>
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment): ?>
                    <tr>
                        <td><?= $appointment['id'] ?></td>
                        <td><?= $appointment['name'] ?></td>
                        <td><?= $appointment['email'] ?></td>
                        <td><?= $appointment['phone'] ?></td>
                        <td><?= $appointment['appointment_date'] ?></td>
                        <td><?= $appointment['appointment_time'] ?></td>
                        <td><?= $appointment['appointment_type'] ?></td>
                        <td><?= $appointment['section'] ?></td>
                        <td>
                            <a href="edit_appointment.php?id=<?= $appointment['id'] ?>" class="edit-btn">Edit</a>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <input type="hidden" name="delete_appointment_id" value="<?= $appointment['id'] ?>">
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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
