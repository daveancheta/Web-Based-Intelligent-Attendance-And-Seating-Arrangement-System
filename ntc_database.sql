-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2025 at 05:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ntc_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_accounts`
--

CREATE TABLE `admin_accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_accounts`
--

INSERT INTO `admin_accounts` (`id`, `username`, `password`) VALUES
(1, 'admin1', 'admin12345');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `status`) VALUES
(1, 'attendance');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_present`
--

CREATE TABLE `attendance_present` (
  `id` int(11) NOT NULL,
  `student_number` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `timein` varchar(100) NOT NULL,
  `block` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `M_email` varchar(100) NOT NULL,
  `F_email` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bot_assistant`
--

CREATE TABLE `bot_assistant` (
  `id` int(11) NOT NULL,
  `concern` varchar(5000) NOT NULL,
  `response` longtext DEFAULT NULL,
  `link` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bot_assistant`
--

INSERT INTO `bot_assistant` (`id`, `concern`, `response`, `link`) VALUES
(3, 'i forgot my password', 'I can help you with that. Please click the link below and enter your verified or registered email account. The password will be sent to your email address.', 'http://localhost/NATIONAL%20TEACHERS%20COLLEGE/01-STUDENTS/19-forgot-student-number.php'),
(4, 'How to contact admin', 'For assistance, please contact the admin:\r\nPhone Number: +63 93586754463\r\nEmail: support@attendance.monitoring.ph\r\n', ''),
(12, 'Who is the developer of this system?', 'The main developer of this system is Heaven Dave Ancheta, in collaboration with Rj Alagar, Russel Alvia, Christian Calubad, Jhan De Vera, Julius Go, and Ion Dale.', '');

-- --------------------------------------------------------

--
-- Table structure for table `dat`
--

CREATE TABLE `dat` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dat`
--

INSERT INTO `dat` (`id`, `email`, `password`) VALUES
(76, 'daveancheta0121@gmail.com', 'abc123'),
(77, 'daveancheta0121@gmail.com', 'abc123'),
(78, 'rj.alagar.rja@gmail.com', 'abc123'),
(79, '423001159@ntc.edu.ph', 'abc123'),
(80, '423001159@ntc.edu.ph', 'abc123'),
(81, 'rja@gmail.com', 'abc123'),
(82, 'jhannichold@gmail.com', 'abc123'),
(83, 'jhannichold@gmail.com', 'abc123'),
(84, 'jhannichold@gmail.com', 'abc123'),
(85, 'jhannichold@gmail.com', 'abc123'),
(86, 'jhannichold@gmail.com', 'abc123'),
(87, 'Funtimed22@gmail.com', 'abc123'),
(88, '423001202@ntc.edu.ph', 'abc123'),
(89, 'asdasd@dasdasd', 'abc123'),
(90, 'adasdasdasdasd@asdasd', 'abc123'),
(91, 'daveancheta8@gmail.com', 'abc123'),
(92, 'daveancheta8@gmail.com', 'abc123'),
(93, 'daveancheta8@gmail.com', 'abc123'),
(94, '423001202@ntc.edu.ph', 'abc123');

-- --------------------------------------------------------

--
-- Table structure for table `data_student`
--

CREATE TABLE `data_student` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `profile_pic_status` varchar(100) NOT NULL,
  `block_sec` varchar(50) NOT NULL,
  `student_number` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `password` varchar(50) NOT NULL,
  `M_first_name` varchar(50) NOT NULL,
  `M_surname` varchar(50) DEFAULT NULL,
  `M_suffix` varchar(10) DEFAULT NULL,
  `M_email` varchar(100) DEFAULT NULL,
  `M_contact_number` varchar(20) DEFAULT NULL,
  `M_occupation` varchar(100) DEFAULT NULL,
  `F_first_name` varchar(50) NOT NULL,
  `F_surname` varchar(50) DEFAULT NULL,
  `F_suffix` varchar(10) DEFAULT NULL,
  `F_email` varchar(100) DEFAULT NULL,
  `F_contact_number` varchar(20) DEFAULT NULL,
  `F_occupation` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `M_middle_name` varchar(50) NOT NULL,
  `F_middle_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_student`
--

INSERT INTO `data_student` (`id`, `first_name`, `middle_name`, `surname`, `suffix`, `image_path`, `profile_pic_status`, `block_sec`, `student_number`, `email`, `gender`, `birthdate`, `password`, `M_first_name`, `M_surname`, `M_suffix`, `M_email`, `M_contact_number`, `M_occupation`, `F_first_name`, `F_surname`, `F_suffix`, `F_email`, `F_contact_number`, `F_occupation`, `created_at`, `M_middle_name`, `F_middle_name`) VALUES
(75, 'heaven dave', 'quimpo', 'ancheta', 'N/A', 'uploads/684aa408f14b6.jpeg', 'edit', '', '423001202', 'daveancheta8@gmail.com', 'Male', '2025-06-12', 'ancheta', 'rachel', 'quimpo', 'N/A', 'daveancheta0121@gmail.com', '098675647321', 'ceo', 'roel', 'ancheta', 'N/A', 'daveancheta411@gmail.com', '09768564738', 'ceo', '2025-06-12 08:18:32', 'gesmundo', 'dela cruz'),
(76, 'rafael john', 'nazareno', 'alagar', 'N/A', 'uploads/684d2dac8e40e.jpeg', 'edit', '', '423000882', 'rj.alagar.rja@gmail.com', 'Male', '2024-10-31', 'dayzz1234', 'matea', 'alagar', 'N/A', '423000882@ntc.edu.ph', '0956822441', 'n/a', 'ray anthony', 'alagar', 'N/A', '423000882@ntc.edu.ph', '09568269536', 'N/a', '2025-06-14 08:00:21', 'reyes', 'nazareno'),
(77, 'christian', 'legaspi', 'calubad', 'N/A', 'uploads/684d2db99edad.jpg', 'edit', '', '423001159', '423001159@ntc.edu.ph', 'Male', '2004-02-02', 'ionpogi123', 'estella', 'calubad ', 'N/A', 'estella@gmail.com', '09555101722', 'house wife', 'jose judy', 'calubad', 'N/A', 'jud@gmail.com', '09174457872', 'driver', '2025-06-14 08:04:05', 'caña', 'rollan'),
(78, 'rj', 'nazareno', 'alagar', 'N/A', '', 'add', '', '4233000', 'rja@gmail.com', 'Male', '2025-06-14', 'abc123', 'sheeshh', 'alagar', 'N/A', 'rja@gmail.com', '0943551198', 'N/a', 'ray', 'alagar', 'N/A', 'rja@gmail.com', '095551617', 'n/a', '2025-06-14 08:04:18', 'okay', 'okay'),
(80, 'Jhan nichol ', 'Gabarda', 'De vera', '', 'uploads/6801bb244b904.jpg', 'add', '12', '423002008', 'Funtimed22@gmail.com', 'Male', '2004-11-02', 'abc123', 'Janice ', 'De Vera ', '', 'Funtimed22@gmail.com', '09672472734', 'Accountant ', 'Nico', 'De Vera ', '', 'Funtimed22@gmail.com', '09672472734', 'N/a', '2025-06-14 08:18:40', 'Gabarda', 'Gabarda'),
(81, 'asdasd', 'asdasd', 'asd', 'N/A', '', 'add', '', '123131', 'asdasd@dasdasd', 'Male', '2025-06-14', 'abc123', 'dasdas', 'asdas', 'N/A', 'adasdasd2@dasdasd', '2313123', 'asdasda', 'asdasd', 'aasdasd', 'III', 'asdsad@dasdas', '2312313', 'asdasd', '2025-06-14 15:33:16', 'asdasdasd', 'dasdasd'),
(82, 'dasdasd', 'asdasd', 'asdas', 'N/A', '', 'add', '', '231312312', 'adasdasdasdasd@asdasd', 'Male', '2025-06-14', 'abc123', 'dasdasdas', 'asdas', 'N/A', 'dasd@dasdasdas', '2312312', 'dasdasda', 'dasd', 'asdas', 'Sr', 'Dasdad@dasda', '2313123123', 'dasdasd', '2025-06-14 15:35:42', 'asdasd', 'dasdasd'),
(83, 'asdasdasd', 'asdasdasdasd', 'asdasd', '', '', 'add', '', '231123', 'daveancheta8@gmail.com', 'Male', '2025-06-14', 'abc123', 'dasdadas', 'asdas', 'N/A', 'sdasdasasdas@dasdas', '231312', 'dasdasdasasda', 'asdasdas', 'sdasd', 'Sr', 'dsadas@adasd', '312313131312', 'dadasdasda', '2025-06-14 15:36:40', 'dasdas', 'dasdasd'),
(84, 'dasdasdas', 'dasdas', 'asdas', 'Jr.', '', 'add', '', '231312', 'daveancheta8@gmail.com', 'Male', '2025-06-14', 'abc123', 'asdas', 'asd', 'N/A', '2adasd@dasdasd', '231231', 'asdasdas', 'dasdas', 'asdasdas', 'Sr', 'asdasda@dasdasd', '31123123', 'asdasdasd', '2025-06-14 15:38:40', 'dasdasdas', 'dasda'),
(85, 'heaven dave', 'quimpo', 'ancheta', 'N/A', 'uploads/684d98eb9b9cd.jpg', 'edit', '', '423001205', '423001202@ntc.edu.ph', 'Male', '2025-06-14', 'abc123', 'rachel', 'quimpo', 'N/A', 'daveancheta411@gmail.com', '097685746323', 'ceo', 'roel', 'ancheta', 'N/A', 'daveancheta0121@gmail.com', '098768956472', 'ceo', '2025-06-14 15:43:23', 'gesmundo', 'dela cruz');

-- --------------------------------------------------------

--
-- Table structure for table `emailapprove`
--

CREATE TABLE `emailapprove` (
  `id` int(11) NOT NULL,
  `student_number` int(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `approved_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emailapprove`
--

INSERT INTO `emailapprove` (`id`, `student_number`, `email`, `password`, `approved_at`) VALUES
(1, 0, 'daveancheta8@gmail.com', '$2y$10$xwfUzdNcGpFC0wVExL8WaO8eV7QbdFWDjRo0xR6Z0B8JAEZ6oEcXW', '2025-03-18 13:18:33'),
(3, 423001202, 'saxpadofficial@gmail.com', 'dave', '2025-03-18 13:38:42');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `filetype` varchar(100) NOT NULL,
  `filesize` int(11) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `room_id`, `user_name`, `filename`, `original_name`, `filepath`, `filetype`, `filesize`, `uploaded_at`) VALUES
(1, 19, '423001202', '6811f7a52b71d.pdf', 'WEEK 11 and 12 ACTIVITIES.pdf', 'uploads/6811f7a52b71d.pdf', 'application/pdf', 38843, '2025-04-30 10:12:53'),
(2, 19, '423001202', '6811f7ac28e46.png', 'Screenshot 2025-03-15 081934.png', 'uploads/6811f7ac28e46.png', 'image/png', 2131580, '2025-04-30 10:13:00'),
(3, 19, '423001202', '6811f7d38ed34.pdf', 'ACTIVITY 6 MT.pdf', 'uploads/6811f7d38ed34.pdf', 'application/pdf', 132977, '2025-04-30 10:13:39'),
(4, 19, '423001513', '6811f8014e772.jpg', 'IMG20250429174214_BURST001_COVER.jpg', 'uploads/6811f8014e772.jpg', 'image/jpeg', 4220808, '2025-04-30 10:14:25');

-- --------------------------------------------------------

--
-- Table structure for table `gizmo_status`
--

CREATE TABLE `gizmo_status` (
  `gizmo` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gizmo_status`
--

INSERT INTO `gizmo_status` (`gizmo`, `status`) VALUES
('gizmo', 'online');

-- --------------------------------------------------------

--
-- Table structure for table `info_ass`
--

CREATE TABLE `info_ass` (
  `id` int(11) NOT NULL,
  `seat_number` varchar(200) NOT NULL,
  `student_number` varchar(200) NOT NULL,
  `student_name` varchar(300) NOT NULL,
  `taken_at` datetime NOT NULL DEFAULT current_timestamp(),
  `subject` varchar(100) NOT NULL,
  `block` varchar(100) NOT NULL,
  `class_time` varchar(100) NOT NULL,
  `class_days` varchar(100) NOT NULL,
  `room` varchar(100) NOT NULL,
  `professor` varchar(100) NOT NULL,
  `timein` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `M_email` varchar(200) NOT NULL,
  `F_email` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `info_ass`
--

INSERT INTO `info_ass` (`id`, `seat_number`, `student_number`, `student_name`, `taken_at`, `subject`, `block`, `class_time`, `class_days`, `room`, `professor`, `timein`, `date`, `M_email`, `F_email`, `status`) VALUES
(71, 'S1', '423001203', '', '2025-05-03 17:54:53', ' Systems Analysis and Design', 'Block 2.3', '07:00am - 10:00am', 'S', '101', 'Pacer, Joshua', '', '', '', '', ''),
(77, 'S100', '423001203', '', '2025-05-03 17:54:53', ' Systems Analysis and Design', 'Block 2.3', '07:00am - 10:00am', 'S', '101', 'Pacer, Joshua', '', '', '', '', ''),
(78, 'S5', '423001204', '', '2025-05-03 17:54:53', ' Systems Analysis and Design', 'Block 2.3', '07:00am - 10:00am', 'S', '101', 'Pacer, Joshua', '', '', '', '', ''),
(88, 'S60', '423001202', 'heaven dave quimpo ancheta', '2025-06-12 17:56:37', ' Systems Analysis and Design', 'Block 2.3', '07:30am - 09:30am', 'M/TH', '101', 'Pacer, Joshua', '11:26:44 AM', 'June 17, 2025', 'daveancheta411@gmail.com', 'daveancheta0121@gmail.com', 'present'),
(89, 'S1', '423002008', 'Jhan nichol  Gabarda De vera', '2025-06-14 16:27:27', 'Wika, Kultura at Lipunan: Introduksyon sa Sosyolinggwistika', 'Block 2.3', '07:30am - 09:30am', 'M/TH', '101', 'Gallozo, Helen', '04:47:10 PM', 'June 14, 2025', 'Funtimed22@gmail.com', 'Funtimed22@gmail.com', 'present'),
(90, 'S4', '423001159', 'christian legaspi calubad', '2025-06-14 16:42:27', 'Wika, Kultura at Lipunan: Introduksyon sa Sosyolinggwistika', 'Block 2.3', '07:30am - 09:30am', 'M/TH', '101', 'Gallozo, Helen', '', '', '', '', ''),
(91, 'S30', '423001205', 'heaven dave quimpo ancheta', '2025-06-14 23:49:21', ' Systems Analysis and Design', 'Block 2.3', '07:30am - 09:30am', 'M/TH', '101', 'Pacer, Joshua', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`user_id`, `room_id`, `user_name`, `message`, `timestamp`, `created_at`) VALUES
(1662, 19, 'Pacer, Joshua', 'Pacer, Joshua joined the chat', '2025-06-14 08:21:27', '2025-06-14 08:21:27'),
(1663, 19, 'Jhan nichol', 'left the chat', '2025-06-14 08:21:29', '2025-06-14 08:21:29'),
(1664, 19, 'Pacer, Joshua', 'left the chat', '2025-06-14 08:21:33', '2025-06-14 08:21:33'),
(1665, 19, 'heaven dave', 'heaven dave joined the chat', '2025-06-14 15:44:12', '2025-06-14 15:44:12'),
(1666, 19, 'heaven dave', 'hii', '2025-06-14 15:44:15', '2025-06-14 15:44:15'),
(1667, 19, 'heaven dave', 'left the chat', '2025-06-14 15:44:17', '2025-06-14 15:44:17'),
(1668, 19, 'Pacer, Joshua', 'Pacer, Joshua joined the chat', '2025-06-14 15:52:37', '2025-06-14 15:52:37'),
(1669, 19, 'Pacer, Joshua', 'good evening students', '2025-06-14 15:52:46', '2025-06-14 15:52:46'),
(1670, 19, 'Pacer, Joshua', 'left the chat', '2025-06-14 15:52:48', '2025-06-14 15:52:48'),
(1671, 19, 'Pacer, Joshua', 'Pacer, Joshua joined the chat', '2025-06-14 16:07:04', '2025-06-14 16:07:04'),
(1672, 19, 'Pacer, Joshua', 'HIHIHIHIH', '2025-06-14 16:07:07', '2025-06-14 16:07:07'),
(1673, 19, 'Pacer, Joshua', 'left the chat', '2025-06-14 16:07:08', '2025-06-14 16:07:08'),
(1674, 19, 'Pacer, Joshua', 'Pacer, Joshua joined the chat', '2025-06-14 16:08:21', '2025-06-14 16:08:21'),
(1675, 19, 'Pacer, Joshua', 'asdasdasdasdsadasd', '2025-06-14 16:08:23', '2025-06-14 16:08:23'),
(1676, 19, 'Pacer, Joshua', 'left the chat', '2025-06-14 16:08:24', '2025-06-14 16:08:24'),
(1677, 19, 'heaven dave', 'heaven dave joined the chat', '2025-06-17 03:30:11', '2025-06-17 03:30:11'),
(1678, 19, 'heaven dave', 'nigga', '2025-06-17 03:30:14', '2025-06-17 03:30:14'),
(1679, 19, 'heaven dave', 'left the chat', '2025-06-17 03:30:16', '2025-06-17 03:30:16'),
(1680, 19, 'heaven dave', 'heaven dave joined the chat', '2025-06-17 03:34:26', '2025-06-17 03:34:26');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `user_id` int(11) NOT NULL,
  `room_id` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `nationality` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`user_id`, `room_id`, `user_name`, `joined_at`, `nationality`) VALUES
(375, '19', 'heaven dave', '2025-06-17 03:34:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `created_at`, `password`) VALUES
(19, 'BSIT - 2.1', '2025-03-22 11:56:40', '$2y$10$QJKvz9W9PgymVEv8YWjp5OkQ/yuzMt7xlYOCjyavZlnLRF/52xvQ6'),
(20, 'BSIT - 2.2', '2025-03-22 11:56:58', '$2y$10$eBSBxlqSB4hw08/xTU.9cuR1qSy0Ks0NzvC5yVC1IX790F0AEjjN.'),
(21, 'BSIT - 2.3', '2025-03-22 11:57:09', '$2y$10$DSVE0OvduaHTM9NDWlVB/urEVNl3hBNwVP8v6kDZC10wIHPl5eGiS'),
(22, 'BSIT - 2.4', '2025-03-22 11:57:17', '$2y$10$i1OA3RcxTKgQ5N592YoFXOLtMoOTy0Ff/OY.F9jrb0pHY/hhelZhe'),
(23, 'BSIT - 2.5', '2025-03-22 11:57:32', '$2y$10$iEddSHYhjnHJEiiXcLP/COBYqskj3VLF7ZC8qoLU56INGk6fhG2GG'),
(24, 'BSIT - 2.6', '2025-03-22 11:57:42', '$2y$10$/V4cdjVN.FNCgkYt8DUxH.vH2NHWURTparvnYF6aS31zFz8zTUWQC'),
(25, 'BSIT - 2.7', '2025-03-22 11:57:58', '$2y$10$9u1C6nWgit2HuPh5E8FD8uWewuacB/L3kmD5kpVF334WPLiNJSv1a'),
(31, 'BSIT - 4.1', '2025-06-11 06:09:50', '$2y$10$cjIc5SWE6xVCzrsGhUpQvOdEh2/4tAmsAjbGtVIMrcVN7QqS1QRmC');

-- --------------------------------------------------------

--
-- Table structure for table `room_101`
--

CREATE TABLE `room_101` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_101`
--

INSERT INTO `room_101` (`id`, `block`, `professor`, `start_time`, `end_time`, `subject`, `day`, `password`) VALUES
(67, 'Block 2.3', 'Gallozo, Helen', '07:30:00', '09:30:00', 'Wika, Kultura at Lipunan: Introduksyon sa Sosyolinggwistika', 'M/TH', 'DvQJfWfJYq'),
(68, 'Block 2.3', 'Pacer, Joshua', '13:00:00', '22:00:00', 'IT Elective 1', 'S', 'IJrYkXxARU'),
(69, 'Block 2.3', 'Pacer, Joshua', '07:30:00', '09:30:00', ' Systems Analysis and Design', 'M/TH', 'xtVD34xqSK'),
(70, 'Block 2.3', 'Pacer, Joshua', '10:30:00', '11:30:00', ' Systems Analysis and Design w/Lab', 'M/TH', 'BHrzpNfgY1'),
(71, 'Block 2.3', 'Bunag, Rodessa', '15:00:00', '16:00:00', 'Information Assurance and Security 1 w/ LAB', 'T/F', 'Vdaedw2U0J'),
(72, 'Block 2.3', 'Bunag, Rodessa', '13:30:00', '15:00:00', 'Information Assurance and Security 1 ', 'T/F', 'pvv839UJZ6'),
(73, 'Block 2.3', 'Pacer, Joshua', '15:00:00', '16:30:00', 'Object Oriented Programming ', 'M/TH', 'X6uJM18WWy'),
(74, 'Block 2.3', 'Pacer, Joshua', '16:30:00', '17:30:00', 'Object Oriented Programming w/LAB', 'M/TH', 'iLRGmTCur2'),
(75, 'Block 2.3', 'Gatus, Joanah Vidth', '13:30:00', '15:54:00', 'Physical Education 4', 'S', '9nmyeyg6tM'),
(79, 'Block 2.3', 'T/F', '09:47:00', '21:47:00', 'Information Assurance and Security 1 w/ LAB', 'Rodessa Bunag', 'eS7VUoz9f5'),
(80, 'Block 2.3', 'M/TH', '09:00:00', '11:00:00', 'Python', 'Pacer, Joshua	', 'gY7acTheF2');

-- --------------------------------------------------------

--
-- Table structure for table `room_102`
--

CREATE TABLE `room_102` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_103`
--

CREATE TABLE `room_103` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_104`
--

CREATE TABLE `room_104` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_105`
--

CREATE TABLE `room_105` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_106`
--

CREATE TABLE `room_106` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_107`
--

CREATE TABLE `room_107` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_108`
--

CREATE TABLE `room_108` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_109`
--

CREATE TABLE `room_109` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_110`
--

CREATE TABLE `room_110` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_111`
--

CREATE TABLE `room_111` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_112`
--

CREATE TABLE `room_112` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_113`
--

CREATE TABLE `room_113` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_114`
--

CREATE TABLE `room_114` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_115`
--

CREATE TABLE `room_115` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_116`
--

CREATE TABLE `room_116` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_117`
--

CREATE TABLE `room_117` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_118`
--

CREATE TABLE `room_118` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_119`
--

CREATE TABLE `room_119` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_120`
--

CREATE TABLE `room_120` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_121`
--

CREATE TABLE `room_121` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_122`
--

CREATE TABLE `room_122` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_123`
--

CREATE TABLE `room_123` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_124`
--

CREATE TABLE `room_124` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_125`
--

CREATE TABLE `room_125` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_126`
--

CREATE TABLE `room_126` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_127`
--

CREATE TABLE `room_127` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_128`
--

CREATE TABLE `room_128` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_129`
--

CREATE TABLE `room_129` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_130`
--

CREATE TABLE `room_130` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_201`
--

CREATE TABLE `room_201` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_202`
--

CREATE TABLE `room_202` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_203`
--

CREATE TABLE `room_203` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_204`
--

CREATE TABLE `room_204` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_205`
--

CREATE TABLE `room_205` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_206`
--

CREATE TABLE `room_206` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_207`
--

CREATE TABLE `room_207` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_208`
--

CREATE TABLE `room_208` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_209`
--

CREATE TABLE `room_209` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_210`
--

CREATE TABLE `room_210` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_211`
--

CREATE TABLE `room_211` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_212`
--

CREATE TABLE `room_212` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_213`
--

CREATE TABLE `room_213` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_214`
--

CREATE TABLE `room_214` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_215`
--

CREATE TABLE `room_215` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_216`
--

CREATE TABLE `room_216` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_217`
--

CREATE TABLE `room_217` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_218`
--

CREATE TABLE `room_218` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_219`
--

CREATE TABLE `room_219` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_220`
--

CREATE TABLE `room_220` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_221`
--

CREATE TABLE `room_221` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_222`
--

CREATE TABLE `room_222` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_223`
--

CREATE TABLE `room_223` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_224`
--

CREATE TABLE `room_224` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_225`
--

CREATE TABLE `room_225` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_226`
--

CREATE TABLE `room_226` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_227`
--

CREATE TABLE `room_227` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_228`
--

CREATE TABLE `room_228` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_229`
--

CREATE TABLE `room_229` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_230`
--

CREATE TABLE `room_230` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_301`
--

CREATE TABLE `room_301` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_302`
--

CREATE TABLE `room_302` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_303`
--

CREATE TABLE `room_303` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_304`
--

CREATE TABLE `room_304` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_305`
--

CREATE TABLE `room_305` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_306`
--

CREATE TABLE `room_306` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_307`
--

CREATE TABLE `room_307` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_308`
--

CREATE TABLE `room_308` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_309`
--

CREATE TABLE `room_309` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_310`
--

CREATE TABLE `room_310` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_311`
--

CREATE TABLE `room_311` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_312`
--

CREATE TABLE `room_312` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_313`
--

CREATE TABLE `room_313` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_314`
--

CREATE TABLE `room_314` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_315`
--

CREATE TABLE `room_315` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_316`
--

CREATE TABLE `room_316` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_317`
--

CREATE TABLE `room_317` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_318`
--

CREATE TABLE `room_318` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_319`
--

CREATE TABLE `room_319` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_320`
--

CREATE TABLE `room_320` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_321`
--

CREATE TABLE `room_321` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_322`
--

CREATE TABLE `room_322` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_323`
--

CREATE TABLE `room_323` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_324`
--

CREATE TABLE `room_324` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_325`
--

CREATE TABLE `room_325` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_326`
--

CREATE TABLE `room_326` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_327`
--

CREATE TABLE `room_327` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_328`
--

CREATE TABLE `room_328` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_329`
--

CREATE TABLE `room_329` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_330`
--

CREATE TABLE `room_330` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_401`
--

CREATE TABLE `room_401` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_401`
--

INSERT INTO `room_401` (`id`, `block`, `professor`, `start_time`, `end_time`, `subject`, `day`, `password`) VALUES
(0, 'Block 1.2', 'Vargas, Darwin', '21:17:00', '22:17:00', 'music class', 'T/F', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_402`
--

CREATE TABLE `room_402` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_403`
--

CREATE TABLE `room_403` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_404`
--

CREATE TABLE `room_404` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_405`
--

CREATE TABLE `room_405` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_406`
--

CREATE TABLE `room_406` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_407`
--

CREATE TABLE `room_407` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_408`
--

CREATE TABLE `room_408` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_409`
--

CREATE TABLE `room_409` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_410`
--

CREATE TABLE `room_410` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_411`
--

CREATE TABLE `room_411` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_412`
--

CREATE TABLE `room_412` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_413`
--

CREATE TABLE `room_413` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_414`
--

CREATE TABLE `room_414` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_415`
--

CREATE TABLE `room_415` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_416`
--

CREATE TABLE `room_416` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_417`
--

CREATE TABLE `room_417` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_418`
--

CREATE TABLE `room_418` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_419`
--

CREATE TABLE `room_419` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_420`
--

CREATE TABLE `room_420` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_421`
--

CREATE TABLE `room_421` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_422`
--

CREATE TABLE `room_422` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_423`
--

CREATE TABLE `room_423` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_424`
--

CREATE TABLE `room_424` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_425`
--

CREATE TABLE `room_425` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_426`
--

CREATE TABLE `room_426` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_427`
--

CREATE TABLE `room_427` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_428`
--

CREATE TABLE `room_428` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_429`
--

CREATE TABLE `room_429` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_430`
--

CREATE TABLE `room_430` (
  `id` int(11) NOT NULL,
  `block` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_users`
--

CREATE TABLE `room_users` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seat_1`
--

CREATE TABLE `seat_1` (
  `id` int(11) NOT NULL,
  `seat_1` varchar(100) NOT NULL DEFAULT '0',
  `seat_2` int(11) NOT NULL DEFAULT 0,
  `seat_3` int(11) NOT NULL DEFAULT 0,
  `seat_4` int(11) NOT NULL DEFAULT 0,
  `seat_5` int(11) NOT NULL DEFAULT 0,
  `seat_6` int(11) NOT NULL DEFAULT 0,
  `seat_7` int(11) NOT NULL DEFAULT 0,
  `seat_8` int(11) NOT NULL DEFAULT 0,
  `seat_9` int(11) NOT NULL DEFAULT 0,
  `seat_10` int(11) NOT NULL DEFAULT 0,
  `seat_11` int(11) NOT NULL DEFAULT 0,
  `seat_12` int(11) NOT NULL DEFAULT 0,
  `seat_13` int(11) NOT NULL DEFAULT 0,
  `seat_14` int(11) NOT NULL DEFAULT 0,
  `seat_15` int(11) NOT NULL DEFAULT 0,
  `seat_16` int(11) NOT NULL DEFAULT 0,
  `seat_17` int(11) NOT NULL DEFAULT 0,
  `seat_18` int(11) NOT NULL DEFAULT 0,
  `seat_19` int(11) NOT NULL DEFAULT 0,
  `seat_20` int(11) NOT NULL DEFAULT 0,
  `seat_21` int(11) NOT NULL DEFAULT 0,
  `seat_22` int(11) NOT NULL DEFAULT 0,
  `seat_23` int(11) NOT NULL DEFAULT 0,
  `seat_24` int(11) NOT NULL DEFAULT 0,
  `seat_25` int(11) NOT NULL DEFAULT 0,
  `seat_26` int(11) NOT NULL DEFAULT 0,
  `seat_27` int(11) NOT NULL DEFAULT 0,
  `seat_28` int(11) NOT NULL DEFAULT 0,
  `seat_29` int(11) NOT NULL DEFAULT 0,
  `seat_30` int(11) NOT NULL DEFAULT 0,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_status`
--

CREATE TABLE `system_status` (
  `id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_status`
--

INSERT INTO `system_status` (`id`, `status`) VALUES
(1, 'online');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_accounts`
--

CREATE TABLE `teacher_accounts` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image_path` varchar(100) NOT NULL,
  `profile_pic_status` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_accounts`
--

INSERT INTO `teacher_accounts` (`id`, `email`, `fullname`, `password`, `image_path`, `profile_pic_status`, `created_at`) VALUES
(1, 'jo.pacer@ntc.edu.ph', 'Pacer, Joshua', 'abc123', 'uploads/teachers/683701cf0ea85.jpg', 'edit', '2025-05-01 12:50:03');

-- --------------------------------------------------------

--
-- Table structure for table `typing_status`
--

CREATE TABLE `typing_status` (
  `room_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `is_typing` tinyint(1) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `typing_status`
--

INSERT INTO `typing_status` (`room_id`, `user_name`, `is_typing`, `last_updated`) VALUES
(19, 'christian', 0, '2025-06-14 08:20:10'),
(19, 'dav', 0, '2025-05-08 05:18:34'),
(19, 'rafael john', 0, '2025-06-14 08:16:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `otp` varchar(6) NOT NULL,
  `otp_expires` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `otp`, `otp_expires`, `created_at`) VALUES
(1, 'daveancheta8@gmail.com', '$2y$10$xwfUzdNcGpFC0wVExL8WaO8eV7QbdFWDjRo0xR6Z0B8JAEZ6oEcXW', '835664', '2025-03-18 14:27:55', '2025-03-18 13:17:55'),
(4, 'saxpadofficial@gmail.com', '$2y$10$GT2hm.l9sLxF6hhIJ2jB/.SCuwjoUPxlTzhgEYnFcnHrcA2tki5DW', '443353', '2025-03-18 14:48:19', '2025-03-18 13:38:19');

-- --------------------------------------------------------

--
-- Table structure for table `userss`
--

CREATE TABLE `userss` (
  `username` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `surname` varchar(100) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userss`
--

INSERT INTO `userss` (`username`, `first_name`, `middle_name`, `surname`, `age`, `nationality`) VALUES
('423001202', '', NULL, '', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_present`
--
ALTER TABLE `attendance_present`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bot_assistant`
--
ALTER TABLE `bot_assistant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dat`
--
ALTER TABLE `dat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_student`
--
ALTER TABLE `data_student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_number` (`student_number`);

--
-- Indexes for table `emailapprove`
--
ALTER TABLE `emailapprove`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `gizmo_status`
--
ALTER TABLE `gizmo_status`
  ADD PRIMARY KEY (`gizmo`);

--
-- Indexes for table `info_ass`
--
ALTER TABLE `info_ass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_101`
--
ALTER TABLE `room_101`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_users`
--
ALTER TABLE `room_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seat_1`
--
ALTER TABLE `seat_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `system_status`
--
ALTER TABLE `system_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_accounts`
--
ALTER TABLE `teacher_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `typing_status`
--
ALTER TABLE `typing_status`
  ADD PRIMARY KEY (`room_id`,`user_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `userss`
--
ALTER TABLE `userss`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attendance_present`
--
ALTER TABLE `attendance_present`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `bot_assistant`
--
ALTER TABLE `bot_assistant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `dat`
--
ALTER TABLE `dat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `data_student`
--
ALTER TABLE `data_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `emailapprove`
--
ALTER TABLE `emailapprove`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `info_ass`
--
ALTER TABLE `info_ass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1681;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=376;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `room_101`
--
ALTER TABLE `room_101`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `room_users`
--
ALTER TABLE `room_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `seat_1`
--
ALTER TABLE `seat_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_status`
--
ALTER TABLE `system_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher_accounts`
--
ALTER TABLE `teacher_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `typing_status`
--
ALTER TABLE `typing_status`
  ADD CONSTRAINT `typing_status_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
