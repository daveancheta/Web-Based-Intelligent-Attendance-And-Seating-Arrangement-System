<?php
session_start();
require 'db.php'; // Database connection

// Redirect if no room_id is provided
if (!isset($_POST['room_id']) || !isset($_POST['user_name'])) {
    header("Location: index.php");
    exit;
}

$room_id = $_POST['room_id'];
$user_name = trim($_POST['user_name']);

// Fetch room details
$stmt = $conn->prepare("SELECT name, password FROM rooms WHERE id = ?");
$stmt->bind_param("i", $room_id);
$stmt->execute();
$room = $stmt->get_result()->fetch_assoc();
$stmt->close();

// If room is not found, exit
if (!$room) {
    $_SESSION['join_error'] = "Room not found.";
    $_SESSION['join_room_id'] = $room_id;
    header("Location: index.php");
    exit;
}

// Get student number from session
if (!isset($_SESSION['first_name'])) {
    $_SESSION['join_error'] = "Unauthorized access. Please log in.";
    $_SESSION['join_room_id'] = $room_id;
    header("Location: index.php");
    exit;
}

$student_number = $_SESSION['student_number'];

// Validate student
$stmt = $conn->prepare("SELECT first_name FROM data_student WHERE student_number = ?");
$stmt->bind_param("s", $student_number);
$stmt->execute();
$result = $stmt->get_result();

// Validate if student exists
if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
    $student_number = htmlspecialchars($user_data['first_name'], ENT_QUOTES, 'UTF-8');
} else {
    $_SESSION['join_error'] = "Student not found.";
    $_SESSION['join_room_id'] = $room_id;
    header("Location: index.php");
    exit;
}
$stmt->close();

// Check if user already exists in the room
$stmt = $conn->prepare("SELECT 1 FROM participants WHERE room_id = ? AND user_name = ?");
$stmt->bind_param("is", $room_id, $user_name);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Delete user from participants
    $stmt = $conn->prepare("DELETE FROM participants WHERE room_id = ? AND user_name = ?");
    $stmt->bind_param("is", $room_id, $user_name);
    $stmt->execute();
    $stmt->close();
}

// Check room password if it exists
if (!empty($room['password'])) {
    if (!isset($_POST['password']) || !password_verify($_POST['password'], $room['password'])) {
        $_SESSION['join_error'] = "Incorrect password!";
        $_SESSION['join_room_id'] = $room_id;
        header("Location: index.php");
        exit;
    }
}

// Store session data
$_SESSION['room_id'] = $room_id;
$_SESSION['user_name'] = $user_name;

// Insert participant data into the table
$stmt = $conn->prepare("INSERT INTO participants (room_id, user_name) VALUES (?, ?)");
$stmt->bind_param("is", $room_id, $user_name);

if ($stmt->execute()) {
    header("Location: chatroom.php"); // Redirect to chat room
} else {
    $_SESSION['join_error'] = "Failed to join the room. Please try again.";
    $_SESSION['join_room_id'] = $room_id;
    header("Location: index.php");
}
$stmt->close();
?>