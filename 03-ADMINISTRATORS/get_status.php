<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "ntc_database");

if ($conn->connect_error) {
    die(json_encode(['error' => "Connection failed: " . $conn->connect_error]));
}

$gizmo = "gizmo"; 

$stmt = $conn->prepare("SELECT gizmo, status FROM gizmo_status WHERE gizmo = ?");
$stmt->bind_param("s", $gizmo);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $status = strtolower(trim($row['status']));
} else {
    $status = 'offline';
}

echo json_encode(['status' => $status]);

$stmt->close();
$conn->close();
?>