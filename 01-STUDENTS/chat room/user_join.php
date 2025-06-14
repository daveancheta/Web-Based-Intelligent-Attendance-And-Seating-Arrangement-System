<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $room_id = $_POST['room_id'];
    $user_name = $_POST['user_name'];
    $message = "$user_name joined the chat";

    // Insert the "joined the chat" message into the messages table
    $query = "INSERT INTO messages (room_id, user_name, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sss', $room_id, $user_name, $message);
    $stmt->execute();

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}
?>
