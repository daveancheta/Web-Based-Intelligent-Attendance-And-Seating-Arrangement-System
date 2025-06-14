<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $room_id = $_POST['room_id'];
    $user_name = $_POST['user_name'];
    $message = $_POST['message'];

    // Make sure there are no empty messages
    if (empty($message)) {
        echo json_encode(['success' => false, 'error' => 'Message is empty']);
        exit;
    }

    // Insert the message into the messages table
    $query = "INSERT INTO messages (room_id, user_name, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sss', $room_id, $user_name, $message);
    
    // Check if the insert was successful
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Message insertion failed']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
