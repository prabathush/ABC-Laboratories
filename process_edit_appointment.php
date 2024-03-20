<?php
require_once 'Database.php'; // Include the database connection file
require_once 'edit_appointment.php';

class ProcessEditAppointment {
    private $db;
    
    public function __construct() {
        $this->db = new Database(); // Create an instance of the database class
    }
    
    public function process() {
        // Check if appointment ID is provided and form is submitted
        if(isset($_POST['appointment_id']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['appointment_date']) && isset($_POST['appointment_time']) && isset($_POST['appointment_type']) && isset($_POST['section'])) {
            $appointmentId = $_POST['appointment_id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $appointmentDate = $_POST['appointment_date'];
            $appointmentTime = $_POST['appointment_time'];
            $appointmentType = $_POST['appointment_type'];
            $section = $_POST['section'];
            
            // Update appointment details in the database
            $result = $this->db->updateAppointmentDetails($appointmentId, $name, $email, $phone, $appointmentDate, $appointmentTime, $appointmentType, $section);
            
            if($result) {
                // Redirect back to admin_dashboard.php after updating appointment details
                header("Location: admin_dashboard.php");
                exit();
            } else {
                echo "Failed to update appointment details.";
            }
        } else {
            echo "Invalid request.";
        }
    }
}

// Create an instance of the ProcessEditAppointment class and process the request
$processEditAppointment = new ProcessEditAppointment();
$processEditAppointment->process();
?>
