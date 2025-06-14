<?php
// Start session if not already started
session_start();
require_once 'db.php';

// Check if room_id and user_name are provided
if (isset($_POST['room_id']) && isset($_POST['user_name'])) {
    $room_id = $_POST['room_id'];
    $user_name = $_POST['user_name'];
    
    // Sanitize inputs
    $room_id = intval($room_id);
    $user_name = mysqli_real_escape_string($conn, $user_name);
    
    // 1. Add a "left the chat" message to messages table
    $message = "left the chat";
    $stmt = $conn->prepare("INSERT INTO messages (room_id, user_name, message, timestamp) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("iss", $room_id, $user_name, $message);
    $stmt->execute();
    $stmt->close();
    
    // 2. Remove user from participants table
    $stmt = $conn->prepare("DELETE FROM participants WHERE room_id = ? AND user_name = ?");
    $stmt->bind_param("is", $room_id, $user_name);
    $stmt->execute();
    $stmt->close();
    
    // 3. Remove typing status
    $stmt = $conn->prepare("DELETE FROM typing_status WHERE room_id = ? AND user_name = ?");
    $stmt->bind_param("is", $room_id, $user_name);
    $stmt->execute();
    $stmt->close();
    
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Required parameters not provided.']);
}
?>