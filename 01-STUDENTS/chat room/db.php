<?php
$host = "localhost";
$user = "root"; // Change if you use a different username
$pass = ""; // Change if you have a MySQL password
$dbname = "ntc_database";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
