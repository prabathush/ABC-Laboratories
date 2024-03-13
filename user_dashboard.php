<?php
session_start();

class DashboardManager {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        // Create connection
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function fetchUserProfile() {
        if (!isset($_SESSION['user_id'])) {
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

    public function fetchQuotations() {
        if (!isset($_SESSION['user_id'])) {
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

    public function closeConnection() {
        $this->conn->close();
    }
}

if (!isset($_SESSION['user_id'])) {
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

    <style>
        
    </style>
</head>
<body>
    <div class="dashboard">

        <nav class="sidebar">
            <h2>User Dashboard</h2>
            <ul>
                <li><a href="#" onclick="showProfile()">Profile</a></li>
                <li><a href="#" onclick="showUploadPrescription()">Upload Prescription</a></li>
                <li><a href="#" onclick="showViewPrescriptions()">View Prescriptions</a></li>
                <li><a href="#" onclick="showQuotations()">Quotations</a></li>
                <li><a href="#" onclick="showLogout()">Logout</a></li>
            </ul>
        </nav>
       
        <div class="main">
            <header>
                <h1>Welcome to Your Dashboard</h1>
            </header>
            <div id="profileContent" class="content" style="display: none;">
                <h2>Profile</h2><hr>
                <div id="profileDetails">
                    <?php
                    if ($userProfile) {
                        echo "<p>Name         : {$userProfile['name']}</p>";
                        echo "<p>Email        : {$userProfile['email']}</p>";
                        echo "<p>Address      : {$userProfile['address']}</p>";
                        echo "<p>Contact      : {$userProfile['contact']}</p>";
                        echo "<p>Date of Birth: {$userProfile['dob']}</p>";
                    } else {
                        echo "User profile not found.";
                    }
                    ?>
                </div> <br>
                <button onclick="editProfile()">Edit Profile</button>
            </div>

            <!-- HTML/JS for Upload Prescription Section -->
            <div id="uploadPrescriptionContent" class="content">
                <h2>Upload Prescription</h2>
                <form action="upload_prescription.php" method="post" id="prescriptionForm" enctype="multipart/form-data">
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
