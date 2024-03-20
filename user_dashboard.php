<?php
session_start();

require_once 'db_connection.php';
class DashboardManager
{
    private $conn;

    public function __construct($servername, $username, $password, $dbname)
    {
        // Create connection
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die ("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function fetchUserProfile()
    {
        if (!isset ($_SESSION['user_id'])) {
            return null; // Return null if user is not logged in
        }

        $user_id = $_SESSION['user_id'];

        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); // Return user profile details
        } else {
            return null; // Return null if user profile not found
        }
    }

    public function fetchQuotations()
    {
        if (!isset ($_SESSION['user_id'])) {
            return null; // Return null if user is not logged in
        }

        $user_id = $_SESSION['user_id'];

        $sql = "SELECT * FROM quotations WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $quotations = [];
        while ($row = $result->fetch_assoc()) {
            $quotations[] = $row; // Add each quotation to the list
        }

        return $quotations;
    }

    public function closeConnection()
    {
        $this->conn->close();
    }
}

if (!isset ($_SESSION['user_id'])) {
    header("Location: userlogin.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "abc laboratories";

$dashboardManager = new DashboardManager($servername, $username, $password, $dbname);

$userProfile = $dashboardManager->fetchUserProfile();
$quotations = $dashboardManager->fetchQuotations();

$dashboardManager->closeConnection();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="dashboard_style.css">
    <link rel="stylesheet" href="prescription.css">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="viewprescriptions.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <style>

    </style>
</head>

<body>
    <div class="dashboard">

        <nav class="sidebar">
        <img src="logo.png" alt="Your Logo" style="width: 100%; max-width: 200px; margin-bottom: 20px;">
            
        <ul>
    <li><a href="#" onclick="showPatient()"><i class="fas fa-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;Profile</a></li>
    <li><a href="#" onclick="showAppointments()"><i class="fas fa-calendar-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;Appointments</a></li>
    <li><a href="#" onclick="showUploadPrescription()"><i class="fas fa-file-prescription"></i>&nbsp;&nbsp;&nbsp;&nbsp;Upload Prescription</a></li>
    <li><a href="#" onclick="showViewPrescriptions()"><i class="fas fa-file-medical"></i>&nbsp;&nbsp;&nbsp;&nbsp;View Prescriptions</a></li>
    <li><a href="#" onclick="showQuotations()"><i class="fas fa-file-invoice-dollar"></i>&nbsp;&nbsp;&nbsp;&nbsp;Quotations</a></li>
    <li><a href="#" onclick="showInquiries()"><i class="fas fa-comments"></i>&nbsp;&nbsp;&nbsp;&nbsp;Inquiries</a></li>
    <li><a href="#" onclick="showTestresults()"><i class="fas fa-vial"></i>&nbsp;&nbsp;&nbsp;&nbsp;Test results</a></li>
    <li><a href="#" onclick="showLogout()"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a></li>
</ul>

        </nav>

        <div class="main">
            <header>
                <h1>Welcome to Your Dashboard!</h1>
            </header>
            <div id="profileContent" class="content">
                <h2>Profile</h2>
                <hr>

                <?php
                // Include the database connection file
                require_once "db_connection.php";

                // Assume $pdo is the PDO object for database connection
                
                // Check if user is logged in and retrieve user details
                
                if (isset ($_SESSION["user_id"])) {
                    $userId = $_SESSION["user_id"];

                    // Prepare and execute query to fetch user details
                    $sql = "SELECT name, email, address, contact, dob FROM users WHERE id = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$userId]);
                    $userProfile = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Check if user profile exists
                    if ($userProfile) {
                        echo "<p>Name: {$userProfile['name']}</p>";
                        echo "<p>Email: {$userProfile['email']}</p>";
                        echo "<p>Address: {$userProfile['address']}</p>";
                        echo "<p>Contact: {$userProfile['contact']}</p>";
                        echo "<p>Date of Birth: {$userProfile['dob']}</p>";
                        echo '<a href="edit_profile.php"><button>Edit Profile</button></a>';
                    } else {
                        echo "User profile not found.";
                    }
                } else {
                    echo "User not logged in.";
                }
                ?>

            </div>


            <div id="appointmentsContent" class="content" style="display: none;" style="width: max-content;">
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

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Include the database connection file
                        require_once "db_connection.php";

                        // Check if the user is logged in and get the user ID from the session
                        
                        if (isset ($_SESSION["user_id"])) {
                            $userId = $_SESSION["user_id"];

                            // Prepare and execute the query to fetch appointments for the logged-in user
                            $sql = "SELECT * FROM appointments WHERE user_id = :user_id";
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
                            $stmt->execute();

                            // Fetch appointments and display them in the table
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>{$row['ID']}</td>";
                                echo "<td>{$row['name']}</td>";
                                echo "<td>{$row['email']}</td>";
                                echo "<td>{$row['phone']}</td>";
                                echo "<td>{$row['appointment_date']}</td>";
                                echo "<td>{$row['appointment_time']}</td>";
                                echo "<td>{$row['appointment_type']}</td>";
                                echo "<td>{$row['section']}</td>";

                                echo "<td><a href='user_edit_appointment.php?id={$row['ID']}' class='edit-btn'>Edit</a> <a href='delete_appointment.php?id={$row['ID']}' class='delete-btn'>Delete</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "User is not logged in.";
                        }
                        ?>
                    </tbody>
                </table>
                <br><br><br><br>
                <div class="container">
                    <h2>Book Appointment</h2>
                    <style>
                        .container {
                            max-width: 500px;
                            margin: 0 auto;
                            padding: 20px;
                            border: 1px solid #ccc;
                            border-radius: 5px;
                            background-color: #f9f9f9;
                        }

                        h2 {
                            text-align: center;
                            margin-bottom: 20px;
                        }

                        .form-group {
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
                            width: 100%;
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

                    <form action="process_create_appointment.php" method="post">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="date">Appointment Date:</label>
                            <input type="date" id="date" name="appointment_date" required>
                        </div>
                        <div class="form-group">
                            <label for="time">Appointment Time:</label>
                            <input type="time" id="time" name="appointment_time" required>
                        </div>
                        <div class="form-group">
                            <label for="type">Appointment Type:</label>
                            <select id="type" name="appointment_type" required>
                                <option value="">Select Type</option>
                                <option value="Regular">Regular</option>
                                <option value="Urgent">Urgent</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="section">Section:</label>
                            <input type="text" id="section" name="section" required>
                        </div>
                        <input type="submit" value="Book Appointment">
                    </form>
                </div>

            </div>


            <!-- HTML/JS for Upload Prescription Section -->
            <div id="uploadPrescriptionContent" class="content" style="display: none;">
                <h2>Upload Prescription</h2>
                <form action="upload_prescription.php" method="post" id="prescriptionForm"
                    enctype="multipart/form-data">
                    <div>
                        <label for="note">Note:</label>
                        <textarea id="note" name="note"></textarea>
                    </div>
                    <div>
                        <label for="deliveryAddress">Delivery Address:</label>
                        <input type="text" id="deliveryAddress" name="deliveryAddress">
                    </div><br>
                    <div>
                        <label for="deliveryTime">Delivery Time:</label>
                        <select id="deliveryTime" name="deliveryTime">
                            <option value="10:00 AM - 12:00 PM">10:00 AM - 12:00 PM</option>
                            <option value="12:00 PM - 2:00 PM">12:00 PM - 2:00 PM</option>
                            <option value="2:00 PM - 4:00 PM">2:00 PM - 4:00 PM</option>
                            <!-- Add more time slots as needed -->
                        </select>
                    </div><br>
                    <div>
                        <label for="images">Upload Images:</label>
                        <input type="file" id="images" name="images[]" accept="image/*" multiple>
                    </div><br>
                    <button type="submit">Upload</button>
                </form>
            </div>

            <div id="viewPrescriptionsContent" class="content" style="display: none;">
                <!-- View prescriptions content goes here -->
            </div>

            <div id="quotationsContent" class="content" style="display: none;">
                <div>
                    <h2>Quotation Details</h2>
                    <?php
                    if ($quotations) {
                        echo "<table>";
                        echo "<tr><th>ID</th><th>Drug</th><th>Quantity</th><th>Price</th><th>Action</th></tr>";
                        foreach ($quotations as $quotation) {
                            echo "<tr>";
                            echo "<td>{$quotation['id']}</td>";
                            echo "<td>{$quotation['drug']}</td>";
                            echo "<td>{$quotation['quantity']}</td>";
                            echo "<td>{$quotation['price']}</td>";
                            echo "<td>";
                            echo "<button class='accept-button' onclick='acceptQuotation({$quotation['id']})'>Accept</button>";
                            echo "<button class='reject-button' onclick='rejectQuotation({$quotation['id']})'>Reject</button>";
                            echo "<a href='quotationpdf_process.php?id={$quotation['id']}' class='invoice-button' style='background-color: darkblue; color: #fff; padding: 8px 16px; text-decoration: none; border-radius: 5px; display: inline-block;'>Invoice</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "No quotation details found.";
                    }
                    ?>

                </div>
            </div>

            <div id="inquiriesContent" class="content" style="display: none;">
                <h2>Inquiries</h2>
                <hr>
                <div class="container">
                    <h2>Submit Inquiry</h2>
                    <style>
                        .container {
                            max-width: 500px;
                            margin: 0 auto;
                            padding: 20px;
                            border: 1px solid #ccc;
                            border-radius: 5px;
                            background-color: #f9f9f9;
                        }

                        h2 {
                            text-align: center;
                            margin-bottom: 20px;
                        }

                        .form-group {
                            margin-bottom: 15px;
                        }

                        label {
                            display: block;
                            font-weight: bold;
                        }

                        input[type="text"],
                        input[type="email"],
                        textarea {
                            width: 100%;
                            padding: 10px;
                            border: 1px solid #ccc;
                            border-radius: 5px;
                            box-sizing: border-box;
                        }

                        textarea {
                            height: 150px;
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

<form action="process_inquiry.php" method="post">
    <div class="form-group">
        <label for="name"><i class="fas fa-user" style="color: #002852;"></i> Name:</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="email"><i class="fas fa-envelope" style="color: #002852;"></i> Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="subject"><i class="fas fa-heading" style="color: #002852;"></i> Subject:</label>
        <input type="text" id="subject" name="subject" required>
    </div>
    <div class="form-group">
        <label for="message"><i class="fas fa-comment" style="color: #002852;"></i> Message:</label>
        <textarea id="message" name="message" required></textarea>
    </div>
    <input type="submit" value="Submit Inquiry" style="background-color: #002852; color: #fff;">
</form>

                </div>
            </div>



            <div id="testresultsContent" class="content" style="display: none;">
                <h2>Test Results</h2>
                <table>
        <thead>
            <tr>
                <th>Test Name</th>
                <th>Test Date</th>
                <th>Result</th>
                <th>Remarks</th>
                <th>Technician's name</th>
                <th>doctor's name</th>

            </tr>
        </thead>
        <tbody id="testResultsTableBody">
            <!-- Test results will be dynamically added here -->
        </tbody>
    </table>
                
            </div>




        </div>
    </div>

    <script src="dashboard_script.js"></script>

    <script>
        function showUploadPrescription() {
            hideAllContent();
            document.getElementById("uploadPrescriptionContent").style.display = "block";
        }

        function showProfile() {
            hideAllContent();
            fetch('fetch_user_data.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(profile => {
                    const profileDetails = document.getElementById("profileDetails");
                    profileDetails.innerHTML = `
                        <p>Name         : ${profile.name}</p>
                        <p>Email        : ${profile.email}</p>
                        <p>Address      : ${profile.address}</p>
                        <p>Contact      : ${profile.contact}</p>
                        <p>Date of Birth: ${profile.dob}</p>
                        <!-- Add more profile fields here -->
                    `;
                    document.getElementById("profileContent").style.display = "block";
                })
                .catch(error => {
                    console.error('Error fetching profile details:', error);
                    alert('Error fetching profile details. Please try again later.');
                });
        }

        function acceptQuotation(quotationId) {
            document.getElementById(`acceptButton_${quotationId}`).disabled = true;
            updateQuotationStatus(quotationId, 'Accepted');
        }

        function rejectQuotation(quotationId) {
            document.getElementById(`rejectButton_${quotationId}`).disabled = true;
            updateQuotationStatus(quotationId, 'Rejected');
        }

        function updateQuotationStatus(quotationId, status) {
            var formData = new FormData();
            formData.append('quotationId', quotationId);
            formData.append('status', status);

            fetch('update_quotation_status.php', {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(message => {
                    console.log(message);
                    if (status === 'Accepted') {
                        document.getElementById(`acceptButton_${quotationId}`).innerHTML = 'Accepted';
                        document.getElementById(`rejectButton_${quotationId}`).innerHTML = 'Reject';
                        alert('Quotation accepted successfully.');
                    } else if (status === 'Rejected') {
                        document.getElementById(`rejectButton_${quotationId}`).innerHTML = 'Rejected';
                        document.getElementById(`acceptButton_${quotationId}`).innerHTML = 'Accept';
                        alert('Quotation rejected successfully.');
                    }
                })
                .catch(error => {
                    console.error('Error updating quotation status:', error);
                    alert('Error updating quotation status. Please try again later.');
                });
        }
    </script>
</body>

</html>