<?php
session_start([
    'cookie_secure' => true,
    'cookie_httponly' => true,
    'cookie_samesite' => 'Strict'
]);

// Check if teacher is logged in
if (!isset($_SESSION['fullname'])) {
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

$fullname = $_SESSION['fullname'];

// Get teacher data
$stmt = $conn->prepare("SELECT fullname, email, image_path, profile_pic_status FROM teacher_accounts WHERE fullname = ? LIMIT 1");
$stmt->bind_param("s", $fullname);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    $teacher_data = $result->fetch_assoc();
    $fullname = htmlspecialchars($teacher_data['fullname'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($teacher_data['email'], ENT_QUOTES, 'UTF-8');
    $image_path = isset($teacher_data['image_path']) ? htmlspecialchars($teacher_data['image_path'], ENT_QUOTES, 'UTF-8') : "image/default-profile.png";
    $profile_pic_status = isset($teacher_data['profile_pic_status']) ? htmlspecialchars($teacher_data['profile_pic_status'], ENT_QUOTES, 'UTF-8') : "add";
} else {
    $teacher_data = null;
}

// Handle profile picture upload
if (isset($_POST['submit'])) {
    $profile_pic_status = $_POST['edit']; 

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $upload_dir = "uploads/teachers/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $new_filename = uniqid() . '.' . $file_extension;
        $file_path = $upload_dir . $new_filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {
            $query = "UPDATE teacher_accounts SET image_path = ?, profile_pic_status = ? WHERE fullname = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sss", $file_path, $profile_pic_status, $fullname);
            $result = $stmt->execute();

            if ($result) {
                echo "<script>alert('Image uploaded successfully'); window.location.href = '06-profile.php';</script>";
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "Error uploading file";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_subject'])) {
    $selectedSubject = $_POST['selected_subject'];
    // You can save this to session or database
    $_SESSION['selected_subject'] = $selectedSubject;
    // Optionally redirect to avoid form resubmission
header('Location: mark_of_attendance.php');
    exit;
}


$stmt2 = $conn->prepare("SELECT start_time, end_time, block, professor, day, subject FROM room_101 WHERE professor = ? ORDER BY start_time ASC");
$stmt2->bind_param("s", $fullname);
$stmt2->execute();
$result = $stmt2->get_result();




$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Teacher Dashboard</title>
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

        .class-card {
            background-color: #ffffff;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .class-card:hover {
            transform: translateY(-5px);
        }

        .class-card-header {
            background-color: #001f3f;
            color: white;
            padding: 15px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .class-card-body {
            padding: 15px;
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
    <div class="mobile-navbar">
        <div class="brand"><i class="bi bi-person-workspace me-1"></i>Teacher Dashboard</div>
        <button id="toggleSidebar">&#9776;</button>
    </div>

    <div class="sidebar d-flex flex-column justify-content-between text-center" id="sidebar">
        <div>
            <div class="navbar-brand text-light nbsp">
                <i class="bi bi-person-workspace"></i>
                Teacher
            </div>
                      <a class="mt-5" href="04-home.php">Home</a>
            <a class="mt-3" href="05-attendance.php">Attendance</a>
            <a class="mt-3" href="16-teachers.php">Teacher</a>
            <a class="mt-3 mb-5" onclick="window.location.href='chat room/index.php';">Chat Room</a>
        </div>
        <a class="mt-5" href="08-teacher-change-password.php">Change Password</a>

        <div class="mb-5 d-flex flex-column justify-content-center align-items-center">
            <button onclick="window.location.href='logout.php'" class="btn btn-danger logout">Logout</button>
        </div>
    </div>

    <div class="main-content container">
        <?php if ($teacher_data): ?>
            <div class="profile-header">
                <img src="<?php echo $image_path; ?>" alt="Teacher Profile Picture">
                <form method="post" enctype="multipart/form-data" class="d-flex justify-content-center align-items-center gap-2 mt-2">
                    <input type="hidden" name="edit" value="edit">

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
                                    <input type="file" name="image" class="form-control form-control-sm w-50">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <?php if ($profile_pic_status === 'add'): ?>
                                        <button class="btn profile-button" type="submit" name="submit" value="upload">Upload Profile Picture</button>
                                    <?php else: ?>
                                        <button class="btn profile-button" type="submit" name="submit" value="upload">Edit Profile Picture</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <?php if ($profile_pic_status === 'add'): ?>
                    <button class="btn profile-button" data-bs-toggle="modal" data-bs-target="#exampleModal">Upload Profile Picture</button>
                <?php else: ?>
                    <button class="btn profile-button" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit Profile Picture</button>
                <?php endif; ?>
                
                <h4 class="mt-3"><?php echo $fullname; ?></h4>
                <p class="text-muted"><?php echo $email; ?></p>
            </div>

            <h5 class="section-title">Your Classes</h5>
             <!-- Class Schedule -->
           <div class="box-container mt-4">

             
     <?php 
// Handle form submission if a card was clicked
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_subject'])) {
    $selectedSubject = $_POST['selected_subject'];
    // You can save this to session or database
    $_SESSION['selected_subject'] = $selectedSubject;
    // Optionally redirect to avoid form resubmission
    // header('Location: '.$_SERVER['PHP_SELF']);
    // exit;
}
?>

<?php if ($result->num_rows > 0) : ?>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        <?php while ($row = $result->fetch_assoc()) : 
            $formattedStartTime = date('h:ia', strtotime($row["start_time"]));
            $formattedEndTime = date('h:ia', strtotime($row["end_time"]));
        ?>
        <div class="col">
            <form method="post" action="">
                <input type="hidden" name="selected_subject" value="<?= htmlspecialchars($row['subject']) ?>">
                <button type="submit" class="card h-100 shadow-sm w-100 text-start p-0" style="border-radius: 10px; border: none; background: none;">
                    <div class="card-header text-white" style="background-color: #2962FF; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                        <h5 class="card-title mb-0"><?= htmlspecialchars($row["subject"]) ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge rounded-pill px-3 py-2 text-white" style="background-color: #00BFA6; font-weight: 600;">
                            <?= htmlspecialchars($formattedStartTime) ?> - <?= htmlspecialchars($formattedEndTime) ?>
                        </span>
                        <span class="badge text-dark" style="font-weight: 500; padding: 0.5em 0.75em; background-color: #FFD600;"><?= htmlspecialchars($row["day"]) ?></span>
                        </div>
                        <div class="mb-3">
                            <p class="mb-1"><strong>Block:</strong> <?= htmlspecialchars($row["block"]) ?></p>
                            <p class="mb-0"><strong>Professor:</strong> <?= htmlspecialchars($row["professor"]) ?></p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Class Schedule</small>
                    </div>
                </button>
            </form>
        </div>
        <?php endwhile; ?>
    </div>
<?php else : ?>
    <div class="alert alert-info text-center" style="max-width: 600px; margin: 0 auto; border-radius: 10px;">
        <i class="fas fa-calendar-times me-2"></i> No classes scheduled
    </div>
<?php endif; ?>
    


        <?php else: ?>
            <?php endif; ?>

    <script>
        document.getElementById("toggleSidebar").addEventListener("click", function() {
            const sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("active");
        });
    </script>
</body>
</html>