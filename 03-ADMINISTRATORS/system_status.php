<?php
session_start([
    'cookie_secure' => true,
    'cookie_httponly' => true,
    'cookie_samesite' => 'Strict'
]);

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "ntc_database";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
date_default_timezone_set('Asia/Manila');


$id  = 1; 

$stmt = $conn->prepare("SELECT status FROM system_status WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $status = strtolower(trim($row['status']));
} else {
    $status = 'offline';
}

if (isset($_POST['submit'])) {
    $systemNewstatus = $_POST['status'];

    $stmt = $conn->prepare("UPDATE system_status SET status = ? WHERE id = ?");
    $stmt->bind_param("ss", $systemNewstatus, $id);
    $stmt->execute();

    if ($result) {
        echo "<script>alert('Status Updated Successfully!'); window.location.href = 'system_status.php';</script>";
    } else {
        $error = "Error updating status: " . $stmt->error;
    }

}
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

         :root {
            --primary-color: #272BAE;
            --primary-hover: #1E2285;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --text-color: #333333;
            --light-bg: #f8f9fa;
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        .admin-container {
            max-width: 800px;
            margin: 2rem auto;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
        }
        
        .admin-header {
            background-color: var(--primary-color);
            color: white;
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .admin-header-content {
            flex: 1;
        }
        
        .admin-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        .admin-subtitle {
            font-size: 0.875rem;
            opacity: 0.9;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .status-indicator {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 6px;
        }
        
        .status-online {
            background-color: var(--success-color);
        }
        
        .status-offline {
            background-color: var(--danger-color);
        }
        
        .admin-body {
            padding: 2rem;
        }
        
        .status-card {
            background: var(--light-bg);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .status-label {
            font-weight: 500;
            color: #666;
        }
        
        .status-value {
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .form-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            border: 1px solid #e9ecef;
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        .form-control, .form-select {
            padding: 0.75rem 1rem;
            border-radius: var(--border-radius);
            border: 1px solid #ced4da;
            transition: border-color 0.15s ease-in-out;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(39, 43, 174, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-size: 0.875rem;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
        }
        
        .alert {
            border-radius: var(--border-radius);
        }
        
        .timestamp {
            font-size: 0.75rem;
            color: #6c757d;
            margin-top: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .admin-container {
                margin: 0;
                border-radius: 0;
            }
            
            .admin-body {
                padding: 1.5rem;
            }
            
            .status-card {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
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
          
            <!-- 'Logout' button with custom margin-top -->
            <a href="logout.php" class="btn btn-danger w-35 d-block mx-auto">Logout</a>

        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
   <div class="status-card">
                <div>
                    <div class="status-label">System Status</div>
                    <div class="status-value text-<?php echo $status === 'online' ? 'success' : 'danger'; ?>">
                        <?php echo ucfirst($status); ?>
                    </div>
                    <div class="timestamp">Last updated: <?php echo date('Y-m-d H:i:s'); ?></div>
                </div>
                <i class="bi bi-power" style="font-size: 2rem; color: <?php echo $status === 'online' ? 'var(--success-color)' : 'var(--danger-color)'; ?>"></i>
            </div>
            
            <div class="form-card">
                <h2 class="h5 mb-4"><i class="bi bi-sliders"></i> Status Configuration</h2>
                
                <form method="POST">
                    <div class="mb-4">
                        <label for="status" class="form-label">Set System Status</label>
                        <select class="form-select" name="status" id="status" required>
                            <option value="online" <?php echo $status === 'online' ? 'selected' : ''; ?>>Online - System is active</option>
                            <option value="offline" <?php echo $status === 'offline' ? 'selected' : ''; ?>>Offline - System is under maintenance</option>
                        </select>
                        <div class="form-text mt-2">
                            <i class="bi bi-info-circle"></i> Changing this status will affect all users immediately.
                        </div>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" name="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-save"></i> Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Add any necessary JavaScript here
        document.addEventListener('DOMContentLoaded', function() {
            // Example: Confirm before changing status
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const statusSelect = document.getElementById('status');
                const newStatus = statusSelect.value;
                const currentStatus = "<?php echo $status; ?>";
                
                if (newStatus !== currentStatus) {
                    const message = `Are you sure you want to change the system status to ${newStatus}?`;
                    if (!confirm(message)) {
                        e.preventDefault();
                    }
                }
            });
        });
        </script>

</body>
</html>