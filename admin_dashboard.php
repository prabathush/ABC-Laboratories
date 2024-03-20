<?php

require_once 'AdminDashboard.php';
require_once 'Testdetails.php';
require_once 'Database.php';
require_once 'update_test_detail.php';

// Instantiate AdminDashboard class and call render method
$adminDashboard = new AdminDashboard();
$adminDashboard->render();


?>
