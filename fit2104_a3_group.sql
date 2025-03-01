-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 30, 2024 at 02:33 AM
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
-- Database: `fit2104_a3_group`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `contact_id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `message` text NOT NULL,
  `replied` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contractor`
--

CREATE TABLE `contractor` (
  `contractor_id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `specialty` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` varchar(200) NOT NULL,
  `profile_picture` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contractor`
--

INSERT INTO `contractor` (`contractor_id`, `firstName`, `lastName`, `specialty`, `email`, `phone`, `address`, `profile_picture`) VALUES
(1, 'Adam', 'Tran', 'Plumber', 'adam.tran@example.com', '0412345678', '123 Main St', NULL),
(2, 'Eve', 'Johnson', 'Electrician', 'eve.johnson@example.com', '0412345679', '456 Oak St', NULL),
(3, 'Michael', 'Smith', 'Carpenter', 'michael.smith@example.com', '0412345680', '789 Pine St', NULL),
(4, 'Sarah', 'Brown', 'Painter', 'sarah.brown@example.com', '0412345681', '101 Maple St', NULL),
(5, 'David', 'Taylor', 'Tiler', 'david.taylor@example.com', '0412345682', '202 Elm St', NULL),
(6, 'Samantha', 'Hall', 'Mason', 'samantha.hall@example.com', '0412345705', '2626 Juniper St', NULL),
(7, 'Joseph', 'Young', 'Welder', 'joseph.young@example.com', '0412345706', '2727 Pinecone St', NULL),
(8, 'Ella', 'Allen', 'Plasterer', 'ella.allen@example.com', '0412345707', '2828 Aspenwood St', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `organisation`
--

CREATE TABLE `organisation` (
  `organisation_id` int(11) NOT NULL,
  `business_name` varchar(50) NOT NULL,
  `business_website` varchar(50) DEFAULT NULL,
  `business_description` varchar(500) NOT NULL,
  `industry` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organisation`
--

INSERT INTO `organisation` (`organisation_id`, `business_name`, `business_website`, `business_description`, `industry`) VALUES
(1, 'Tech Innovators Inc.', 'www.techinnovators.com', 'Leading tech solutions provider specializing in software and hardware integration.', 'Technology'),
(2, 'Green Earth Construction', 'www.greenearth.com', 'Sustainable construction company focusing on eco-friendly building practices.', 'Construction'),
(3, 'HealthCare Solutions', 'www.healthcaresolutions.com', 'Providing advanced healthcare solutions and medical equipment.', 'Healthcare'),
(4, 'Creative Designs Studio', 'www.creativedesigns.com', 'Design studio offering graphic design, branding, and marketing services.', 'Design'),
(5, 'Foodies Delight', 'www.foodiesdelight.com', 'Restaurant and catering services with a focus on gourmet cuisine.', 'Hospitality');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_description` varchar(500) NOT NULL,
  `technique_required` varchar(100) DEFAULT NULL,
  `due_date` date NOT NULL,
  `project_link` varchar(255) DEFAULT NULL,
  `organisation_id` int(11) DEFAULT NULL,
  `contractor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_name`, `project_description`, `technique_required`, `due_date`, `project_link`, `organisation_id`, `contractor_id`) VALUES
(5, 'Office Renovation', 'Complete renovation of office space including plumbing, electrical work, and interior design.', 'Plumbing, Electrical, Carpentry', '2024-12-15', 'www.officeproject.com', 1, 3),
(6, 'New Website Development', 'Design and development of a responsive website for an e-commerce platform.', 'Web Development, UX/UI Design', '2024-11-01', 'www.newwebsitedev.com', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `firstName`, `lastName`) VALUES
(1, 'john.doe@example.com', 'f55d184f3df1b47eca0d5390baf23ba2299bc626bf27209b6fb534faf8af258b', 'John', 'Doe'),
(2, 'jane.smith@example.com', 'bcb485d98f5d0fc5276b6defefafc3e7c29c469af7cc7641472de3b99baf8b3d', 'Jane', 'Smith'),
(3, 'alice.jones@example.com', '6966e09d488a156d41f8d0e673e35d974e90d1e8d286ee5529d5c21bca541703', 'Alice', 'Jones'),
(4, 'bob.brown@example.com', 'e1bece8bb6cc24bfed34337575177d28e66724cf27205e90e3ef17073ca1b744', 'Bob', 'Brown'),
(5, 'nathan.recruiter@example.com', 'd2a9810a11445491c901909d32e7a8e13f6f59175ef7aac58800788c01346bf6', 'Nathan', 'Jims'),
(6, 'lebron.james@example.com', '51c8914876ac67c6b71f020b36f39516c768e16fce43976e68217e3b8fe46c79', 'Lebron', 'James');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `contractor`
--
ALTER TABLE `contractor`
  ADD PRIMARY KEY (`contractor_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `organisation`
--
ALTER TABLE `organisation`
  ADD PRIMARY KEY (`organisation_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`),
  ADD UNIQUE KEY `contractor_id` (`contractor_id`),
  ADD KEY `organisation_id` (`organisation_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contractor`
--
ALTER TABLE `contractor`
  MODIFY `contractor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `organisation`
--
ALTER TABLE `organisation`
  MODIFY `organisation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`organisation_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `project_ibfk_2` FOREIGN KEY (`contractor_id`) REFERENCES `contractor` (`contractor_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
