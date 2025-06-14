<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "ntc_database";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// CREATE - Only process if form was submitted
if (isset($_POST['add']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // Prepare and bind parameters to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO data_student 
        (first_name, middle_name, surname, suffix, image_path, profile_pic_status, block_sec, student_number, email, gender, birthdate, password, M_first_name, M_surname, M_suffix, M_email, M_contact_number, M_occupation, F_first_name, F_surname, F_suffix, F_email, F_contact_number, F_occupation, M_middle_name, F_middle_name) 
        VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("ssssssssssssssssssssssssss", 
        $_POST['first_name'], 
        $_POST['middle_name'], 
        $_POST['surname'], 
        $_POST['suffix'], 
        $_POST['image_path'], 
        $_POST['profile_pic_status'], 
        $_POST['block_sec'], 
        $_POST['student_number'], 
        $_POST['email'], 
        $_POST['gender'], 
        $_POST['birthdate'], 
        $_POST['password'], 
        $_POST['M_first_name'], 
        $_POST['M_surname'], 
        $_POST['M_suffix'], 
        $_POST['M_email'], 
        $_POST['M_contact_number'], 
        $_POST['M_occupation'], 
        $_POST['F_first_name'], 
        $_POST['F_surname'], 
        $_POST['F_suffix'], 
        $_POST['F_email'], 
        $_POST['F_contact_number'], 
        $_POST['F_occupation'], 
        $_POST['M_middle_name'], 
        $_POST['F_middle_name']
    );
    
    if ($stmt->execute()) {
        echo "<script>alert('Record added successfully');</script>";
        // Redirect to prevent form resubmission
        echo "<script>window.location.href = '".$_SERVER['PHP_SELF']."';</script>";
        exit();
    } else {
        echo "<script>alert('Error adding record: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}

// UPDATE
if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("UPDATE data_student SET 
        first_name=?, 
        middle_name=?, 
        surname=?, 
        suffix=?, 
        image_path=?, 
        profile_pic_status=?, 
        block_sec=?, 
        student_number=?, 
        email=?, 
        gender=?, 
        birthdate=?, 
        password=?, 
        M_first_name=?, 
        M_surname=?, 
        M_suffix=?, 
        M_email=?, 
        M_contact_number=?, 
        M_occupation=?, 
        F_first_name=?, 
        F_surname=?, 
        F_suffix=?, 
        F_email=?, 
        F_contact_number=?, 
        F_occupation=?, 
        created_at=?, 
        M_middle_name=?, 
        F_middle_name=? 
        WHERE id=?");
    
    $stmt->bind_param("sssssssssssssssssssssssssssi", 
        $_POST['first_name'], 
        $_POST['middle_name'], 
        $_POST['surname'], 
        $_POST['suffix'], 
        $_POST['image_path'], 
        $_POST['profile_pic_status'], 
        $_POST['block_sec'], 
        $_POST['student_number'], 
        $_POST['email'], 
        $_POST['gender'], 
        $_POST['birthdate'], 
        $_POST['password'], 
        $_POST['M_first_name'], 
        $_POST['M_surname'], 
        $_POST['M_suffix'], 
        $_POST['M_email'], 
        $_POST['M_contact_number'], 
        $_POST['M_occupation'], 
        $_POST['F_first_name'], 
        $_POST['F_surname'], 
        $_POST['F_suffix'], 
        $_POST['F_email'], 
        $_POST['F_contact_number'], 
        $_POST['F_occupation'], 
        $_POST['created_at'], 
        $_POST['M_middle_name'], 
        $_POST['F_middle_name'],
        $_POST['id']
    );
    
    if ($stmt->execute()) {
        echo "<script>alert('Record updated successfully');</script>";
        // Use JavaScript redirect instead of header to avoid issues with output buffering
        echo "<script>window.location.href = '".$_SERVER['PHP_SELF']."';</script>";
        exit();
    } else {
        echo "<script>alert('Error updating record: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}

// DELETE
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM data_student WHERE id=?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>alert('Record deleted successfully');</script>";
        // Use JavaScript redirect
        echo "<script>window.location.href = '".strtok($_SERVER['REQUEST_URI'], '?')."';</script>";
        exit();
    } else {
        echo "<script>alert('Error deleting record');</script>";
    }
    $stmt->close();
}

// READ
$result = $conn->query("SELECT * FROM data_student");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Data</title>
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
      overflow-x: hidden; /* Remove horizontal scrollbar */
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
      margin-top:13px;
    }
    .sidebar .top-links a {
    margin-bottom: 5px; /* nice space between sidebar menus */
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
      margin-top: 20px; /* Adjust this value as needed */
    }

    .sidebar .mb-4 a.btn-danger {
  margin-top: 30px;
  margin-bottom: 20px;
  padding: 8px 16px;  
  font-size: 16px;    
  border: none;
  border-radius: 5px;
  width: 35%;  /* Add this to control width manually */
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
  <div class="brand"><i class="bi bi-robot me-1"></i>Student Data</div>
</div>

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
    <a href="logout.php" class="btn btn-danger w-35 d-block mx-auto">Logout</a>
  </div>
</div>

<!-- Main Content -->
<div class="main-content">
  <div class="container">
    <h2 class="mb-4 text-secondary">Student Data</h2>

    <!-- Form -->
    <form method="POST" class="row g-3 mb-4" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <!-- Student Information Section -->
      <div class="col-12 p-3 mb-3 rounded">
        <h5>Student Information</h5>
        <div class="row">
          <div class="col-md-2"><input type="text" name="first_name" class="form-control" placeholder="First Name" required></div>
          <div class="col-md-2"><input type="text" name="middle_name" class="form-control" placeholder="Middle Name" required></div>
          <div class="col-md-2"><input type="text" name="surname" class="form-control" placeholder="Surname" required></div>
          <div class="col-md-2"><input type="text" name="suffix" class="form-control" placeholder="Suffix"></div>
          <div class="col-md-2"><input type="text" name="image_path" class="form-control" placeholder="Image Path" required></div>
          <div class="col-md-2"><input type="text" name="profile_pic_status" class="form-control" placeholder="Profile Pic Status" required></div><br><br>
          <div class="col-md-2"><input type="text" name="block_sec" class="form-control" placeholder="Block Section" required></div>
          <div class="col-md-2"><input type="text" name="student_number" class="form-control" placeholder="Student Number" required></div>
          <div class="col-md-2"><input type="email" name="email" class="form-control" placeholder="Email" required></div>
          <div class="col-md-2"><input type="text" name="gender" class="form-control" placeholder="Gender"></div>
          <div class="col-md-2"><input type="date" name="birthdate" class="form-control" placeholder="Birthdate"></div>
          <div class="col-md-2"><input type="password" name="password" class="form-control" placeholder="Password"></div>
        </div>
      </div>

      <!-- Mother's Information Section -->
      <div class="col-12 p-3 mb-3 rounded">
        <h5>Mother's Information</h5>
        <div class="row">
          <div class="col-md-2"><input type="text" name="M_first_name" class="form-control" placeholder="First Name" required></div>
          <div class="col-md-2"><input type="text" name="M_middle_name" class="form-control" placeholder="Middle Name" required></div>
          <div class="col-md-2"><input type="text" name="M_surname" class="form-control" placeholder="Surname" required></div>
          <div class="col-md-2"><input type="text" name="M_suffix" class="form-control" placeholder="Suffix"></div>
          <div class="col-md-2"><input type="email" name="M_email" class="form-control" placeholder="Email" required></div>
          <div class="col-md-2"><input type="text" name="M_contact_number" class="form-control" placeholder="Contact Number" required></div><br><br>
          <div class="col-md-2"><input type="text" name="M_occupation" class="form-control" placeholder="Occupation" required></div>
        </div>
      </div>

      <!-- Father's Information Section -->
      <div class="col-12 p-3 mb-3 rounded">
        <h5>Father's Information</h5>
        <div class="row">
          <div class="col-md-2"><input type="text" name="F_first_name" class="form-control" placeholder="First Name" required></div>
          <div class="col-md-2"><input type="text" name="F_middle_name" class="form-control" placeholder="Middle Name" required></div>
          <div class="col-md-2"><input type="text" name="F_surname" class="form-control" placeholder="Surname" required></div>
          <div class="col-md-2"><input type="text" name="F_suffix" class="form-control" placeholder="Suffix"></div>
          <div class="col-md-2"><input type="email" name="F_email" class="form-control" placeholder="Email" required></div>
          <div class="col-md-2"><input type="text" name="F_contact_number" class="form-control" placeholder="Contact Number" required></div><br><br>
          <div class="col-md-2"><input type="text" name="F_occupation" class="form-control" placeholder="Occupation" required></div>
        </div>
      </div>

      <div class="col-md-2 d-grid">
        <button type="submit" name="add" class="btn btn-primary">Add</button>
      </div>
    </form>

    <!-- Table -->
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle text-center">
        <thead class="table-light">
          <tr>
            <th colspan="13" class="text-center bg-info text-white">Student Information</th>
            <th colspan="7" class="text-center bg-warning text-white">Mother's Information</th>
            <th colspan="9" class="text-center bg-primary text-white">Father's Information</th>

          </tr>
          <tr>
            <!-- Student Info Headers -->
            <th>ID</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Surname</th>
            <th>Suffix</th>
            <th>Image Path</th>
            <th>Profile Pic Status</th>
            <th>Block Section</th>
            <th>Student Number</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Birthdate</th>
            <th>Password</th>
            
            <!-- Mother's Info Headers -->
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Surname</th>
            <th>Suffix</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>Occupation</th>
            
            <!-- Father's Info Headers -->
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Surname</th>
            <th>Suffix</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>Occupation</th>
            
            <th>Created At</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
              <td><?= $row['id'] ?></td>
              
              <!-- Student Info -->
              <td><?= htmlspecialchars($row['first_name']) ?></td>
              <td><?= htmlspecialchars($row['middle_name']) ?></td>
              <td><?= htmlspecialchars($row['surname']) ?></td>
              <td><?= htmlspecialchars($row['suffix']) ?></td>
              <td><?= htmlspecialchars($row['image_path']) ?></td>
              <td><?= htmlspecialchars($row['profile_pic_status']) ?></td>
              <td><?= htmlspecialchars($row['block_sec']) ?></td>
              <td><?= htmlspecialchars($row['student_number']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td><?= htmlspecialchars($row['gender']) ?></td>
              <td><?= htmlspecialchars($row['birthdate']) ?></td>
              <td><?= htmlspecialchars($row['password']) ?></td>
              
              <!-- Mother's Info -->
              <td><?= htmlspecialchars($row['M_first_name']) ?></td>
              <td><?= htmlspecialchars($row['M_middle_name']) ?></td>
              <td><?= htmlspecialchars($row['M_surname']) ?></td>
              <td><?= htmlspecialchars($row['M_suffix']) ?></td>
              <td><?= htmlspecialchars($row['M_email']) ?></td>
              <td><?= htmlspecialchars($row['M_contact_number']) ?></td>
              <td><?= htmlspecialchars($row['M_occupation']) ?></td>
              
              <!-- Father's Info -->
              <td><?= htmlspecialchars($row['F_first_name']) ?></td>
              <td><?= htmlspecialchars($row['F_middle_name']) ?></td>
              <td><?= htmlspecialchars($row['F_surname']) ?></td>
              <td><?= htmlspecialchars($row['F_suffix']) ?></td>
              <td><?= htmlspecialchars($row['F_email']) ?></td>
              <td><?= htmlspecialchars($row['F_contact_number']) ?></td>
              <td><?= htmlspecialchars($row['F_occupation']) ?></td>
              
              <td><?= htmlspecialchars($row['created_at']) ?></td>
              <td class="text-center justify-content-center d-flex flex-row gap-2"> 
                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id'] ?>"><i class="bi bi-pencil-square"></i></button>
                <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this entry?')"><i class="bi bi-trash"></i></a>
              </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $row['id'] ?>" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editModalLabel<?= $row['id'] ?>">Edit Entry</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="id" value="<?= $row['id'] ?>">
                      
                      <!-- Student Information Section -->
                      <div class="mb-4 p-3 bg-light rounded">
                        <h5>Student Information</h5>
                        <div class="row">
                          <div class="col-md-4 mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($row['first_name']) ?>" required>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="middle_name" class="form-control" value="<?= htmlspecialchars($row['middle_name']) ?>" required>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label class="form-label">Surname</label>
                            <input type="text" name="surname" class="form-control" value="<?= htmlspecialchars($row['surname']) ?>" required>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label class="form-label">Suffix</label>
                            <input type="text" name="suffix" class="form-control" value="<?= htmlspecialchars($row['suffix']) ?>">
                          </div>
                          <div class="col-md-4 mb-3">
                            <label class="form-label">Image Path</label>
                            <input type="text" name="image_path" class="form-control" value="<?= htmlspecialchars($row['image_path']) ?>" required>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label class="form-label">Profile Pic Status</label>
                            <input type="text" name="profile_pic_status" class="form-control" value="<?= htmlspecialchars($row['profile_pic_status']) ?>" required>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label class="form-label">Block Section</label>
                            <input type="text" name="block_sec" class="form-control" value="<?= htmlspecialchars($row['block_sec']) ?>" required>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label class="form-label">Student Number</label>
                            <input type="text" name="student_number" class="form-control" value="<?= htmlspecialchars($row['student_number']) ?>" required>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($row['email']) ?>" required>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label class="form-label">Gender</label>
                            <input type="text" name="gender" class="form-control" value="<?= htmlspecialchars($row['gender']) ?>">
                          </div>
                          <div class="col-md-4 mb-3">
                            <label class="form-label">Birthdate</label>
                            <input type="date" name="birthdate" class="form-control" value="<?= htmlspecialchars($row['birthdate']) ?>">
                          </div>
                          <div class="col-md-4 mb-3">
                            <label class="form-label">Password</label>
                            <input type="text" name="password" class="form-control" value="<?= htmlspecialchars($row['password']) ?>">
                          </div>
                        </div>
                      </div>
                      
                      <!-- Mother's Information Section -->
                      <div class="mb-4 p-3 bg-light rounded">
                        <h5>Mother's Information</h5>
                        <div class="row">
                          <div class="col-md-4 mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="M_first_name" class="form-control" value="<?= htmlspecialchars($row['M_first_name']) ?>" required>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="M_middle_name" class="form-control" value="<?= htmlspecialchars($row['M_middle_name']) ?>" required>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label class="form-label">Surname</label>
                            <input type="text" name="M_surname" class="form-control" value="<?= htmlspecialchars($row['M_surname']) ?>" required>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label class="form-label">Suffix</label>
                            <input type="text" name="M_suffix" class="form-control" value="<?= htmlspecialchars($row['M_suffix']) ?>">
                          </div>
                          <div class="col-md-4 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="M_email" class="form-control" value="<?= htmlspecialchars($row['M_email']) ?>" required>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label class="form-label">Contact Number</label>
                            <input type="text" name="M_contact_number" class="form-control" value="<?= htmlspecialchars($row['M_contact_number']) ?>" required>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label class="form-label">Occupation</label>
                            <input type="text" name="M_occupation" class="form-control" value="<?= htmlspecialchars($row['M_occupation']) ?>" required>
                          </div>
                        </div>
                      </div>
                      
                      <!-- Father's Information Section -->
                      <div class="mb-4 p-3 bg-light rounded">
                        <h5>Father's Information</h5>
                        <div class="row">
                          <div class="col-md-4 mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="F_first_name" class="form-control" value="<?= htmlspecialchars($row['F_first_name']) ?>" required>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="F_middle_name" class="form-control" value="<?= htmlspecialchars($row['F_middle_name']) ?>" required>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label class="form-label">Surname</label>
                            <input type="text" name="F_surname" class="form-control" value="<?= htmlspecialchars($row['F_surname']) ?>" required>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label class="form-label">Suffix</label>
                            <input type="text" name="F_suffix" class="form-control" value="<?= htmlspecialchars($row['F_suffix']) ?>">
                          </div>
                          <div class="col-md-4 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="F_email" class="form-control" value="<?= htmlspecialchars($row['F_email']) ?>" required>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label class="form-label">Contact Number</label>
                            <input type="text" name="F_contact_number" class="form-control" value="<?= htmlspecialchars($row['F_contact_number']) ?>" required>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label class="form-label">Occupation</label>
                            <input type="text" name="F_occupation" class="form-control" value="<?= htmlspecialchars($row['F_occupation']) ?>" required>
                          </div>
                        </div>
                      </div>
                      
                      <!-- Other Fields -->
                      <div class="mb-3">
                        <label class="form-label">Created At</label>
                        <input type="datetime-local" name="created_at" class="form-control" value="<?= htmlspecialchars(str_replace(' ', 'T', $row['created_at'])) ?>" required>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" name="update" class="btn btn-success">Update</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          <?php } ?>
        </tbody>
      </table>
    </div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Sidebar Toggle Script -->
<script type="text/javascript">
  window.onbeforeunload = function() {
    var text = "You have unsaved changes. Do you really want to leave?";
    return text;
  }

  document.getElementById('toggleSidebar').onclick = function() {
    document.getElementById('sidebar').classList.toggle('active');
  };
 
 let isFormChanged = false;

document.querySelector("input, textarea").addEventListener("input", function () {
  isFormChanged = true;
});



</script>

</body>
</html>