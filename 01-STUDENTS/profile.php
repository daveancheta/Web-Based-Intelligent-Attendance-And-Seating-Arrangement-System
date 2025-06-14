<?php
session_start([
    'cookie_secure' => true,
    'cookie_httponly' => true,
    'cookie_samesite' => 'Strict'
]);

if (!isset($_SESSION['student_number'])) {
    echo "<script>alert('Please log in first.'); window.location.href = '01-sign-in.php';</script>";
    exit();
}

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "ntc_database";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$student_number = $_SESSION['student_number'];

$stmt = $conn->prepare("SELECT first_name, surname, suffix, student_number, email, gender, birthdate, M_first_name, M_surname, M_suffix, M_email, M_contact_number, M_occupation, F_first_name, F_surname, F_suffix, F_email, F_contact_number, F_occupation, M_middle_name, F_middle_name, middle_name FROM data_student WHERE student_number = ? LIMIT 1");
$stmt->bind_param("s", $student_number);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
    $first_name = htmlspecialchars($user_data['first_name'], ENT_QUOTES, 'UTF-8');
    $middle_name = htmlspecialchars($user_data['middle_name'], ENT_QUOTES, 'UTF-8');
    $surname = htmlspecialchars($user_data['surname'], ENT_QUOTES, 'UTF-8');
    $suffix = htmlspecialchars($user_data['suffix'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($user_data['email'], ENT_QUOTES, 'UTF-8');
    $gender = htmlspecialchars($user_data['gender'], ENT_QUOTES, 'UTF-8');
    $birthdate = htmlspecialchars($user_data['birthdate'], ENT_QUOTES, 'UTF-8');
    $M_first_name = htmlspecialchars($user_data['M_first_name'], ENT_QUOTES, 'UTF-8');
    $M_middle_name = htmlspecialchars($user_data['M_middle_name'], ENT_QUOTES, 'UTF-8');
    $M_surname = htmlspecialchars($user_data['M_surname'], ENT_QUOTES, 'UTF-8');
    $M_suffix = htmlspecialchars($user_data['M_suffix'], ENT_QUOTES, 'UTF-8');
    $M_contact_number = htmlspecialchars($user_data['M_contact_number'], ENT_QUOTES, 'UTF-8');
    $M_occupation = htmlspecialchars($user_data['M_occupation'], ENT_QUOTES, 'UTF-8');
    $M_email = htmlspecialchars($user_data['M_email'], ENT_QUOTES, 'UTF-8');
    $F_first_name = htmlspecialchars($user_data['F_first_name'], ENT_QUOTES, 'UTF-8');
    $F_middle_name = htmlspecialchars($user_data['F_middle_name'], ENT_QUOTES, 'UTF-8');
    $F_surname = htmlspecialchars($user_data['F_surname'], ENT_QUOTES, 'UTF-8');
    $F_suffix = htmlspecialchars($user_data['F_suffix'], ENT_QUOTES, 'UTF-8');
    $F_contact_number = htmlspecialchars($user_data['F_contact_number'], ENT_QUOTES, 'UTF-8');
    $F_occupation = htmlspecialchars($user_data['F_occupation'], ENT_QUOTES, 'UTF-8');
    $F_email = htmlspecialchars($user_data['F_email'], ENT_QUOTES, 'UTF-8');
} else {
    $user_data = null;
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            font: 'Poppins', sans-serif;
            text-transform: uppercase;
        }

        .profile-container {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-header i {
            font-size: 80px;
            color: #160893;
        }

        .profile-header p {
            font-size: 20px;
            font-weight: bold;
        }

        .section-title {
            background: #160893;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 15px;
        }

        .info-box {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 15px;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .info-box p {
            margin: 5px 0;
            font-size: 16px;
        }

        .info-box strong {
            color: #160893;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php if ($user_data): ?>
            <div class="profile-container">
                <nav class="navbar bg-body-tertiary mb-5">
                    <div class="container-fluid d-flex justify-content-between align-items-center">
                        <!-- Logo and Text Container -->
                        <div class="d-flex align-items-center flex-wrap">
                            <a class="navbar-brand d-flex align-items-center" href="#">
                                <img src="image/ntc-logo-1.png" alt="Logo" style="height: 50px; width: 50px; margin-right: 10px;">
                            </a>
                        </div>

                        <!-- Navbar Toggler (Hamburger Menu) on the Right -->
                        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <!-- Navbar Links -->
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-align-center justify-content-center align-items-center">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">HOME</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">PROFILE</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">ATTENDANCE</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">CHAT ROOM</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">TEACHERS</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>



                <div class="profile-header">
                    <i class="fa-solid fa-circle-user"></i>
                    <p><?php echo $first_name . ' ' . $surname; ?></p>
                </div>

                <!---->
                <h3 class="section-title fs-5">Student Information</h3>
                <div class="info-box">
                    <p><strong>Surname:</strong> <?php echo $surname; ?></p>
                    <p><strong>First Name:</strong> <?php echo $first_name; ?></p>
                    <p><strong>Middle Name:</strong> <?php echo $middle_name; ?></p>
                    <p><strong>Suffix:</strong> <?php echo $suffix; ?></p>
                </div>

                <div class="info-box">
                    <p><strong>Student Number:</strong> <?php echo $student_number; ?></p>
                    <p><strong>Email Address:</strong> <?php echo $email; ?></p>
                    <p><strong>Gender:</strong> <?php echo $gender; ?></p>
                    <p><strong>Birthdate:</strong> <?php echo $birthdate; ?></p>
                </div>

                <h3 class="section-title fs-5">Parents Information</h3>
                <h4 class="text-dark">Mother's Information</h4>
                <div class="info-box">
                    <p><strong>Surname:</strong> <?php echo $M_surname; ?></p>
                    <p><strong>First Name:</strong> <?php echo $M_first_name; ?></p>
                    <p><strong>Middle Name:</strong> <?php echo $M_middle_name; ?></p>
                    <p><strong>Suffix:</strong> <?php echo $M_suffix; ?></p>
                </div>
                <div class="info-box">
                    <p><strong>Mobile Phone:</strong> <?php echo $M_contact_number; ?></p>
                    <p><strong>Occupation:</strong> <?php echo $M_occupation; ?></p>
                    <p><strong>Email Address:</strong> <?php echo $M_email; ?></p>
                </div>

                <h4 class="text-dark">Father's Information</h4>
                <div class="info-box">
                    <p><strong>Surname:</strong> <?php echo $F_surname; ?></p>
                    <p><strong>First Name:</strong> <?php echo $F_first_name; ?></p>
                    <p><strong>Middle Name:</strong> <?php echo $F_middle_name; ?></p>
                    <p><strong>Suffix:</strong> <?php echo $F_suffix; ?></p>
                </div>
                <div class="info-box">
                    <p><strong>Mobile Phone:</strong> <?php echo $F_contact_number; ?></p>
                    <p><strong>Occupation:</strong> <?php echo $F_occupation; ?></p>
                    <p><strong>Email Address:</strong> <?php echo $F_email; ?></p>
                </div>
            </div>
        <?php else: ?>
            <div class="container text-center mt-5">
                <p class="alert alert-danger">User data not found.</p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>