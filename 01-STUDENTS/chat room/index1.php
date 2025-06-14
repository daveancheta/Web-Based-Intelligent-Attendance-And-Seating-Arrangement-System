<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['room_name'])) {
    $room_name = trim($_POST['room_name']);
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : NULL;

    if (!empty($room_name)) {
        $stmt = $conn->prepare("INSERT INTO rooms (name, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $room_name, $password);
        $stmt->execute();
        $stmt->close();
    }

    // Redirect to prevent resubmission on refresh
    header("Location: index.php");
    exit();
}

$rooms = $conn->query("SELECT id, name, password FROM rooms ORDER BY created_at DESC");
?>