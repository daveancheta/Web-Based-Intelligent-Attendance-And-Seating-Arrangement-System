<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "ntc_database";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// CREATE
if (isset($_POST['add'])) {
    $subject = $_POST['subject'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $block = $_POST['block'];
    $professor = $_POST['professor'];
    $day = $_POST['day'];
    $conn->query("INSERT INTO room_314  (subject, start_time, end_time, block, professor, day) VALUES ('$subject', '$start_time', '$end_time', '$block', '$day', '$professor')");

       // Redirect to prevent resubmission on refresh
    header("Location:" .$_SERVER['PHP_SELF']."");
    exit();
}

// UPDATE
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $block = $_POST['block'];
    $professor = $_POST['professor'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $subject = $_POST['subject'];
    $day = $_POST['day'];
    $conn->query("UPDATE room_314 SET block='$block', professor='$professor', start_time='$start_time', end_time='$end_time', subject='$subject', day='$day' WHERE id=$id");

    header("Location:" .$_SERVER['PHP_SELF']."");
    exit();
}

// DELETE
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM room_314 WHERE id=$id");
}

// READ
$result = $conn->query("SELECT * FROM room_314");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin - Room</title>
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
            overflow: auto;
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
      <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="top-links">
                    <div class="navbar-brand" onclick="window.location.href='admin_home.php'" style="cursor: pointer;"><i class="bi bi-person-circle"></i> Admin Panel</div>
                 <a href="student_data.php">Student Data</a>
            <a href="teacher_profile.php">Professor</a>
            <a href="rooms.php">Rooms</a>
             <a href="chat_rooms.php">Chat Rooms</a>
            <a href="gizmo_bot.php">Bot Data</a>
            <a href="gizmo_status.php">Bot Status</a>
            <a href="system_status.php">System Status</a>
            <a href="attendance_status.php">Attendance Status</a>
            <a href="mark_of_attendance.php">Seating Arrangement</a>
            <a href="admin_accounts.php">Admin Accounts</a>

            <hr class="bg-light w-75">
        </div>


        <div class="mb-4">
            <!-- 'Change Password' Link with custom margin-top -->
            <a href="#" class="change-password">Change Password</a>

            <!-- 'Logout' button with custom margin-top -->
            <a href="logout.php" class="btn btn-danger w-35 d-block mx-auto">Logout</a>

        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <div class="panel">
                <h2 class="mb-4 text-secondary"><i class="bi bi-robot me-2"></i>room 314</h2>

                <!-- Add Form -->
                <form method="POST" class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label for="Block">Block</label>
                        <input type="text" name="block" class="form-control" placeholder="Block" required>
                    </div>
                    <div class="col-md-4">
                        <label for="Professor">Professor</label>
                        <input type="text" name="professor" class="form-control" placeholder="Professor" required>
                    </div>
                    <div class="col-md-3">
                        <label for="Start Time">Start Time</label>
                        <input type="time" name="start_time" class="form-control" placeholder="Start Time">
                    </div>
                    <div class="col-md-4">
                        <label for="End Time">End Time</label>
                        <input type="time" name="end_time" class="form-control" placeholder="End Time" required>
                    </div>
                    <div class="col-md-4">
                        <label for="Subject">Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="subject" required>
                    </div>
                    <div class="col-md-3">
                        <label for="Day">Day</label>
                        <input type="text" name="day" class="form-control" placeholder="Day" required>
                    </div>
                    <div class="col-md-1 d-grid align-self-end">
        <button type="submit" name="add" class="btn btn-primary">Add</button>
    </div>

                </form>

                <!-- Data Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th>ID</th>
                                <th>Block</th>
                                <th>Professor</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Subject</th>
                                <th>Day</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['id']) ?></td>
                                    <td><?= htmlspecialchars($row['block']) ?></td>
                                    <td><?= htmlspecialchars($row['day']) ?></td>

                                    <td><?= htmlspecialchars($row['start_time']) ?></td>
                                    <td><?= htmlspecialchars($row['end_time']) ?></td>
                                    <td><?= htmlspecialchars($row['subject']) ?></td>
                                    <td><?= htmlspecialchars($row['professor']) ?></td>
                                    <td class="text-center d-flex flex-row gap-2">
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id'] ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this entry?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- All Modals -->
        <?php
        $result->data_seek(0); // Reset result pointer
        while ($row = $result->fetch_assoc()) { ?>
            <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1">
                <div class="modal-dialog">
                    <form method="POST" class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="bi bi-pencil me-2"></i>Edit Entry</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <div class="mb-3">
                                <label>Block</label>
                                <input type="text" name="block" class="form-control" value="<?= htmlspecialchars($row['block']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Day</label>
                                <input type="text" name="professor" class="form-control" value="<?= htmlspecialchars($row['professor']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Start Time</label>
                                <input type="time" name="start_time" class="form-control" value="<?= htmlspecialchars($row['start_time']) ?>">
                            </div>
                            <div class="mb-3">
                                <label>End Time</label>
                                <input type="time" name="end_time" class="form-control" value="<?= htmlspecialchars($row['end_time']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Subject</label>
                                <input type="text" name="subject" class="form-control" value="<?= htmlspecialchars($row['subject']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Professor</label>
                                <input type="text" name="day" class="form-control" value="<?= htmlspecialchars($row['day']) ?>">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" name="update" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>
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