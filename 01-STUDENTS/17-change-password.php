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

$stmt = $conn->prepare("SELECT student_number, password FROM data_student WHERE student_number = ? LIMIT 1");
$stmt->bind_param("s", $student_number);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
    $student_number = htmlspecialchars($user_data['student_number'], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($user_data['password'], ENT_QUOTES, 'UTF-8');
} else {
    $user_data = null;
}

if (isset($_POST['submit'])) {
    $newPassword = $_POST['password'];

    $query = "UPDATE data_student SET password = ? WHERE student_number = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $newPassword, $student_number);
    $result = $stmt->execute();

    if ($result) {
        echo "<script>alert('Password Changed Successfully!'); window.location.href = '06-profile.php';</script>";
    } else {
        $error = "Error changing password: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Poppins&family=Winky+Sans:wght@300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/png" href="image/ntc-logo-1.png">
    <style>
        .ntc {
            font-family: "Winky Sans", sans-serif;
            color: #160893;
        }

        body, html {
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

        @media (max-width: 768px) {
            .form-container { width: 90%; padding: 1.5rem; }
            .btn-color { font-size: 0.9rem; padding: 8px 20px; }
        }

        @media (max-width: 480px) {
            .form-container { width: 95%; padding: 1.2rem; }
            .btn-color { font-size: 0.85rem; padding: 7px 15px; }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="form-container">
            <img src="image/ntc-logo.png" alt="NTC Logo">
            <h3 class="fs-4 ntc">National Teachers College</h3>
            <h2 class="fs-5 mt-3 mb-3">Change Password</h2>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-floating mb-3">
                    <input class="form-control" type="text" name="user_name" id="user_name" value="<?php echo $student_number; ?>" readonly>
                    <label for="user_name">Student Number</label>
                </div>

                <div class="form-floating mb-4">
                    <input class="form-control" type="text" name="password" id="password" placeholder="New Password" required>
                    <label for="password">New Password</label>
                </div>

                <button class="btn-color mt-3 mb-4" type="submit" name="submit">Update Password</button>
            </form>
        </div>
    </div>
</body>
</html>
