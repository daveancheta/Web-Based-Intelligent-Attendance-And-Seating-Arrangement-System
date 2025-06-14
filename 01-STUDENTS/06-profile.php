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

$stmt = $conn->prepare("SELECT first_name, surname, suffix, student_number, email, gender, birthdate, M_first_name, M_surname, M_suffix, M_email, M_contact_number, M_occupation, F_first_name, F_surname, F_suffix, F_email, F_contact_number, F_occupation, M_middle_name, F_middle_name, middle_name, image_path, profile_pic_status FROM data_student WHERE student_number = ? LIMIT 1");

$stmt->bind_param("s", $student_number);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
    $first_name = htmlspecialchars($user_data['first_name'], ENT_QUOTES, 'UTF-8');
    $middle_name = htmlspecialchars($user_data['middle_name'], ENT_QUOTES, 'UTF-8');
    $surname = htmlspecialchars($user_data['surname'], ENT_QUOTES, 'UTF-8');
    $suffix = htmlspecialchars($user_data['suffix'], ENT_QUOTES, 'UTF-8');
    $image_path = htmlspecialchars($user_data['image_path'], ENT_QUOTES, 'UTF-8');
    $profile_pic_status = htmlspecialchars($user_data['profile_pic_status'], ENT_QUOTES, 'UTF-8');
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

$stmt2 = $conn->prepare("
    SELECT subject, class_time, class_days, room, professor, block, seat_number 
    FROM info_ass 
    WHERE student_number = ?
");
$stmt2->bind_param("s", $student_number);
$stmt2->execute();
$result2 = $stmt2->get_result();

$class_info = [];
while ($row = $result2->fetch_assoc()) {
    $class_info[] = $row;
}


if (isset($_POST['submit'])) {

    $profile_pic_status = $_POST['edit']; 

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $upload_dir = "uploads/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $new_filename = uniqid() . '.' . $file_extension;
        $file_path = $upload_dir . $new_filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {
            $query = "UPDATE data_student SET image_path = ?, profile_pic_status = ? WHERE student_number = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sss", $file_path, $profile_pic_status, $student_number);
            $result = $stmt->execute();

            if ($result) {
                echo "<script>alert('Image uploaded successfully'); window.location.href = '06-profile.php' ;</script>";
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "Error uploading file";
        }
    }
}


$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/png" href="image/ntc-logo-1.png">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #212529;
            padding-left: 250px;
            transition: padding-left 0.3s ease;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #001f3f;
            padding-top: 60px;
            z-index: 1050;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 14px 24px;
            display: block;
            font-weight: 500;
        }

        .sidebar a:hover {
            background-color: #ffffff;
            color: #001f3f;
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 24px;
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        .main-content {
            padding: 40px;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-header img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .info-box {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .section-title {
            font-weight: 600;
            color: #343a40;
            margin-bottom: 15px;
        }

        .mobile-navbar {
            display: none;
        }

        .logout {
            cursor: pointer;
            border: none;
        }

        .logout:hover {
            cursor: pointer;
            background-color: rgb(159, 0, 0);
        }

        .profile-button {
            cursor: pointer;
            background-color: rgb(255, 166, 0);
            color: black;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .profile-button:hover {
            cursor: pointer;
            background-color: rgba(255, 120, 0);
        }


        @media (max-width: 768px) {
    body {
        padding-left: 0;
    }

    .sidebar {
        transform: translateX(250px); 
        right: 0; 
        left: auto; 
        transition: transform 0.3s ease;
        position: fixed; 
        top: 0;
        height: 100%;
        width: 250px;
        background-color: #001f3f; 
        z-index: 1050;
    }

    .sidebar.active {
        transform: translateX(0); 
    }

    .mobile-navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #001f3f;
        color: white;
        padding: 10px 20px;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1060;
    }

    .main-content {
        margin-top: 70px;
        padding: 20px;
    }

    .profile-button:hover {
        cursor: pointer;
        background-color: rgb(255, 166, 0);
        color: black;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
    }
    .nbsp {
        display: none;
    }
}

    </style>
</head>

<body>

    <div class="mobile-navbar" style="user-select: none;">
        <div class="brand"> <i class="bi bi-person-circle me-1"></i>Student Profile</div>
        <button id="toggleSidebar">&#9776;</button>
    </div>

    <div class="sidebar d-flex flex-column justify-content-between text-center" id="sidebar">
        <div>
            <div class="navbar-brand text-light nbsp" style="user-select: none;">
                <i class="bi bi-person-circle"></i>
                Student Profile
            </div>
            <a class="mt-5" href="04-home.php">Home</a>
            <a class="mt-3" href="05-attendance.php">Attendance</a>
            <a class="mt-3" onclick="window.location.href='chat room/index.php';" style="cursor: pointer;" >Chat Room</a>
            <a class="mt-3 mb-5" href="16-teachers.php">Teacher</a>

        </div>
        <a class="mt-5" href="17-change-password.php">Change Password</a>

        <div class="mb-5 d-flex flex-column justify-content-center align-items-center">
            <button onclick="window.location.href='logout.php'" class="btn btn-danger logout">Logout</button>
        </div>
    </div>


    <div class="main-content container">
        <?php if ($user_data): ?>
            <div class="profile-header">
                <img src="<?php echo $image_path; ?>" alt="">
                <form method="post" enctype="multipart/form-data" class="d-flex justify-content-center align-items-center gap-2 mt-2">
                    <input type="hidden" name="edit" value="edit" accept="image/*">

                    <div class="modal fade mt-5" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <?php if ($profile_pic_status === 'add'): ?>
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Profile Picture</h1>
                                    <?php else: ?>
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile Picture</h1>
                                    <?php endif; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="edit" value="edit">
                                    <input type="file" name="image" class="form-control form-control-sm w-50" accept="image/*">


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <?php if ($profile_pic_status === 'add'): ?>
                                        <button class="btn profile-button" type="submit" name="submit" value="upload" data-bs-toggle="modal" data-bs-target="#exampleModal">Upload Profile Picutre</button>
                                    <?php else: ?>
                                        <button class="btn profile-button" type="submit" name="submit" value="upload" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit Profile Picture</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

                <?php if ($profile_pic_status === 'add'): ?>
                    <button class="btn profile-button" data-bs-toggle="modal" data-bs-target="#exampleModal">Upload Profile Picutre</button>
                <?php else: ?>
                    <button class="btn profile-button" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit Profile Picture</button>
                <?php endif; ?>
                <h4 class="mt-3 text-uppercase" style="user-select: none;"><?php echo $first_name . ' ' . $surname; ?></h4>
            </div>

            <h5 class="section-title" style="user-select: none;">Student Information</h5>
            <div class="info-box text-uppercase" style="user-select: none;">
                <p><strong>Surname:</strong> <?php echo $surname; ?></p>
                <p><strong>First Name:</strong> <?php echo $first_name; ?></p>
                <p><strong>Middle Name:</strong> <?php echo $middle_name; ?></p>
                <p><strong>Suffix:</strong> <?php echo $suffix; ?></p>
                <p><strong>Student Number:</strong> <?php echo $student_number; ?></p>
                <p><strong>Email Address:</strong> <?php echo $email; ?></p>
                <p><strong>Gender:</strong> <?php echo $gender; ?></p>
                <p><strong>Birthdate:</strong> <?php echo $birthdate; ?></p>
            </div>

            <h5 class="section-title" style="user-select: none;">Parents Information</h5>

            <h6 class="text-muted" style="user-select: none;">Mother's Information</h6>
            <div class="info-box text-uppercase" style="user-select: none;">
                <p><strong>Surname:</strong> <?php echo $M_surname; ?></p>
                <p><strong>First Name:</strong> <?php echo $M_first_name; ?></p>
                <p><strong>Middle Name:</strong> <?php echo $M_middle_name; ?></p>
                <p><strong>Suffix:</strong> <?php echo $M_suffix; ?></p>
                <p><strong>Mobile Phone:</strong> <?php echo $M_contact_number; ?></p>
                <p><strong>Occupation:</strong> <?php echo $M_occupation; ?></p>
                <p><strong>Email Address:</strong> <?php echo $M_email; ?></p>
            </div>

            <h6 class="text-muted" style="user-select: none;">Father's Information</h6>
            <div class="info-box text-uppercase" style="user-select: none;">
                <p><strong>Surname:</strong> <?php echo $F_surname; ?></p>
                <p><strong>First Name:</strong> <?php echo $F_first_name; ?></p>
                <p><strong>Middle Name:</strong> <?php echo $F_middle_name; ?></p>
                <p><strong>Suffix:</strong> <?php echo $F_suffix; ?></p>
                <p><strong>Mobile Phone:</strong> <?php echo $F_contact_number; ?></p>
                <p><strong>Occupation:</strong> <?php echo $F_occupation; ?></p>
                <p><strong>Email Address:</strong> <?php echo $F_email; ?></p>
            </div>

            <h5 class="section-title" style="user-select: none;">Your Classrooms</h5>
            <div class="info-box" style="user-select: none;">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Class Time</th>
                                <th>Class Days</th>
                                <th>Room</th>
                                <th>Professor</th>
                                <th>Block</th>
                                <th>Seat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($class_info)): ?>
                                <?php foreach ($class_info as $class): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($class['subject']) ?></td>
                                        <td><?= htmlspecialchars($class['class_time']) ?></td>
                                        <td><?= htmlspecialchars($class['class_days']) ?></td>
                                        <td><?= htmlspecialchars($class['room']) ?></td>
                                        <td><?= htmlspecialchars($class['professor']) ?></td>
                                        <td><?= htmlspecialchars($class['block']) ?></td>
                                        <td><?= htmlspecialchars($class['seat_number']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7">No data found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>



        <?php else: ?>
            <div class="text-center mt-5">
                <p class="alert alert-danger">User data not found.</p>
            </div>
        <?php endif; ?>
    </div>


    <script>
        document.getElementById("toggleSidebar").addEventListener("click", function() {
            const sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("active");
        });
    </script>
</body>

</html>