<?php
session_start();
require 'db.php';

if (!isset($_SESSION['room_id']) || !isset($_SESSION['user_name'])) {
    die(json_encode([]));
}

$room_id = $_SESSION['room_id'];
$current_user = $_SESSION['user_name'];

// Get users who are currently typing (updated in the last 3 seconds)
$stmt = $conn->prepare("SELECT ts.user_name, ds.first_name, ds.surname 
                        FROM typing_status ts 
                        LEFT JOIN data_student ds ON ts.user_name = ds.student_number
                        WHERE ts.room_id = ? AND ts.is_typing = 1 
                        AND ts.user_name != ? 
                        AND ts.last_updated > DATE_SUB(NOW(), INTERVAL 3 SECOND)");
$stmt->bind_param("is", $room_id, $current_user);
$stmt->execute();
$result = $stmt->get_result();

$typing_users = [];
while ($row = $result->fetch_assoc()) {
    // If we have the student's name, use it, otherwise use the student number
    $display_name = ($row['first_name'] && $row['surname']) 
        ? $row['first_name'] . ' ' . $row['surname']
        : $row['user_name'];
    $typing_users[] = [
        'user_name' => $row['user_name'],
        'display_name' => $display_name
    ];
}

echo json_encode($typing_users);
?>