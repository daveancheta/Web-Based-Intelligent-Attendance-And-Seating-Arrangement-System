<?php
session_start();
require 'db.php';

if (!isset($_SESSION['room_id']) || !isset($_SESSION['user_name'])) {
    die(json_encode(['success' => false]));
}

$room_id = $_SESSION['room_id'];
$user_name = $_SESSION['user_name'];
$is_typing = $_POST['is_typing'] === 'true';

// Store typing status in database
$stmt = $conn->prepare("INSERT INTO typing_status (room_id, user_name, is_typing, last_updated) 
                        VALUES (?, ?, ?, NOW()) 
                        ON DUPLICATE KEY UPDATE is_typing = VALUES(is_typing), last_updated = NOW()");
$stmt->bind_param("isi", $room_id, $user_name, $is_typing);
$stmt->execute();

echo json_encode(['success' => true]);
?>