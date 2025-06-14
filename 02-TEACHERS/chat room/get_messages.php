<?php
session_start();
require 'db.php';

if (!isset($_GET['room_id'])) {
    echo json_encode([]);
    exit;
}

$room_id = (int)$_GET['room_id'];

$sql = "SELECT m.*, p.nationality 
        FROM messages m 
        LEFT JOIN participants p ON m.user_name = p.user_name 
        WHERE m.room_id = ? 
        ORDER BY m.timestamp ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $room_id);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = [
        'user_name' => htmlspecialchars($row['user_name']),
        'message' => htmlspecialchars($row['message']),
        'nationality' => htmlspecialchars($row['nationality'] ?? 'Unknown'),
        'timestamp' => $row['timestamp']
    ];
}   

echo json_encode($messages);
?>