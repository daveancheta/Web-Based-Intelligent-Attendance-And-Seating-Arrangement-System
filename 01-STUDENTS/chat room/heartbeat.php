<?php
// heartbeat.php - Keep track of active user sessions
session_start();
require 'db.php';

if (!isset($_POST['room_id']) || !isset($_POST['user_name']) || !isset($_POST['page_visit_id'])) {
    echo json_encode(['success' => false, 'message' => 'Missing parameters']);
    exit;
}

$room_id = $_POST['room_id'];
$user_name = $_POST['user_name'];
$page_visit_id = $_POST['page_visit_id'];

// Update or insert into active_users table
$stmt = $conn->prepare("INSERT INTO active_users (room_id, user_name, page_visit_id, last_active) 
                       VALUES (?, ?, ?, NOW()) 
                       ON DUPLICATE KEY UPDATE last_active = NOW()");
$stmt->bind_param("iss", $room_id, $user_name, $page_visit_id);
$result = $stmt->execute();

echo json_encode(['success' => $result]);
?>