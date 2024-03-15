<?php

// Include the necessary files
require_once 'Database.php';
require_once 'Appointment.php'; // Assuming you have an Appointment class defined

class EditAppointmentForm {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function displayForm($appointmentId) {
        // Fetch appointment details based on the ID
        $appointmentDetails = $this->db->getAppointmentDetails($appointmentId);

        // Check if the appointment details are found
        if($appointmentDetails) {
            $appointment = new Appointment($appointmentDetails);

            // Display the form to edit appointment details
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Edit Appointment</title>
                <link rel="stylesheet" href="CSS/style.css"> <!-- Include your CSS file here -->
            </head>
            <body>
                <div class="edit-appointment-form">
                    <h2>Edit Appointment</h2>
                    <form method="post" action="process_edit_appointment.php">
                        <input type="hidden" name="appointment_id" value="<?php echo $appointment->getId(); ?>">
                        
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="<?php echo $appointment->getName(); ?>" required><br><br>
                        
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo $appointment->getEmail(); ?>" required><br><br>
                        
                        <label for="phone">Phone:</label>
                        <input type="text" id="phone" name="phone" value="<?php echo $appointment->getPhone(); ?>" required><br><br>
                        
                        <label for="appointment_date">Appointment Date:</label>
                        <input type="date" id="appointment_date" name="appointment_date" value="<?php echo $appointment->getAppointmentDate(); ?>" required><br><br>
                        
                        <label for="appointment_time">Appointment Time:</label>
                        <input type="time" id="appointment_time" name="appointment_time" value="<?php echo $appointment->getAppointmentTime(); ?>" required><br><br>
                        
                        <label for="appointment_type">Appointment Type:</label>
                        <select id="appointment_type" name="appointment_type" required>
                            <option value="Type 1" <?php if($appointment->getAppointmentType() == 'Type 1') echo 'selected'; ?>>Type 1</option>
                            <option value="Type 2" <?php if($appointment->getAppointmentType() == 'Type 2') echo 'selected'; ?>>Type 2</option>
                            <!-- Add more options as needed -->
                        </select><br><br>
                        
                        <label for="section">Section:</label>
                        <input type="text" id="section" name="section" value="<?php echo $appointment->getSection(); ?>" required><br><br>
                        
                        <button type="submit">Update Appointment</button>
                    </form>
                </div>
            </body>
            </html>
            <?php
        } else {
            echo "Appointment details not found.";
        }
    }
}

// Check if appointment ID is provided in the URL
if(isset($_GET['id'])) {
    $appointmentId = $_GET['id'];
    
    $editAppointmentForm = new EditAppointmentForm();
    $editAppointmentForm->displayForm($appointmentId);
} else {
    echo "Appointment ID not provided.";
}

?>
