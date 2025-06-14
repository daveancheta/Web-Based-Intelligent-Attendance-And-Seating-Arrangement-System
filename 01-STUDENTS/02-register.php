<?php
$conn = mysqli_connect("localhost", "root", "", "ntc_database");

// Check connection
if (!$conn) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Student Information
    $profile_pic_status = isset($_POST['profile_pic_status']) ? mysqli_real_escape_string($conn, $_POST['profile_pic_status']) : "";
    $first_name = isset($_POST['first_name']) ? mysqli_real_escape_string($conn, $_POST['first_name']) : "";
    $middle_name = isset($_POST['middle_name']) ? mysqli_real_escape_string($conn, $_POST['middle_name']) : "";
    $surname = isset($_POST['surname']) ? mysqli_real_escape_string($conn, $_POST['surname']) : "";
    $suffix = isset($_POST['suffix']) ? mysqli_real_escape_string($conn, $_POST['suffix']) : "";
    $block_sec = isset($_POST['block_sec']) ? mysqli_real_escape_string($conn, $_POST['block_sec']) : "";
    $student_number = isset($_POST['student_number']) ? mysqli_real_escape_string($conn, $_POST['student_number']) : "";
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : "";
    $gender = isset($_POST['gender']) ? mysqli_real_escape_string($conn, $_POST['gender']) : "";
    $birthdate = isset($_POST['birthdate']) ? mysqli_real_escape_string($conn, $_POST['birthdate']) : "";
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : "";

    // Parents Information
    // Mother's Information
    $M_first_name = isset($_POST['M_first_name']) ? mysqli_real_escape_string($conn, $_POST['M_first_name']) : "";
    $M_middle_name = isset($_POST['M_middle_name']) ? mysqli_real_escape_string($conn, $_POST['M_middle_name']) : "";
    $M_surname = isset($_POST['M_surname']) ? mysqli_real_escape_string($conn, $_POST['M_surname']) : "";
    $M_suffix = isset($_POST['M_suffix']) ? mysqli_real_escape_string($conn, $_POST['M_suffix']) : "";
    // Contact Information
    $M_email = isset($_POST['M_email']) ? mysqli_real_escape_string($conn, $_POST['M_email']) : "";
    $M_contact_number = isset($_POST['M_contact_number']) ? mysqli_real_escape_string($conn, $_POST['M_contact_number']) : "";
    $M_occupation = isset($_POST['M_occupation']) ? mysqli_real_escape_string($conn, $_POST['M_occupation']) : "";

    // Father's Information
    $F_first_name = isset($_POST['F_first_name']) ? mysqli_real_escape_string($conn, $_POST['F_first_name']) : "";
    $F_middle_name = isset($_POST['F_middle_name']) ? mysqli_real_escape_string($conn, $_POST['F_middle_name']) : "";
    $F_surname = isset($_POST['F_surname']) ? mysqli_real_escape_string($conn, $_POST['F_surname']) : "";
    $F_suffix = isset($_POST['F_suffix']) ? mysqli_real_escape_string($conn, $_POST['F_suffix']) : "";
    // Contact Information
    $F_email = isset($_POST['F_email']) ? mysqli_real_escape_string($conn, $_POST['F_email']) : "";
    $F_contact_number = isset($_POST['F_contact_number']) ? mysqli_real_escape_string($conn, $_POST['F_contact_number']) : "";
    $F_occupation = isset($_POST['F_occupation']) ? mysqli_real_escape_string($conn, $_POST['F_occupation']) : "";

    $insert_query = "INSERT IGNORE INTO dat (email, password) VALUES (?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();


    // Check if student_number already exists
    $check_query = "SELECT * FROM data_student WHERE student_number = '$student_number'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        // If student number exists, show alert
        echo "<script>alert('Error: Student number already exists.');</script>";
    } else {
        // Insert Query 
        $sql = "INSERT INTO data_student 
    (profile_pic_status, first_name, surname, suffix, student_number, email, gender, birthdate, password, M_first_name, M_surname, M_suffix, M_email, M_contact_number, M_occupation, F_first_name, F_surname, F_suffix, F_email, F_contact_number, F_occupation, M_middle_name, F_middle_name, middle_name, block_sec) 
    VALUES 
    ('$profile_pic_status', '$first_name', '$surname', '$suffix', '$student_number', '$email', '$gender', '$birthdate', '$password', 
     '$M_first_name', '$M_surname', '$M_suffix', '$M_email', '$M_contact_number', '$M_occupation', 
     '$F_first_name', '$F_surname', '$F_suffix', '$F_email', '$F_contact_number', '$F_occupation', '$F_middle_name' , '$M_middle_name', '$middle_name', '$block_sec')";

        // Execute Query
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Registration successful! Your default password has been sent to your email.');</script>";

           
        } else {
            echo "<script>alert('Error: Unable to add records.');</script>";
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
        $email = $_POST['email'];


        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $_SERVER['EMAIL_USER'];
            $mail->Password = $_SERVER['EMAIL_PASS'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;


            $mail->setFrom('ntcnoreplyignore@gmail.com', 'National Teachers College');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Registration Successful';

            $mail->Body = '
<div style="font-family: Arial, sans-serif; color: #333; font-size: 15px;">
    <h2 style="color: #2c3e50;">Welcome to the Platform!</h2>
    <p>We are glad to inform you that your registration was successful.</p>
    
    <p>
        <strong>Your default password:</strong>
        <span style="color: #d35400;">abc123</span>
    </p>
    
    <p><strong>Chat room passwords:</strong></p>
    <ul style="color: #2980b9; padding-left: 20px; margin: 0;">
        <li>2.1: 123</li>
        <li>2.2: 456</li>
        <li>2.3: 789</li>
        <li>2.4: 098</li>
        <li>2.5: 765</li>
    </ul>

    <hr style="margin: 20px 0;">
    
    <p style="font-size: 13px; color: #777;">
        Please change your password after logging in for security purposes.
    </p>
</div>
';




            $mail->send();
        } catch (Exception $email) {
        }
    }
     header("Location:" . $_SERVER['PHP_SELF'] . "");
            exit();
}
// Close Connection
mysqli_close($conn);




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Winky+Sans:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/png" href="image/ntc-logo-1.png">
</head>

<body class="container py-4">

    <div class="d-flex align-items-center ms-0">
        <img src="image/ntc-logo.png" alt="NTC Logo" class="me-3 img-fluid mt-0 mb-5" width="75" height="175">
        <h3 class="fs-4 text-start mt-0 mb-5" style="width: 60%;  font-family: 'Winky Sans', sans-serif; color: #160893;"><a href="03-can't-sign-in.php" style="color: inherit; text-decoration: none;">National Teachers College</a></h3>
    </div>

    <h3 class="fs-4 mb-3">STUDENT INFORMATION</h3>

    <form method="POST" action="">
        <input type="hidden" name="profile_pic_status" id="profile_pic_status" value="add">
        <div class="row g-3">
            <div class="col-12 col-md-6 col-lg-3">

                <div class="form-floating">
                    <input class="form-control" type="text" id="surname" name="surname" placeholder="SURNAME" required autocomplete="off" style="text-transform: uppercase;">
                    <label>SURNAME</label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="form-floating">
                    <input class="form-control" type="text" id="first_name" name="first_name" placeholder="FIRST NAME" required autocomplete="off" style="text-transform: uppercase;">
                    <label>FIRST NAME</label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="form-floating">
                    <input class="form-control" type="text" id="middle_name" name="middle_name" placeholder="MIDDLE NAME" required autocomplete="off" style="text-transform: uppercase;">
                    <label>MIDDLE NAME</label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 form-floating">
                <select class="form-select" id="suffix" name="suffix" required autocomplete="off" style="text-transform: uppercase;">
                    <option selected disabled>SELECT SUFFIX</option>
                    <option value="N/A">N/A</option>
                    <option value="Jr.">Jr.</option>
                    <option value="Sr">Sr.</option>
                    <option value="II">II</option>
                    <option value="III">III</option>
                </select>
            </div>
        </div>

        <div class="row g-3 mt-3">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="form-floating">
                    <input class="form-control" type="number" id="student_number" name="student_number" placeholder="STUDENT NUMBER" required autocomplete="off" style="text-transform: uppercase;">
                    <label>STUDENT NUMBER</label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="form-floating">
                    <input class="form-control" type="email" id="email" name="email" placeholder="EMAIL ADDRESS" required autocomplete="off" style="text-transform: uppercase;">
                    <label>EMAIL ADDRESS</label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="form-floating">
                    <input class="form-control" type="date" id="birthdate" name="birthdate" required autocomplete="off" style="text-transform: uppercase;">
                    <label>BIRTHDATE</label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 form-floating">
                <select class="form-select" id="gender" name="gender" required autocomplete="off" style="text-transform: uppercase;">
                    <option selected disabled>SELECT GENDER</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
        </div>

        <h3 class="fs-4 mt-5">PARENTS INFORMATION</h3>

        <h4 class="fs-5 mt-3">MOTHER'S INFORMATION</h4>

        <div class="row g-3">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="form-floating">
                    <input class="form-control" type="text" id="M_surname" name="M_surname" placeholder="SURNAME" required autocomplete="off" style="text-transform: uppercase;">
                    <label>SURNAME</label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="form-floating">
                    <input class="form-control" type="text" id="M_first_name" name="M_first_name" placeholder="FIRST NAME" required autocomplete="off" style="text-transform: uppercase;">
                    <label>FIRST NAME</label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="form-floating">
                    <input class="form-control" type="text" id="M_middle_name" name="M_middle_name" placeholder="MIDDLE NAME" required autocomplete="off" style="text-transform: uppercase;">
                    <label>MIDDLE NAME</label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 form-floating">
                <select class="form-select" id="M_suffix" name="M_suffix" required autocomplete="off" style="text-transform: uppercase;">
                    <option selected disabled>SELECT SUFFIX</option>
                    <option value="N/A">N/A</option>
                    <option value="Jr.">Jr.</option>
                    <option value="Sr">Sr.</option>
                    <option value="II">II</option>
                    <option value="III">III</option>
                </select>
            </div>
        </div>


        <div class="row g-3 mt-3">
            <div class="col-md-4">
                <div class="form-floating">
                    <input class="form-control" type="number" id="M_contact_number" name="M_contact_number" placeholder="CONTACT NUMBER" required autocomplete="off" style="text-transform: uppercase;">
                    <label>CONTACT NUMBER</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input class="form-control" type="email" id="M_email" name="M_email" placeholder="EMAIL ADDRESS" required autocomplete="off" style="text-transform: uppercase;">
                    <label>EMAIL ADDRESS</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input class="form-control" type="text" id="M_occupation" name="M_occupation" placeholder="OCCUPATION" required autocomplete="off" style="text-transform: uppercase;">
                    <label>OCCUPATION</label>
                </div>
            </div>
        </div>

        <h4 class="fs-5 mt-5">FATHER'S INFORMATION</h4>

        <div class="row g-3">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="form-floating">
                    <input class="form-control" type="text" id="F_surname" name="F_surname" placeholder="SURNAME" required autocomplete="off" style="text-transform: uppercase;">
                    <label>SURNAME</label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="form-floating">
                    <input class="form-control" type="text" id="F_first_name" name="F_first_name" placeholder="FIRST NAME" required autocomplete="off" style="text-transform: uppercase;">
                    <label>FIRST NAME</label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="form-floating">
                    <input class="form-control" type="text" id="F_middle_name" name="F_middle_name" placeholder="MIDDLE NAME" required autocomplete="off" style="text-transform: uppercase;">
                    <label>MIDDLE NAME</label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 form-floating">
                <select class="form-select" id="F_suffix" name="F_suffix" required autocomplete="off" style="text-transform: uppercase;">
                    <option selected disabled>SELECT SUFFIX</option>
                    <option value="N/A">N/A</option>
                    <option value="Jr.">Jr.</option>
                    <option value="Sr">Sr.</option>
                    <option value="II">II</option>
                    <option value="III">III</option>
                </select>
            </div>
        </div>

        <div class="row g-3 mt-3">
            <div class="col-md-4">
                <div class="form-floating">
                    <input class="form-control" type="number" placeholder="CONTACT NUMBER" id="F_contact_number" name="F_contact_number" required autocomplete="off" style="text-transform: uppercase;">
                    <label>CONTACT NUMBER</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input class="form-control" type="email" placeholder="EMAIL ADDRESS" id="F_email" name="F_email" required autocomplete="off" style="text-transform: uppercase;">
                    <label>EMAIL ADDRESS</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input class="form-control" type="text" placeholder="OCCUPATION" id="F_occupation" name="F_occupation" required autocomplete="off" style="text-transform: uppercase;">
                    <label>OCCUPATION</label>
                </div>
            </div>
        </div>

        </div>
        <input type="password" id="password" name="password" placeholder="PASSWORD" required autocomplete="off" style="text-transform: uppercase; display: none;" value="abc123">

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">ARE YOU SURE?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Check your inputted information before you submit it.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CLOSE</button>
                        <button type="submit" class="btn" style="background-color: #160893; color: white;">SUBMIT</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="justify-content-center align-items-center d-flex">
        <button class="btn btn-color mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal">FINALIZED</button>

</body>

</html>