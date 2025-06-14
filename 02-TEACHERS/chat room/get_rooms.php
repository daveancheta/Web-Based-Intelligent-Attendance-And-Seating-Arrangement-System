<?php
require 'db.php';

$result = $conn->query("SELECT * FROM rooms ORDER BY created_at DESC");
$rooms = [];

while ($row = $result->fetch_assoc()) {
    $rooms[] = $row;
}

echo json_encode($rooms);
$conn->close();
?>
