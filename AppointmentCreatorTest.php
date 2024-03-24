<?php

use PHPUnit\Framework\TestCase;

require_once 'admin_create_appointment.php'; // Include the class you want to test

class AppointmentCreatorTest extends TestCase
{
    // Test case to check if appointment creation succeeds
    public function testCreateAppointmentSuccess()
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

        // Instantiate AppointmentCreator with the mock PDO object
        $appointmentCreator = new AppointmentCreator($pdoMock);

        // Call createAppointment method with sample data
        $result = $appointmentCreator->createAppointment(
            'John Doe',
            'john@example.com',
            '1234567890',
            '2024-03-20',
            '09:00:00',
            'Checkup',
            'General',
            '2024-03-19 12:00:00'
        );

        // Assert that the result is true, indicating success
        $this->assertTrue($result);
    }
}
