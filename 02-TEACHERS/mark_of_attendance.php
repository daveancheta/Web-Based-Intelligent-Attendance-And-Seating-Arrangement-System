<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "ntc_database";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);



$fullname = $_SESSION['fullname'];
$selected_subject = $_SESSION['selected_subject'];
// READ
$result = $conn->query("SELECT * FROM info_ass WHERE professor = '$fullname' AND subject = '$selected_subject'");

// At the top of your file
if (isset($_GET['delete_all'])) {
    $fullname = $_SESSION['fullname'];
    $selected_subject = $_SESSION['selected_subject'];

    // Clear specific columns for ALL rows that match the professor and subject
    $stmt = $conn->prepare("UPDATE info_ass SET 
        timein = NULL, 
        date = NULL, 
        M_email = NULL, 
        F_email = NULL, 
        status = NULL 
        WHERE professor = ? AND subject = ?");
    $stmt->bind_param("ss", $fullname, $selected_subject);

    if ($stmt->execute()) {
        $_SESSION['message'] = "All matching records cleared successfully.";
    } else {
        $_SESSION['error'] = "Error clearing data.";
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin - Attendance</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="./image/ntc-logo-1.png">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            /* Remove horizontal scrollbar */
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #001f3f;
            padding-top: 60px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            z-index: 1050;
        }

        .sidebar .top-links {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 16px 24px;
            display: block;
            width: 100%;
            text-align: center;
            font-weight: 500;
            margin-top: 13px;
        }

        .sidebar .top-links a {
            margin-bottom: 5px;
            /* nice space between sidebar menus */
        }

        .sidebar a:hover {
            background-color: white;
            color: #001f3f;
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 24px;
            color: white;
            margin-bottom: 30px;
        }

        /* Remove hover effect for the Admin Panel text */
        .navbar-brand:hover {
            background-color: transparent;
            color: white;
        }

        .mobile-navbar {
            display: none;
        }

        .main-content {
            margin-left: 250px;
            padding: 30px;
        }

        /* Apply margin to the 'Change Password' link */
        .sidebar .top-links a.change-password {
            margin-top: 20px;
            /* Adjust this value as needed */
        }

        .sidebar .mb-4 a.btn-danger {
            margin-top: 30px;
            margin-bottom: 20px;
            padding: 8px 16px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            width: 35%;
            /* Add this to control width manually */
        }

        .sidebar .mb-4 a.btn-danger:hover {
            background-color: #a82e2e;
            color: white;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-250px);
                transition: transform 0.3s ease;
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
                margin-left: 0;
                margin-top: 70px;
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <!-- Mobile Navbar -->
   <div class="mobile-navbar">
        <div class="brand"><i class="bi bi-person-circle"></i> Admin Panel</div>
        <button id="toggleSidebar" class="btn btn-light btn-sm">&#9776;</button>
    </div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="top-links">
            <div class="navbar-brand" onclick="window.location.href='admin_home.php'" style="cursor: pointer;"><i class="bi bi-person-circle"></i> Admin Panel</div>
            <a class="mt-5" href="04-home.php" style="cursor: pointer;">Home</a>
            <a class="mt-3" href="06-profile.php" style="cursor: pointer;">Profile</a>
            <a class="mt-3" href="06-teacher-students.php" style="cursor: pointer;">Students</a>
            <a class="mt-3 mb-5" onclick="window.location.href='../02-TEACHERS/chat room/chatroom.php';" style="cursor: pointer;">Chat Room</a>


            <hr class="bg-light w-75">
        </div>

        <div class="mb-4">
            <!-- 'Logout' button with custom margin-top -->
            <a href="logout.php" class="btn btn-danger w-35 d-block mx-auto">Logout</a>

        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <div class="panel">
                <h2 class="mb-4 text-secondary"><?php echo htmlspecialchars($_SESSION['selected_subject'] ?? ''); ?></h2>


                <div class="mb-3">
                    <div class="row g-2">
                        <?php $hasData = ($result->num_rows > 0); ?>

                        <div class="col-md-3">
                            <a href="export.php"
                                class="btn <?= $hasData ? 'btn-success' : 'btn-dark disabled' ?> w-100">
                                <i class="bi bi-download me-1"></i> Download Excel
                            </a>
                        </div>

                        <div class="col-md-4">
                            <a href="?delete_all=1"
                                class="btn <?= $hasData ? 'btn-danger' : 'btn-dark disabled' ?> w-100"
                                <?= $hasData ? 'onclick="return confirm(\'Are you sure you want to clear ALL attendance data for this subject?\')"' : '' ?>>
                                <i class="bi bi-trash3 me-1"></i> Clear All Attendance Data
                            </a>
                        </div>
                    </div>
                </div>





                <!-- Data Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th>ID</th>
                                <th>Student Number</th>
                                <th>Student Name</th>
                                <th>Subject</th>
                                <th>Time In</th>
                                <th>Block</th>
                                <th>Date</th>
                                <th>Mother's Email</th>
                                <th>Father's Email</th>
                                <th>Marked</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['id']) ?></td>
                                        <td><?= htmlspecialchars($row['student_number']) ?></td>
                                         <td><?= htmlspecialchars($row['student_name']) ?></td>
                                        <td><?= htmlspecialchars($row['subject']) ?></td>
                                        <td><?= htmlspecialchars($row['timein']) ?></td>
                                        <td><?= htmlspecialchars($row['block']) ?></td>
                                        <td><?= htmlspecialchars($row['date']) ?></td>
                                        <td><?= htmlspecialchars($row['M_email']) ?></td>
                                        <td><?= htmlspecialchars($row['F_email']) ?></td>
                                        <td><?= htmlspecialchars($row['status']) ?></td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="9" class="text-center text-muted">No attendance records found.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>


                <!-- Bootstrap JS -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

                <!-- Sidebar Toggle Script -->
                <script>
                    document.getElementById('toggleSidebar').onclick = function() {
                        document.getElementById('sidebar').classList.toggle('active');
                    };
                </script>

</body>

</html>