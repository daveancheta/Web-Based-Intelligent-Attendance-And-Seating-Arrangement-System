<?php
session_start();
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
    $password = $_POST['password'];
    $conn->query("INSERT INTO room_405  (subject, start_time, end_time, block, professor, day, password) VALUES ('$subject', '$start_time', '$end_time', '$block', '$day', '$professor', '$password')");

    header("Location:" . $_SERVER['PHP_SELF'] . "");
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
    $password = $_POST['password'];
    $conn->query("UPDATE room_405 SET block='$block', professor='$professor', start_time='$start_time', end_time='$end_time', subject='$subject', day='$day', password='$password' WHERE id=$id");

    header("Location:" . $_SERVER['PHP_SELF'] . "");
    exit();
}

// DELETE
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM room_405 WHERE id=$id");
}

$fullname = $_SESSION['fullname'];
// READ
$result = $conn->query("SELECT * FROM room_405 WHERE professor = '$fullname' ORDER BY start_time ASC");


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
                      <a class="mt-5" href="04-home.php">Home</a>
            <a class="mt-3" href="05-attendance.php">Attendance</a>
            <a class="mt-3" href="16-teachers.php">Teacher</a>
            <a class="mt-3 mb-5" onclick="window.location.href='chat room/index.php';">Chat Room</a>
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
                <h2 class="mb-4 text-secondary"><i class="bi bi-robot me-2"></i>room 405</h2>

                <!-- Add Form -->
                <form method="POST" class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label for="Block" class="form-label">Block</label>
                        <input type="text" name="block" class="form-control" placeholder="Block" required>
                    </div>

                    <div class="col-md-4">
                        <label for="Professor" class="form-label">Professor</label>
                        <input type="text" name="professor" class="form-control" placeholder="Professor" required>
                    </div>

                    <div class="col-md-3">
                        <label for="Start Time" class="form-label">Start Time</label>
                        <input type="time" name="start_time" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label for="End Time" class="form-label">End Time</label>
                        <input type="time" name="end_time" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label for="Subject" class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                    </div>

                    <div class="col-md-3">
                        <label for="Day" class="form-label">Day</label>
                        <input type="text" name="day" class="form-control" placeholder="Day" required>
                    </div>

                    <div class="col-md-4">
                        <label for="Password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="text" id="password" name="password" class="form-control" placeholder="Password" required>
                            <button type="button" class="btn btn-outline-secondary" onclick="generatePassword()">Generate</button>
                        </div>
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
                                <th>Password</th>
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
                                    <td><?= htmlspecialchars($row['password']) ?></td>
                                    <td class="text-center d-flex flex-row gap-2">
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id'] ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal1"
                                        data-bs-password="<?= htmlspecialchars($row['password']) ?>">
                                            <i class="bi bi-qr-code"></i>
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
        $result->data_seek(0);
        while ($row = $result->fetch_assoc()) {
            $modalId = $row['id']; // unique identifier for this modal
        ?>
            <div class="modal fade" id="editModal<?= $modalId ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="POST" class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="bi bi-pencil me-2"></i>Edit Entry</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $modalId ?>">

                            <!-- Block -->
                            <div class="mb-3">
                                <label class="form-label">Block</label>
                                <input type="text" name="block" class="form-control" value="<?= htmlspecialchars($row['block']) ?>" required>
                            </div>

                            <!-- Day -->
                            <div class="mb-3">
                                <label class="form-label">Day</label>
                                <input type="text" name="day" class="form-control" value="<?= htmlspecialchars($row['day']) ?>" required>
                            </div>

                            <!-- Start Time -->
                            <div class="mb-3">
                                <label class="form-label">Start Time</label>
                                <input type="time" name="start_time" class="form-control" value="<?= htmlspecialchars($row['start_time']) ?>">
                            </div>

                            <!-- End Time -->
                            <div class="mb-3">
                                <label class="form-label">End Time</label>
                                <input type="time" name="end_time" class="form-control" value="<?= htmlspecialchars($row['end_time']) ?>" required>
                            </div>

                            <!-- Subject -->
                            <div class="mb-3">
                                <label class="form-label">Subject</label>
                                <input type="text" name="subject" class="form-control" value="<?= htmlspecialchars($row['subject']) ?>" required>
                            </div>

                            <!-- Professor -->
                            <div class="mb-3">
                                <label class="form-label">Professor</label>
                                <input type="text" name="professor" class="form-control" value="<?= htmlspecialchars($row['professor']) ?>" required>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="text" id="password<?= $modalId ?>" name="password" class="form-control" value="<?= htmlspecialchars($row['password']) ?>" required>
                                    <button type="button" class="btn btn-outline-secondary" onclick="generatePassword2('password<?= $modalId ?>')" id="password2">Generate</button>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" name="update" class="btn btn-success">Update</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>

<div class="modal fade" id="editModal1" tabindex="-1" aria-labelledby="editModalLabel1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel1">QR Code</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body text-center">
         <p id="qr-value" class="fw-bold text-success"></p> <!-- Display the value here -->
        <img id="qr-img" src="" class="img-fluid mt-3 mb-3" alt="QR Code will appear here" />
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


        <script src="app.js"></script>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Sidebar Toggle Script -->
    <script>
        document.getElementById('toggleSidebar').onclick = function() {
            document.getElementById('sidebar').classList.toggle('active');
        };

        function generatePassword() {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let result = '';
            for (let i = 0; i < 10; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            document.getElementById('password').value = result;
        }

        function generatePassword2(id) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let result = '';
            for (let i = 0; i < 10; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            document.getElementById(id).value = result;
        }


  var editModal = document.getElementById('editModal1');
  editModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var password = button.getAttribute('data-bs-password');

    var qrImg = document.getElementById('qr-img');
    var qrValue = document.getElementById('qr-value');
    var downloadLink = document.getElementById('download-link');

    if (password) {
      var qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=350x350&data=${encodeURIComponent(password)}`;
      qrImg.src = qrUrl;
      qrValue.textContent = password; // Show the actual value
      downloadLink.href = qrUrl;
    }
  });
    </script>

</body>

</html>