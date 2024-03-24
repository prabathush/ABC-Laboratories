-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2024 at 10:33 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abc laboratories`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `appointment_type` varchar(100) DEFAULT NULL,
  `section` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`ID`, `user_id`, `name`, `email`, `phone`, `appointment_date`, `appointment_time`, `appointment_type`, `section`, `created_at`) VALUES
(2, 2, 'abc', 'abc@gmail.com', '0746456156', '2025-03-26', '22:02:00', 'Regular', 'General Appointment Request', '2024-03-15 11:50:00'),
(3, 42, 'test', 'test@gmail.com', '0785559565', '2024-03-20', '02:05:00', 'Urgent', 'General Appointment Request', '2024-03-15 12:02:58'),
(7, 2, 'praba', 'praba@gmail.com', '0764512566', '2024-03-19', '10:20:00', 'Urgent', 'praba', '2024-03-15 17:14:33'),
(18, 35, 'Hrithick', 'Hrithick@gmail.com', '076452125', '2024-03-20', '06:06:00', 'Regular', 'Hrithick rosh', '2024-03-15 21:16:46'),
(22, 38, 'Thushanth', 'prabathushanth23@gmail.com', '0763845529', '2024-03-26', '02:14:12', 'Regular', 'Telemedicine Appointment Request', '2024-03-18 20:45:48'),
(23, 2, 'thushanth', 'praba@gmail.com', '076556656', '2002-12-23', '12:12:00', 'Regular', '211231', '2024-03-22 18:51:32'),
(24, 2, 'thushanth', 'praba@gmail.com', '076556656', '2002-12-23', '12:12:00', 'Regular', '211231', '2024-03-22 19:00:39');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `status` enum('Pending','Resolved') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`id`, `name`, `email`, `subject`, `message`, `status`) VALUES
(8, 'thush', 'prabathushanth23@gmail.com', 'thush', 'hello', 'Pending'),
(10, 'Thushanth', 'prabathushanth23@gmail.com', 'dount', 'test message', 'Pending'),
(18, 'Thushanth', 'prabathushanth23@gmail.com', 'Appointment Query', 'Next week', 'Pending'),
(19, 'Alice Smith', 'alice@example.com', 'Service Inquiry', 'Services offered', 'Pending'),
(20, 'Michael Johnson', 'michael@example.com', 'Visit Feedback', 'Positive experience', 'Resolved'),
(21, 'Emily Brown', 'emily@example.com', 'Technician Complaint', 'Unpleasant interaction', 'Pending'),
(22, 'David Wilson', 'david@example.com', 'Results Inquiry', 'Recent tests', 'Pending'),
(23, 'Sarah Jones', 'sarah@example.com', 'Appointment Cancellation', 'Unforeseen circumstances', 'Resolved'),
(24, 'Robert Miller', 'robert@example.com', 'Billing Query', 'Billing process', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `delivery_address` varchar(255) DEFAULT NULL,
  `delivery_time` varchar(50) DEFAULT NULL,
  `image_1` varchar(255) DEFAULT NULL,
  `image_2` varchar(255) DEFAULT NULL,
  `image_3` varchar(255) DEFAULT NULL,
  `image_4` varchar(255) DEFAULT NULL,
  `image_5` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `user_id`, `note`, `delivery_address`, `delivery_time`, `image_1`, `image_2`, `image_3`, `image_4`, `image_5`) VALUES
(23, 35, 'I\'m Thushanth\r\n', 'wattala', '10:00 AM - 12:00 PM', 'Screenshot 2024-03-16 013425.png', NULL, NULL, NULL, NULL),
(29, 2, 'test\r\n', 'test', '10:00 AM - 12:00 PM', 'Laboratories9.png', NULL, NULL, NULL, NULL),
(30, 38, 'Please note that I am allergic to penicillin. Kindly prescribe an alternative medication if necessary.', 'Wattala', '10:00 AM - 12:00 PM', 'Laboratories5.png', NULL, NULL, NULL, NULL),
(31, 38, 'I have been taking medication X for the past month for my condition. Please consider this when prescribing new medication.', 'Wattala', '10:00 AM - 12:00 PM', 'Laboratories.png', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `drug` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotations`
--

INSERT INTO `quotations` (`id`, `user_id`, `drug`, `quantity`, `price`, `created_at`, `status`) VALUES
(1, 3, 'Aspirin', 10, 500.00, '2024-03-08 19:58:36', 'Accepted'),
(2, 3, 'Amoxicillin', 5, 500.00, '2024-03-08 19:59:57', 'Accepted'),
(6, 3, 'Prednisone', 5, 500.00, '2024-03-08 20:20:42', 'Pending'),
(8, 3, 'Amoxicillin', 5, 500.00, '2024-03-08 20:48:09', 'Pending'),
(11, 3, 'Prednisone', 5, 500.00, '2024-03-08 21:31:08', 'Accepted'),
(12, 3, 'Aspirin', 5, 500.00, '2024-03-08 21:51:29', 'Pending'),
(13, 2, 'testing drug', 3, 300.00, '2024-03-08 21:59:55', 'Accepted'),
(14, 2, 'Amoxicillin', 5, 500.00, '2024-03-08 22:01:24', 'Accepted'),
(17, 2, 'Prednisone', 5, 500.00, '2024-03-09 18:52:48', 'Pending'),
(18, 3, 'Lisinopril', 5, 500.00, '2024-03-09 19:41:46', 'Pending'),
(24, 4, 'Amoxicillin', 10, 1000.00, '2024-03-09 20:53:40', 'Accepted'),
(25, 4, 'Aspirin', 10, 1000.00, '2024-03-09 20:56:34', 'Accepted'),
(30, 4, 'Lisinopril', 6, 600.00, '2024-03-09 22:06:08', 'Pending'),
(31, 4, 'Aspirin', 8, 800.00, '2024-03-09 22:08:37', 'Rejected'),
(34, 9, 'amxelin', 100, 50.00, '2024-03-09 23:49:35', 'Accepted'),
(35, 9, 'amxelin', 100, 500.00, '2024-03-09 23:50:05', 'Rejected'),
(38, 2, 'thush', 10, 200.00, '2024-03-16 14:22:00', 'Pending'),
(43, 38, 'Acetaminophen ', 10, 500.00, '2024-03-18 20:52:24', 'Pending'),
(44, 38, 'Amoxicillin ', 3, 500.00, '2024-03-18 20:52:54', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `technicians`
--

CREATE TABLE `technicians` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `qualification` varchar(100) DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `technicians`
--

INSERT INTO `technicians` (`id`, `name`, `email`, `phone`, `address`, `qualification`, `experience`, `specialization`, `password`) VALUES
(1, 'Tech 1', 'tech1@gmail.com', '123456781', 'Address 1', 'Tech Qualification', 5, 'General', '123'),
(5, 'Tech 5', 'tech5@gmail.com', '123456785', 'Address 5', 'Tech Qualification', 5, 'General', '123'),
(8, 'Tech 8', 'tech8@gmail.com', '123456788', 'Address 8', 'Tech Qualification', 5, 'General', '123'),
(10, 'Tech 10', 'tech10@gmail.com', '1234567810', 'Address 10', 'Tech Qualification', 5, 'General', '123'),
(12, 'Tech 12', 'tech12@gmail.com', '1234567812', 'Address 12', 'Tech Qualification', 5, 'General', '123'),
(13, 'Tech 13', 'tech13@gmail.com', '1234567813', 'Address 13', 'Tech Qualification', 4, 'General', '123'),
(14, 'hello', '123@gmail.com', '0761485663', 'jaffna', '5', 5, 'eye', '123'),
(16, 'tech', 'tech@gmail.com', '076452454', 'colombo', 'degree', 5, 'lab', '123'),
(17, 'Thushanth123', 'prabathushanth23@gmail.com', '0763845529', 'Colombo', 'Bsc (Hons) Nursing', 5, 'micro biology', ''),
(19, 'thushanth', 'naan@gmail.com', '0476548468', 'dadsa', 'dadTech Qualification', 0, 'General', '123'),
(21, 'thush', 'thushu@gmail.com', '0763845511', 'dewdewd', 'Tech Qualification', 56, 'General', '123');

-- --------------------------------------------------------

--
-- Table structure for table `test_details`
--

CREATE TABLE `test_details` (
  `id` int(11) NOT NULL,
  `test_name` varchar(255) NOT NULL,
  `test_type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `normal_range` varchar(255) NOT NULL,
  `sample_type` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `preparation_instructions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_details`
--

INSERT INTO `test_details` (`id`, `test_name`, `test_type`, `description`, `normal_range`, `sample_type`, `price`, `preparation_instructions`) VALUES
(54, 'Urinalysis', 'Medical', 'Analysis of urine sample', 'pH: 4.6-8.0, Specific Gravity: 1.005-1.030', 'Urine', 30.00, 'Collect a clean-catch midstream urine sample.'),
(56, 'ECG (Electrocardiogram)', 'Medical', 'Measurement of electrical activity of the heart', 'Normal sinus rhythm: 60-100 beats per minute', 'N/A', 80.00, 'No special preparation required.'),
(57, 'MRI (Magnetic Resonance Imaging)', 'Radiology', 'Detailed imaging of soft tissues and organs', 'Not applicable', 'N/A', 200.00, 'Remove all metallic objects before the test.'),
(58, 'Ultrasound', 'Radiology', 'Imaging using sound waves', 'Not applicable', 'N/A', 120.00, 'Drink plenty of water before the test.'),
(59, 'Stool Test', 'Medical', 'Analysis of stool sample', 'Not applicable', 'Stool', 40.00, 'Collect a fresh stool sample in a clean container.');

-- --------------------------------------------------------

--
-- Table structure for table `test_results`
--

CREATE TABLE `test_results` (
  `result_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `test_name` varchar(255) DEFAULT NULL,
  `technician_name` varchar(50) NOT NULL,
  `doctor_name` varchar(50) NOT NULL,
  `test_date` date DEFAULT NULL,
  `result` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_results`
--

INSERT INTO `test_results` (`result_id`, `user_id`, `test_name`, `technician_name`, `doctor_name`, `test_date`, `result`, `remarks`) VALUES
(1, 38, 'tech', 'Thanan', 'Dr. Praba', '2024-03-13', '120 mg/dL', 'Within normal range'),
(2, 38, 'Complete Blood Count (CBC)', 'Emily', 'Dr. Thanan', '2024-03-19', 'Hemoglobin: 13.5 g/dL', 'Normal CBC findings'),
(3, 38, 'Lipid Profile', 'Sarah', 'Dr. Johnson', '2024-03-12', 'Total Cholesterol: 180 mg/dL', 'Cholesterol levels within recommended range'),
(5, 38, 'Electrocardiogram (ECG)', 'Sharon', 'Dr. Tini', '2024-02-06', 'Normal sinus rhythm', 'No signs of arrhythmia or abnormalities'),
(6, 2, 'X-ray - Chest', 'Samantha', 'Dr. Nguyen', '3333-02-22', 'Normal findings', 'Evidence of abnormalities in the chest area'),
(7, 2, 'Thyroid Function Test (TFT)', 'Dhoni', 'Dr. Martinez', '4555-04-05', 'TSH: 2.5 mIU/L', 'Thyroid hormone levels within normal range');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `address`, `contact`, `dob`, `password`) VALUES
(2, 'test', 'test@gmail.com', 'colombo 6', '0771234567', '1999-05-01', '$2y$10$4aVVqtsSBUez0JMo7lIxMuV7pVLNKd49tI5rfaqr//JzMr8zYOMk2'),
(3, 'Thanan', 'thanan@gmail.com', 'Jaffna', '0763845529', '2002-12-23', '$2y$10$iaoxHdir1K1mMVztTM/nXuNGuy5MbxR8nd6xFRKlQ8p1EAPL674E6'),
(5, 'Test', 'Test123@gmail.com', 'Test', '07611111111', '2002-12-23', '$2y$10$Sksjpd60KQOVcyRS4sx2Eux1y1yWPEtm5XSsx4HX2ibCy.mhK/1cG'),
(34, 'hello', 'thanan1223@gmail.com', 'hello', '0754512126', '2024-03-12', '$2y$10$uXxoj1iJxKtJYh.7pE5bC.ZUT1lLESt2neNLK90VXtDsKio4wh/Lu'),
(35, 'Thanan', 'prabathana@gmail.com', 'jaffna', '076555555', '1994-12-12', '$2y$10$rwKE6tO4lAkjlGHMTuICxuv3n6KOTYaIPLkKv2sL5yWE3mdVydK36'),
(36, 'darrr', 'tharmila9746@gmail.com', 'mullaitivu', '0763545215', '2024-03-20', '$2y$10$esMLlUYa.0wcLSPTXeuNIOeb4B14rHn9zXZYVX0ihVVx3.X5CWmhW'),
(37, 'Arjun', 'arujunabk@gmail.com', 'Jaffna', '0771234567', '1996-12-23', '$2y$10$PaVHDDrjIPDPhUdac.fG9./ulZg4A9ZjeX262eVXz8Pn8SWln1zIy'),
(38, 'Thushanth', 'prabathushanth123@gmail.com', 'Wattala', '0763845529', '2002-12-23', '$2y$10$6xUTrBJSvaH833CNhZu8JezTEfBqPa4mas0CAS/mILYnXk4z/TnpS'),
(42, 'Thushanth', 'prabathushanth23@gmail.com', 'colombo', '0763845529', '2002-12-23', '$2y$10$zqjVtArhpImHVihBFDYKB.NSqe9KYsiwkGGuxrugnM..IyCVLyl0.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `technicians`
--
ALTER TABLE `technicians`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `test_details`
--
ALTER TABLE `test_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_results`
--
ALTER TABLE `test_results`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `technicians`
--
ALTER TABLE `technicians`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `test_details`
--
ALTER TABLE `test_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `test_results`
--
ALTER TABLE `test_results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
