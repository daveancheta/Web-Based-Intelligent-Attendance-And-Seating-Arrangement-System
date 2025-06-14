<?php
require 'db.php';

if (!isset($_GET['room_id'])) {
    echo "0";
    exit;
}

$room_id = $_GET['room_id'];
$stmt = $conn->prepare("SELECT COUNT(*) as user_count FROM room_users WHERE room_id = ?");
$stmt->bind_param("i", $room_id);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

echo $result['user_count'];
?>
