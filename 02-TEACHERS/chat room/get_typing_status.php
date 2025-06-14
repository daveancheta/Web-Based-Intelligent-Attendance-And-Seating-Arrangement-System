<?php
session_start();
require 'db.php';

if (!isset($_SESSION['room_id']) || !isset($_SESSION['user_name'])) {
    die(json_encode([]));
}

$room_id = $_SESSION['room_id'];
$current_user = $_SESSION['user_name'];

// Get users who are currently typing (updated in the last 3 seconds)
$stmt = $conn->prepare("SELECT user_name FROM typing_status 
                        WHERE room_id = ? AND is_typing = 1 
                        AND user_name != ? 
                        AND last_updated > DATE_SUB(NOW(), INTERVAL 3 SECOND)");
$stmt->bind_param("is", $room_id, $current_user);
$stmt->execute();
$result = $stmt->get_result();

$typing_users = [];
while ($row = $result->fetch_assoc()) {
    $typing_users[] = $row;
}

echo json_encode($typing_users);
?>