-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 11:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood_donation`
--

CREATE DATABASE blood_donation;
USE blood_donation;


-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_id` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `NIC` varchar(20) NOT NULL,
  `DOB` varchar(20) NOT NULL,
  `Gender` varchar(20) NOT NULL,
  `Phone_no` int(10) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Passkey` varchar(20) NOT NULL,
  `A_Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_id`, `Username`, `NIC`, `DOB`, `Gender`, `Phone_no`, `Email`, `Passkey`, `A_Password`) VALUES
(1, 'admin1', '123456789V', '1990/05/20', 'MALE', 1234567890, 'admin1@example.com', 'pass123', 'hashed_password1'),
(2, 'admin2', '987654321V', '1985/12/15', 'FEMALE', 2147483647, 'admin2@example.com', 'pass456', 'hashed_password2'),
(3, 'admin3', '456789123V', '1978/08/25', 'MALE', 2147483647, 'admin3@example.com', 'pass789', 'hashed_password3'),
(4, 'admin4', '789123456V', '1995/03/10', 'FEMALE', 1234567890, 'admin4@example.com', 'passabc', 'hashed_password4'),
(5, 'admin5', '654321987V', '1982/11/30', 'MALE', 2147483647, 'admin5@example.com', 'passxyz', 'hashed_password5');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `Appointment_id` int(11) NOT NULL,
  `A_Donor_id` int(11) DEFAULT NULL,
  `A_Guest_id` int(11) DEFAULT NULL,
  `A_Date` varchar(20) NOT NULL,
  `A_Time` varchar(20) NOT NULL,
  `A_Meridiem` varchar(2) NOT NULL,
  `A_Hospital_id` int(11) NOT NULL,
  `Status` tinyint(1) DEFAULT NULL
) ;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`Appointment_id`, `A_Donor_id`, `A_Guest_id`, `A_Date`, `A_Time`, `A_Meridiem`, `A_Hospital_id`, `Status`) VALUES
(1, 1, NULL, '2024/03/15', '10:00', 'PM', 1, NULL),
(2, NULL, 1, '2024/03/20', '11:00', 'PM', 2, 1),
(3, 2, NULL, '2024/03/25', '12:00', 'PM', 3, 1),
(4, NULL, 2, '2024/03/30', '01:00', 'PM', 4, 1),
(5, 3, NULL, '2024/04/05', '02:00', 'PM', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `camp`
--

CREATE TABLE `camp` (
  `Camp_id` int(11) NOT NULL,
  `C_Name` varchar(50) NOT NULL,
  `C_Date` varchar(20) NOT NULL,
  `C_Time` varchar(20) NOT NULL,
  `C_Meridiem` varchar(2) NOT NULL,
  `Led_By` varchar(50) NOT NULL,
  `Line1` varchar(200) NOT NULL,
  `City` varchar(100) NOT NULL,
  `Postal_Code` varchar(15) NOT NULL,
  `Country` varchar(30) NOT NULL,
  `C_Hospital_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `camp`
--

INSERT INTO `camp` (`Camp_id`, `C_Name`, `C_Date`, `C_Time`, `C_Meridiem`, `Led_By`, `Line1`, `City`, `Postal_Code`, `Country`, `C_Hospital_id`) VALUES
(1, 'BloodDonationCamp_Colombo', '2024/08/20', '10:00', 'PM', 'Dr.Jane Doe', '456 Charity Avenue', 'Colombo', '12345', 'SriLanka', 1),
(2, 'BloodDonationCamp_Kandy', '2024/09/15', '11:30', 'PM', 'Dr.John Williams', '789 Hope Street', 'Kandy', '54321', 'SriLanka', 2),
(3, 'BloodDonationCamp_Galle', '2024/10/10', '12:45', 'PM', 'Dr.Mary Smith', '101 Health Lane', 'Galle', '67890', 'SriLanka', 3),
(4, 'BloodDonationCamp_Jaffna', '2024/11/05', '01:15', 'PM', 'Dr.Samantha Brown', '321 Lifeline Road', 'Jaffna', '13579', 'SriLanka', 4),
(5, 'BloodDonationCamp_Matara', '2024/12/01', '02:30', 'PM', 'Dr.Alex Johnson', '567 Save Street', 'Matara', '24680', 'SriLanka', 5);

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `Donor_id` int(11) NOT NULL,
  `Salutation` varchar(10) NOT NULL,
  `F_name` varchar(50) NOT NULL,
  `L_name` varchar(50) NOT NULL,
  `NIC` varchar(20) NOT NULL,
  `DOB` varchar(20) NOT NULL,
  `Gender` varchar(20) NOT NULL,
  `Phone_no` int(10) NOT NULL,
  `Blood_Group` varchar(5) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Line1` varchar(200) NOT NULL,
  `City` varchar(100) NOT NULL,
  `Postal_Code` varchar(15) NOT NULL,
  `Country` varchar(30) NOT NULL,
  `D_Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`Donor_id`, `Salutation`, `F_name`, `L_name`, `NIC`, `DOB`, `Gender`, `Phone_no`, `Blood_Group`, `Email`, `Line1`, `City`, `Postal_Code`, `Country`, `D_Password`) VALUES
(1, 'Mr.', 'Siraaj', 'Saabir', '200335610336', '2003-12-21', 'MALE', 773710347, 'O+', 'siraajsaabir@gmail.com', '480, havelock road', 'Colombo', '00600', 'Sri lanka', 'DuneBust1'),
(2, 'Ms.', 'Sara', 'Althaf', '205050505V', '1999-12-25', 'FEMALE', 2147483647, 'AB+', 'althafsara@gmail.com', '45, Mathew Road', 'Colombo', '00300', 'Sri lanka', 'GlassBre@3'),
(3, 'Mr.', 'Mujeeb', 'Ahdheer', '200327713000', '2003-10-03', 'MALE', 752597153, 'O+', 'mohamedahdheer1@gmail.com', '159, Mancholai road', 'Kinniya', '03', 'Sri lanka', 'Duneus@1'),
(4, 'Mr.', 'Asokan', 'Srisabeshan', '200218302931', '2002-07-01', 'MALE', 701882537, 'O+', 'srisabeshan271@gmail.com', 'bogwantalawa', 'nuwaraeliya', '22060', 'Sri lanka', 'DuneBust'),
(5, 'Mr.', 'Mohamed', 'Sahlaan', '200300502698', '2003-01-05', 'MALE', 772479597, 'B+', 'sahlaanmansoor@gmail.com', '23,Meera Mosque Road', 'kattankudy', '118', 'Sri lanka', 'Dunest1');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_blood`
--

CREATE TABLE `emergency_blood` (
  `EB_id` int(11) NOT NULL,
  `Blood_Group` varchar(5) NOT NULL,
  `EB_Hospital_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency_blood`
--

INSERT INTO `emergency_blood` (`EB_id`, `Blood_Group`, `EB_Hospital_id`) VALUES
(1, 'A+', 1),
(2, 'O-', 2),
(3, 'B+', 3),
(4, 'AB-', 4),
(5, 'O+', 5);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `Feedback_id` int(11) NOT NULL,
  `F_Donor_id` int(11) DEFAULT NULL,
  `F_Hospital_id` int(11) DEFAULT NULL,
  `Comment` varchar(250) NOT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `F_Admin_id` int(11) DEFAULT NULL
) ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`Feedback_id`, `F_Donor_id`, `F_Hospital_id`, `Comment`, `Status`, `F_Admin_id`) VALUES
(1, 1, NULL, 'The website was user-friendly and easy to navigate. Great job!', 1, 1),
(2, 2, NULL, 'I found all the information I needed on the website. It was very helpful.', NULL, NULL),
(3, 3, NULL, 'The website design is modern and visually appealing. I enjoyed using it.', 1, 2),
(4, 4, NULL, 'I had trouble finding the donation form on the website. Maybe it could be more prominent.', 0, 1),
(5, 5, NULL, 'The website loading speed was slow at times, but otherwise, it was fine.', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `Guest_id` int(11) NOT NULL,
  `Salutation` varchar(10) NOT NULL,
  `F_name` varchar(50) NOT NULL,
  `L_name` varchar(50) NOT NULL,
  `NIC` varchar(20) NOT NULL,
  `DOB` varchar(20) NOT NULL,
  `Gender` varchar(20) NOT NULL,
  `Blood_Group` varchar(5) NOT NULL,
  `Email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`Guest_id`, `Salutation`, `F_name`, `L_name`, `NIC`, `DOB`, `Gender`, `Blood_Group`, `Email`) VALUES
(1, 'Mr.', 'John', 'Smith', '305080808V', '1990-05-20', 'MALE', 'O-', 'john.smith@example.com'),
(2, 'Mrs.', 'Emily', 'Johnson', '405070707V', '1985-12-15', 'FEMALE', 'A+', 'emily.johnson@example.com'),
(3, 'Dr.', 'Michael', 'Brown', '505090909V', '1978-08-25', 'MALE', 'AB-', 'michael.brown@example.com'),
(4, 'Ms.', 'Jessica', 'Davis', '605060606V', '1995-03-10', 'FEMALE', 'B-', 'jessica.davis@example.com'),
(5, 'Mr.', 'Daniel', 'Martinez', '705040404V', '1982-11-30', 'MALE', 'A-', 'daniel.martinez@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `Hospital_id` int(11) NOT NULL,
  `H_Name` varchar(50) NOT NULL,
  `Tel_no` int(10) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Line1` varchar(200) NOT NULL,
  `City` varchar(100) NOT NULL,
  `Postal_Code` varchar(15) NOT NULL,
  `Country` varchar(30) NOT NULL,
  `H_Password` varchar(20) NOT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `H_Admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`Hospital_id`, `H_Name`, `Tel_no`, `Email`, `Line1`, `City`, `Postal_Code`, `Country`, `H_Password`, `Status`, `H_Admin_id`) VALUES
(1, 'National Hospital of Sri Lanka', 2147483647, 'info@nationalhospital.lk', 'Regent Street', 'Colombo', '00700', 'SriLanka', 'pass123', 1, 1),
(2, 'Teaching Hospital Kandy', 2147483647, 'info@teachinghospitalkandy.lk', 'Peradeniya Road', 'Kandy', '20000', 'SriLanka', 'kandy456', 1, 1),
(3, 'Nawaloka Hospital', 2147483647, 'info@nawalokahospital.lk', 'No. 23, Deshamanya H.K. Dharmadasa Mawatha', 'Colombo', '00200', 'SriLanka', 'nawaloka789', 1, 1),
(4, 'Durdans Hospital', 2147483647, 'info@durdanshospital.lk', '3 Alfred Place', 'Colombo', '00300', 'Sri Lanka', 'durdans789', 1, 1),
(5, 'Asiri Surgical Hospital', 2147483647, 'info@asiri.lk', '21 Kirimandala Mawatha', 'Colombo', '00500', 'SriLanka', 'asirisurgical321', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_id`),
  ADD UNIQUE KEY `NIC` (`NIC`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Passkey` (`Passkey`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`Appointment_id`),
  ADD KEY `Appointment_A_Doner_id_FK1` (`A_Donor_id`),
  ADD KEY `Appointment_A_Guest_id_FK2` (`A_Guest_id`),
  ADD KEY `Appointment_A_Hospital_id_FK3` (`A_Hospital_id`);

--
-- Indexes for table `camp`
--
ALTER TABLE `camp`
  ADD PRIMARY KEY (`Camp_id`),
  ADD KEY `Camp_C_Hospital_id_FK1` (`C_Hospital_id`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`Donor_id`),
  ADD UNIQUE KEY `NIC` (`NIC`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `emergency_blood`
--
ALTER TABLE `emergency_blood`
  ADD PRIMARY KEY (`EB_id`),
  ADD KEY `Emergency_Blood_EB_Hospital_id_FK1` (`EB_Hospital_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`Feedback_id`),
  ADD KEY `Feedback_F_Doner_id_FK1` (`F_Donor_id`),
  ADD KEY `Feedback_F_Hospital_id_FK2` (`F_Hospital_id`),
  ADD KEY `Feedback_F_Admin_id_FK3` (`F_Admin_id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`Guest_id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`Hospital_id`),
  ADD UNIQUE KEY `H_Name` (`H_Name`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `H_Admin_id_FK1` (`H_Admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `Appointment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `camp`
--
ALTER TABLE `camp`
  MODIFY `Camp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `Donor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `emergency_blood`
--
ALTER TABLE `emergency_blood`
  MODIFY `EB_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `Feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `Guest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `Hospital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `Appointment_A_Doner_id_FK1` FOREIGN KEY (`A_Donor_id`) REFERENCES `donor` (`Donor_id`),
  ADD CONSTRAINT `Appointment_A_Guest_id_FK2` FOREIGN KEY (`A_Guest_id`) REFERENCES `guest` (`Guest_id`),
  ADD CONSTRAINT `Appointment_A_Hospital_id_FK3` FOREIGN KEY (`A_Hospital_id`) REFERENCES `hospital` (`Hospital_id`);

--
-- Constraints for table `camp`
--
ALTER TABLE `camp`
  ADD CONSTRAINT `Camp_C_Hospital_id_FK1` FOREIGN KEY (`C_Hospital_id`) REFERENCES `hospital` (`Hospital_id`);

--
-- Constraints for table `emergency_blood`
--
ALTER TABLE `emergency_blood`
  ADD CONSTRAINT `Emergency_Blood_EB_Hospital_id_FK1` FOREIGN KEY (`EB_Hospital_id`) REFERENCES `hospital` (`Hospital_id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `Feedback_F_Admin_id_FK3` FOREIGN KEY (`F_Admin_id`) REFERENCES `admin` (`Admin_id`),
  ADD CONSTRAINT `Feedback_F_Doner_id_FK1` FOREIGN KEY (`F_Donor_id`) REFERENCES `donor` (`Donor_id`),
  ADD CONSTRAINT `Feedback_F_Hospital_id_FK2` FOREIGN KEY (`F_Hospital_id`) REFERENCES `hospital` (`Hospital_id`);

--
-- Constraints for table `hospital`
--
ALTER TABLE `hospital`
  ADD CONSTRAINT `H_Admin_id_FK1` FOREIGN KEY (`H_Admin_id`) REFERENCES `admin` (`Admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
