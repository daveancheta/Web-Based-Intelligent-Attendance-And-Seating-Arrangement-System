<?php
require 'vendor/autoload.php'; // Make sure this path is correct

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

$student_number = $_SESSION['teacher_email'];

// Fetch data
$sql = "SELECT * FROM attendance_present";
$result = $conn->query($sql);

// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set header columns
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Student Number');
$sheet->setCellValue('C1', 'Subject');
$sheet->setCellValue('D1', 'Time In');
$sheet->setCellValue('E1', 'Block');
$sheet->setCellValue('F1', 'Date');
$sheet->setCellValue('G1', 'Mother Email');
$sheet->setCellValue('H1', 'Father Email');
$sheet->setCellValue('I1', 'Attendance Mark');

// Fill data
$rowNum = 2; // Start from second row (after header)
while ($row = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $rowNum, $row['id']);
    $sheet->setCellValue('B' . $rowNum, $row['student_number']);
    $sheet->setCellValue('C' . $rowNum, $row['subject']);
    $sheet->setCellValue('D' . $rowNum, $row['class_time']);
    $sheet->setCellValue('E' . $rowNum, $row['block']);
    $sheet->setCellValue('F' . $rowNum, $row['date']);
    $sheet->setCellValue('G' . $rowNum, $row['M_email']);
    $sheet->setCellValue('H' . $rowNum, $row['F_email']);
    $sheet->setCellValue('I' . $rowNum, $row['status']);
    $rowNum++;
}

// Auto size columns for content
foreach (range('A', 'I') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Output to browser for download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="attendance_for_today.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
