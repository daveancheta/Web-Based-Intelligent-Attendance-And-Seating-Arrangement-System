<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ntc_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $student_number = $_POST['s-number'];
    $password = $_POST['password'];

    $_SESSION['student_number'] = $student_number;

    // First check if student number exists
    $check_student = "SELECT * FROM data_student WHERE student_number = '$student_number'";
    $student_result = mysqli_query($conn, $check_student);

    if (mysqli_num_rows($student_result) > 0) {
        $student_data = mysqli_fetch_assoc($student_result); // Get the student data

        // Student exists, now check password
        $check_password = "SELECT * FROM data_student WHERE student_number = '$student_number' AND password = '$password'";
        $password_result = mysqli_query($conn, $check_password);

        if (mysqli_num_rows($password_result) > 0) {
            // Both student number and password are correct
            $_SESSION['student_number'] = $student_number;
            $_SESSION['first_name'] = $student_data['first_name'];
            $_SESSION['middle_name'] = $student_data['middle_name'];
            $_SESSION['surname'] = $student_data['surname'];
            $_SESSION['F_email'] = $student_data['F_email'];
            $_SESSION['M_email'] = $student_data['M_email'];
           
            $success = "Login successful! Redirecting to home page.";
            header("Location: 04-home.php");
            exit();
        } else {
            // Student exists but password is wrong
            $error = "Incorrect password. Please try again.";
        }
    } else {
        // Student number doesn't exist
        $error = "Student number not found.";
    }
}

$id = 1;

$stmt = $conn->prepare("SELECT status FROM system_status WHERE id = ?");
$stmt->bind_param("i", $id); // assuming 'id' is an integer
$stmt->execute();
$result1 = $stmt->get_result();

if ($result1 && $result1->num_rows > 0) {
    $row = $result1->fetch_assoc();
    $status = strtolower(trim($row['status']));
} else {
    $status = 'online';
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Winky+Sans:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css\style.css">
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
            font: 'Poppins', sans-serif;
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
            background-color: #007bff;
            color: white;
            padding: 10px 30px;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            width: 100%;
        }

        .btn-color:hover {
            background-color: #0056b3;
        }

        .csi,
        .ptc {
            font-size: 0.9rem;
        }

        .csi a,
        .ptc a {
            text-decoration: none;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-color: black;
            opacity: 0.6;
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
    <?php if ($status === 'offline'): ?>
        <div class="maintenance-container d-flex flex-column justify-content-center align-items-center text-white" style="height: 100%; width: 100%; background-color: #160893; font-family: 'Poppins', sans-serif; text-align: center; padding: 20px;">
            <h3 class="display-5">Our system is currently undergoing maintenance.</h3>
            <p class="lead">Please check back in 2–3 days. Thank you for your patience!</p>
        </div>
    <?php else: ?>

        <div class="container-fluid">
            <div class="overlay"></div>
            <div class="form-container">
                <img src="image/ntc-logo.png" alt="NTC Logo">
                <h3 class="fs-4 ntc">National Teachers College</h3>
                <h2 class="fs-5 mt-3 mb-3">Sign in</h2>

                <form method="POST" action="">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Add this success message section (optional) -->
                    <?php if (isset($success)): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $success; ?>
                        </div>
                    <?php endif; ?>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" id="s-number" name="s-number" placeholder="STUDENT NUMBER" required autocomplete="off" value="<?php echo htmlspecialchars($_SESSION['student_number'] ?? ''); ?>">
                        <label for="s-number">STUDENT NUMBER</label>
                    </div>

                    <div class="form-floating mb-4 text-start">
                        <input class="form-control" type="password" id="password" name="password" placeholder="PASSWORD" required autocomplete="off">
                        <label for="password">PASSWORD</label>

                        <input type="checkbox" onclick="document.getElementById('password').type = this.checked ? 'text' : 'password'" class="mt-2">
                        Show Password
                    </div>

                    <button class="btn-color mt-3 mb-4" type="submit" name="submit">Sign in</button>
                </form>

                <div>
                    <div class="csi"><a href="03-can't-sign-in.php">CAN'T SIGN IN?</a></div>
                    <div class="ptc mt-2">
                        <span><a href="footer-links\privacy-policy.php">Privacy Policy</a></span> |
                        <span><a href="footer-links\term-of-use.php">Terms of Use</a></span> |
                        <span><a href="bot-assistant\gizmo.php">Support</a></span>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</body>

</html>