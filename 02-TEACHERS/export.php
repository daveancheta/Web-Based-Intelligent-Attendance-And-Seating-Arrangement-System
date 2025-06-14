<?php
session_start(); // Fix 1

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// DB connection
$host = "localhost";
$user = "root";
$pass = "";
$db = "ntc_database";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fullname = $_SESSION['fullname'];
$selected_subject = $_SESSION['selected_subject'];

// Fix 2: Correct SQL query
$sql = "SELECT * FROM info_ass WHERE professor = '$fullname' AND subject = '$selected_subject'";
$result = $conn->query($sql);

// Check if query was successful
if (!$result) {
    die("Query error: " . $conn->error);
}

// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set header columns
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Student Number');
$sheet->setCellValue('C1', 'Student Name');
$sheet->setCellValue('D1', 'Subject');
$sheet->setCellValue('E1', 'Time In');
$sheet->setCellValue('F1', 'Block');
$sheet->setCellValue('G1', 'Date');
$sheet->setCellValue('H1', 'Attendance Mark');

// Fill data
$rowNum = 2;
while ($row = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $rowNum, $row['id'] ?: 'No Data');
    $sheet->setCellValue('B' . $rowNum, $row['student_number'] ?: 'No Data');
    $sheet->setCellValue('C' . $rowNum, $row['student_name'] ?: 'No Data');
    $sheet->setCellValue('D' . $rowNum, $row['subject'] ?: 'No Data');
    $sheet->setCellValue('E' . $rowNum, $row['timein'] ?: 'No Data');
    $sheet->setCellValue('F' . $rowNum, $row['block'] ?: 'No Data');
    $sheet->setCellValue('G' . $rowNum, $row['date'] ?: 'No Data');
    $sheet->setCellValue('H' . $rowNum, $row['status'] ?: 'Absent');
    $rowNum++;
}


// Auto size columns
foreach (range('A', 'I') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Output to browser
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="attendance_for_today.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
