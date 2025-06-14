<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "ntc_database";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Count all records in the table
$sql = "SELECT COUNT(*) AS total FROM data_student";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$totalCount = $row['total'];

// Count all records in the table
$sql1 = "SELECT COUNT(*) AS total FROM teacher_accounts";
$result1 = $conn->query($sql1);
$row1 = $result1->fetch_assoc();
$totalCount1 = $row1['total'];

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">


    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            /* Remove horizontal scrollbar */
            background-color: #f8f9fa;
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

        .user-count-box {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: transform 0.2s;
        }

        .user-count-box:hover {
            transform: translateY(-5px);
        }

        .user-icon {
            font-size: 40px;
            color: #0d6efd;
            margin-bottom: 15px;
        }

        .user-count-box h3 {
            margin: 0;
            font-size: 22px;
            color: #333;
        }

        .user-count-box p {
            font-size: 36px;
            font-weight: bold;
            color: #0d6efd;
            margin: 5px 0 0;
        }

        /* Improved chart card styling */
        .chart-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .chart-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .chart-card .card-header {
            padding: 16px 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .chart-card .card-body {
            padding: 1.5rem;
        }

        .chart-title {
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .chart-title i {
            margin-right: 10px;
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
    <div class="main-content py-5">
        <div class="container">
            <div class="row g-4 justify-content-center">

                <!-- Total Students -->
                <div class="col-12 col-md-4">
                    <div class="user-count-box text-center">
                        <div class="user-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h3>Total Students</h3>
                        <p><?php echo $totalCount; ?></p>
                    </div>
                </div>

                <!-- Total Teachers -->
                <div class="col-12 col-md-4">
                    <div class="user-count-box text-center">
                        <div class="user-icon">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                        <h3>Total Teachers</h3>
                        <p><?php echo $totalCount1; ?></p>
                    </div>
                </div>

                <!-- Total Rooms -->
                <div class="col-12 col-md-4">
                    <div class="user-count-box text-center">
                        <div class="user-icon">
                            <i class="bi bi-door-open-fill"></i>
                        </div>
                        <h3>Total Rooms</h3>
                        <p>120</p>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="container mt-4 mb-5">
                    <h4 class="mb-4 text-dark fw-bold"><i class="fas fa-chart-line me-2"></i>Analytics Dashboard</h4>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card chart-card h-100">
                                <div class="card-header bg-white">
                                    <h5 class="chart-title mb-0"><i class="fas fa-chart-pie text-primary"></i>User Distribution</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="userPieChart" height="260"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card chart-card h-100">
                                <div class="card-header bg-white">
                                    <h5 class="chart-title mb-0"><i class="fas fa-chart-bar text-success"></i>User Comparison</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="userBarChart" height="260"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Sidebar Toggle Script -->
    <script>
        document.getElementById('toggleSidebar').onclick = function() {
            document.getElementById('sidebar').classList.toggle('active');
        };

        // Color palette for a professional look
        const colorPalette = {
            primary: ['rgba(25, 118, 210, 0.8)', 'rgba(25, 118, 210, 1)'],
            secondary: ['rgba(46, 125, 50, 0.8)', 'rgba(46, 125, 50, 1)'],
            accent1: ['rgba(245, 124, 0, 0.8)', 'rgba(245, 124, 0, 1)'],
            accent2: ['rgba(123, 31, 162, 0.8)', 'rgba(123, 31, 162, 1)'],
            background: ['rgba(255, 255, 255, 0.9)']
        };

        // Pie Chart for User Distribution
        const pieCtx = document.getElementById('userPieChart').getContext('2d');
        const userPieChart = new Chart(pieCtx, {
            type: 'doughnut', // Changed from pie to doughnut for a more modern look
            data: {
                labels: ['Students', 'Teachers'],
                datasets: [{
                    data: [<?php echo $totalCount; ?>, <?php echo $totalCount1; ?>],
                    backgroundColor: [
                        colorPalette.primary[0],
                        colorPalette.secondary[0]
                    ],
                    borderColor: [
                        colorPalette.primary[1],
                        colorPalette.secondary[1]
                    ],
                    borderWidth: 1,
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%', // Makes the doughnut thinner
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            font: {
                                family: 'Poppins',
                                size: 12
                            },
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0,0,0,0.8)',
                        padding: 12,
                        titleFont: {
                            family: 'Poppins',
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            family: 'Poppins',
                            size: 13
                        },
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const value = context.raw;
                                const percentage = Math.round((value / total) * 100);
                                label += value + ' (' + percentage + '%)';
                                return label;
                            }
                        }
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true,
                    duration: 2000
                }
            }
        });

        // Bar Chart for User Comparison
        const barCtx = document.getElementById('userBarChart').getContext('2d');
        const userBarChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Students', 'Teachers'],
                datasets: [{
                    label: 'User Count',
                    data: [<?php echo $totalCount; ?>, <?php echo $totalCount1; ?>],
                    backgroundColor: [
                        colorPalette.primary[0],
                        colorPalette.secondary[0]
                    ],
                    borderColor: [
                        colorPalette.primary[1],
                        colorPalette.secondary[1]
                    ],
                    borderWidth: 1,
                    borderRadius: 6,
                    maxBarThickness: 80
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'x', // Makes the bars vertical
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            precision: 0,
                            font: {
                                family: 'Poppins',
                                size: 12
                            },
                            color: '#666'
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                family: 'Poppins',
                                size: 12,
                                weight: 'bold'
                            },
                            color: '#333'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0,0,0,0.8)',
                        padding: 12,
                        titleFont: {
                            family: 'Poppins',
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            family: 'Poppins',
                            size: 13
                        },
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.parsed.y;
                                return label;
                            }
                        }
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                }
            }
        });
    </script>

</body>

</html>