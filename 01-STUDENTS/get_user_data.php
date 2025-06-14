<?php
session_start(); // Important: Start the session
header('Content-Type: application/json'); // Set JSON response header

$host = "localhost"; 
$user = "root";
$pass = "";
$dbname = "ntc_database";

$conn = new mysqli($host, $user, $pass, $dbname);

// Check if the connection fails
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]);
    exit();
}

// Check if 'password' is provided in the request
if (!isset($_GET['password'])) {
    echo json_encode(["success" => false, "message" => "No password provided."]);
    exit();
}

$password = $conn->real_escape_string($_GET['password']); // Prevent SQL injection

// Get subject from GET parameter or session
$subject = isset($_GET['subject']) ? $conn->real_escape_string($_GET['subject']) : null;

// If no subject was passed via GET, try to get it from session
if (!$subject && isset($_SESSION['subject'])) {
    $subject = $conn->real_escape_string($_SESSION['subject']);
}

// Debug logging to check what data we're working with
$debug = [
    "password" => $password,
    "subject" => $subject
];

// Fetch user data from the database
$sql = "SELECT * FROM room_101 WHERE password = '$password'";
if ($subject) {
    $sql .= " AND subject = '$subject'";
}

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo json_encode(["success" => true, "data" => $user, "debug" => $debug]);
} else {
    echo json_encode([
        "success" => false, 
        "message" => "Invalid credentials or you cannot access this room.",
        "query" => $sql,
        "debug" => $debug
    ]);
}

$conn->close();
?>