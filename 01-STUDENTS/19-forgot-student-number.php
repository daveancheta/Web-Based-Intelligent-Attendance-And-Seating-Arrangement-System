<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ntc_database";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("<div class='alert alert-danger'>Database connection failed: " . $conn->connect_error . "</div>");
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = trim($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $entervalid = "Please enter a valid email address.";
    } else {
        $sql = "SELECT email, student_number FROM data_student WHERE email = ? LIMIT 1";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            echo "<div class='alert alert-danger'>Database error: " . $conn->error . "</div>";
        } else {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $student_number = $row['student_number'];

                $mail = new PHPMailer(true);

                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = $_SERVER['EMAIL_USER'] ?? 'default@email.com'; 
                    $mail->Password = $_SERVER['EMAIL_PASS'] ?? 'defaultpassword';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;
                    $mail->SMTPDebug = 0; 

                    $mail->setFrom($_SERVER['EMAIL_USER'], 'National Teachers College');
                    $mail->addAddress($email);

                    $mail->isHTML(true);
                    $mail->Subject = 'Your Student No. - National Teachers College';
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
                                <p>Here is your forgotten password:</p>
                                <p style="font-size: 24px; font-weight: bold; color: #272bae;">' . $student_number . '</p>
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
            $stmt->close();
        }
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student No. Recovery</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Winky+Sans:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="image/ntc-logo-1.png">

    <style>
        .ntc {
            font-family: "Winky Sans", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
            color: #160893;
        }

        body,
        html {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        .container-fluid {
            position: relative;
            height: 100vh;
            background: url('image/ntc.jpg') no-repeat center center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-container {
            width: 400px;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .form-container img {
            width: 75px;
            height: auto;
            margin-bottom: 10px;
        }

        .form-floating input {
            font-size: 1rem;
            padding: 10px;
        }

        .btn-color {
            background-color: #160893;
            color: white;
            padding: 10px 30px;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            width: 100%;
        }

        .csi,
        .ptc {
            font-size: 0.9rem;
        }

        .csi a,
        .ptc a {
            text-decoration: none;
        }

        .s-number:focus {
            border-color: #000000 !important;
            border-width: 2px !important;
            box-shadow: none !important;
        }

        .form-floating input {
            border-color: #000000 !important;
            border-width: 2px !important;
            box-shadow: none !important;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-color: black;
            opacity: 0.4;
            z-index: 1;
        }
        .form-container {
            position: relative;
            z-index: 2;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-container {
                width: 90%;
                padding: 1.5rem;
            }

            .form-floating input {
                font-size: 0.9rem;
                padding: 8px;
            }

            .btn-color {
                padding: 8px 20px;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .form-container {
                width: 95%;
                padding: 1.2rem;
            }

            .form-floating input {
                font-size: 0.8rem;
                padding: 7px;
            }

            .btn-color {
                font-size: 0.85rem;
                padding: 7px 15px;
            }
        }
    </style>
</head>

<body>

    <div class="container-fluid">
    <div class="overlay"></div>
        <div class="form-container">
            <img src="image/ntc-logo.png" alt="NTC Logo">
            <h3 class="fs-4 ntc">National Teachers College</h3>
            <h2 class="fs-5 mt-3 mb-3">Student No. Recovery</h2>

            <form method="POST" action="">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($sent)): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sent; ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($notsent)): ?>
                    <div class="alert alert-warning" role="alert">
                        <?php echo $notsent; ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($errorsending)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $errorsending; ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($noaccount)): ?>
                    <div class="alert alert-warning" role="alert">
                        <?php echo $noaccount; ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($entervalid)): ?>
                    <div class="alert alert-warning" role="alert">
                        <?php echo $entervalid; ?>
                    </div>
                <?php endif; ?>

                <div class="form-floating mb-4">
                    <input class="form-control s-number" type="email" id="email" name="email" placeholder="EMAIL ADDRESS" required autocomplete="off">
                    <label for="email">EMAIL ADDRESS</label>
                </div>

                <button class="btn-color mt-3 mb-4" type="submit" name="submit">Recover Student No.</button>
            </form>

            <div>
                <div class="csi"><a href="01-sign-in.php" style="color: inherit; text-decoration: none;"><strong> BACK TO SIGN IN</strong></a></div>
                <div class="ptc mt-2">
                    <span><a href="footer-links/privacy-policy.php" style="color: inherit; text-decoration: none;">Privacy Policy</a></span> |
                    <span><a href="footer-links/term-of-use.php" style="color: inherit; text-decoration: none;">Terms of Use</a></span> |
                    <span><a href="bot-assistant/gizmo.php" style="color: inherit; text-decoration: none;">Support</a></span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Redirect on page refresh
        if (performance.navigation.type == 1) {
            window.location.href = '19-forgot-student-number.php';
        }
    </script>
</body>

</html>