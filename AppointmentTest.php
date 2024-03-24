<?php

use PHPUnit\Framework\TestCase;

// Include the file containing the Appointment class
require_once 'payment_process.php';

class AppointmentTest extends TestCase
{
    // Test case to check if booking appointment succeeds
    public function testBookAppointmentSuccess()
    {
        // Mock the PDO object
        $pdoMock = $this->createMock(PDO::class);

        // Configure the PDO mock to expect a call to prepare() and return a statement mock
        $statementMock = $this->createMock(PDOStatement::class);
        $statementMock->expects($this->once())
            ->method('execute')
            ->willReturn(true);
        $pdoMock->expects($this->once())
            ->method('prepare')
            ->willReturn($statementMock);

        // Sample user ID and appointment data
        $userId = 1;
        $appointmentData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'appointment_date' => '2024-03-20',
            'appointment_time' => '09:00:00',
            'appointment_type' => 'Checkup',
            'section' => 'General'
        ];

        // Instantiate Appointment class with the mock PDO object
        $appointment = new Appointment($pdoMock);

        // Call bookAppointment method with sample data
        $result = $appointment->bookAppointment($userId, $appointmentData);

        // Assert that the result is true, indicating success
        $this->assertTrue($result);
    }
}

?>
