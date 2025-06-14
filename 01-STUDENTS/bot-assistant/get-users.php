<?php
// Enable error reporting (for debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set the content type to JSON
header('Content-Type: application/json');

// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "ntc_database");

// Check for connection error
if ($conn->connect_error) {
    die(json_encode([
        "message" => "Database connection failed.",
        "link" => null
    ]));
}

// Check if concern is provided
if (isset($_GET['concern'])) {
    $concern = $conn->real_escape_string($_GET['concern']);

    // Query to fetch response and link
    $sql = "SELECT concern, response, link FROM bot_assistant WHERE concern = '$concern'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Convert newlines to <br> and sanitize output
        $response = nl2br(htmlspecialchars($row["response"], ENT_QUOTES, 'UTF-8'));
        $link = trim($row["link"]);

        echo json_encode([
            "message" => $response,
            "link" => $link !== "" ? htmlspecialchars($link, ENT_QUOTES, 'UTF-8') : null
        ]);
    } else {
        echo json_encode([
            "message" => "I can't help you with your concern right now. Please try again later.",
            "link" => null
        ]);
    }
}

$conn->close();
?>
