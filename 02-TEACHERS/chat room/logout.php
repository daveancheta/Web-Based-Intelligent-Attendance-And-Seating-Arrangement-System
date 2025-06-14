<?php
session_start();
require 'db.php';

if (isset($_SESSION['room_id']) && isset($_SESSION['user_name'])) {
    $room_id = $_SESSION['room_id'];
    $user_name = $_SESSION['user_name'];

    // Remove the user from the room
    $query = "DELETE FROM users WHERE room_id = ? AND user_name = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$room_id, $user_name]);
}

session_destroy();
?>
