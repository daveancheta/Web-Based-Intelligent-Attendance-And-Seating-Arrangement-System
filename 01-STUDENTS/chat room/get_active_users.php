<?php
session_start();
require 'db.php';

if (!isset($_GET['room_id'])) {
    echo json_encode(['users' => [], 'user_count' => 0]); // Return empty user array and 0 count if no room_id is provided
    exit;
}

$room_id = $_GET['room_id'];

// Fetch activez users for this room
$stmt = $conn->prepare("SELECT DISTINCT user_name FROM participants WHERE room_id = ? ORDER BY user_name");
$stmt->bind_param("i", $room_id);
$stmt->execute();
$result = $stmt->get_result();

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = ['user_name' => $row['user_name']];
}

// Fetch the number of active users in the room
$stmt = $conn->prepare("SELECT COUNT(user_name) AS NumberOfActiveUsers FROM participants WHERE room_id = ?");
$stmt->bind_param("i", $room_id);
$stmt->execute();
$count_result = $stmt->get_result();
$count_row = $count_result->fetch_assoc();
$user_count = $count_row['NumberOfActiveUsers'];

// Close the prepared statements and database connection
$stmt->close();
$conn->close();

// Set the Content-Type header to application/json to properly display JSON in the browser
header('Content-Type: application/json');

// Return both the list of users and the user count in the JSON response
echo json_encode(['users' => $users, 'user_count' => $user_count]);
?>
