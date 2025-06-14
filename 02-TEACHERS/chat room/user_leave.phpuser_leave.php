<?php
session_start();
require 'db.php';

if (!isset($_SESSION['room_id']) || !isset($_SESSION['user_name'])) {
    die(json_encode(['success' => false]));
}

$room_id = $_POST['room_id'];
$user_name = $_POST['user_name'];

// Insert a "left the chat" message
$stmt = $conn->prepare("INSERT INTO messages (room_id, user_name, message) VALUES (?, ?, ?)");
$message = "$user_name left the chat";
$stmt->bind_param("iss", $room_id, $user_name, $message);
$stmt->execute();

echo json_encode(['success' => true]);
?>