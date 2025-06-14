<?php
// Load PHPMailer classes properly at the top
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// DB connection
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "ntc_database";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize POST data
    $student_number = mysqli_real_escape_string($conn, $_POST['student_number'] ?? '');
    $block = mysqli_real_escape_string($conn, $_POST['block'] ?? '');
    $datentime = mysqli_real_escape_string($conn, $_POST['datentime'] ?? '');
    $subject = mysqli_real_escape_string($conn, $_POST['subject'] ?? '');
    $timein = mysqli_real_escape_string($conn, $_POST['timein'] ?? '');
    $email1 = mysqli_real_escape_string($conn, $_POST['email1'] ?? '');
    $email2 = mysqli_real_escape_string($conn, $_POST['email2'] ?? '');
    $status = mysqli_real_escape_string($conn, $_POST['status'] ?? '');

    $sql = "UPDATE info_ass SET 
    timein = '$timein',
    date = '$datentime',
    M_email = '$email1',
    F_email = '$email2',
    status = '$status'
WHERE student_number = '$student_number' AND subject = '$subject'";


    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Attendance Done!'); window.location.href = '15-room-sched.php';</script>";

        // Now send email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $_SERVER['EMAIL_USER']; // Must be set in your environment
            $mail->Password = $_SERVER['EMAIL_PASS']; // Must be set in your environment
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('ntcnoreplyignore@gmail.com', 'National Teachers College');
            $mail->addAddress($email1);
            $mail->addAddress($email2);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Class Attendance Report | ' . $subject . ' | ' . $block;
            $mail->Body = '
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; text-align: center; }
            .profile-img { 
                width: 100px; 
                height: 100px; 
                border-radius: 50%; 
                object-fit: cover;
                margin-bottom: 15px;
            }
            .info-box {
                background: #f8f9fa;
                padding: 20px;
                border-radius: 8px;
                margin-top: 15px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <img src="https://upload.wikimedia.org/wikipedia/en/7/72/National_Teachers_College_logo.png" class="profile-img" alt="College Logo">
            <h2 style="color: #272bae;">National Teachers College</h2>
            <div class="info-box">
                <p>Your son/daughter is now in their class. Time in:</p>
                <p style="font-size: 24px; font-weight: bold; color: #272bae;">' . $timein . '</p>
                <p style="margin-top: 20px; font-size: 12px; color: #777;">
                    This is an automated message. Please do not reply.
                </p>
            </div>
        </div>
    </body>
    </html>';

            if ($mail->send()) {
                $sent =  "The email has been sent. Please check your inbox or spam folder.";
            } else {
                $notsent =  "Email could not be sent. Please try again later.";
            }
        } catch (Exception $e) {
            $errorsending =  "Error sending email: " . htmlspecialchars($mail->ErrorInfo) . "";
        }
    } else {
        $noaccount =  "No account found with that email address.";
    }
}

$conn->close();
