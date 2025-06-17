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
