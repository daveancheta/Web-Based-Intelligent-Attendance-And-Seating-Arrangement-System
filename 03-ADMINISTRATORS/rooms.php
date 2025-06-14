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
    $conn->query("INSERT INTO room_430  (subject, start_time, end_time, block, professor, day) VALUES ('$subject', '$start_time', '$end_time', '$block', '$day', '$professor')");

    // Redirect to prevent resubmission on refresh
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
    $conn->query("UPDATE room_430 SET block='$block', professor='$professor', start_time='$start_time', end_time='$end_time', subject='$subject', day='$day' WHERE id=$id");

    header("Location:" . $_SERVER['PHP_SELF'] . "");
    exit();
}

// DELETE
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM room_430 WHERE id=$id");
}

// READ
$result = $conn->query("SELECT * FROM room_430");
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

        /* Main container */
        .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 80vh;
            padding: 0 10%;
        }

        .middle-content h1 {
            color: #160893;
            font-size: 2.5rem;


        }

        .middle-content p {
            font-size: 1.2rem;
            margin-top: 10px;
            color: #000000;
            font-weight: 500;

        }

        /* Right content (Box Grid) */
        .box-container {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 35px;
            width: 100%;
            height: 100%;
        }

        /* Individual Box */
        .box {
            background-color: #ffffff;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            border: 2px solid #160893;
            /* Adds a border around the container */
            transition: 0.3s;
        }

        .box:hover {
            box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.5);
        }

        /* Icon Placeholder */
        .box .icon {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .icon i {
            font-size: 40px;
            /* Adjust size */
            color: #160893;
            /* Change to your desired color */
        }


        /* Description Text */
        .box p {
            font-size: 1rem;
            color: #555;
            margin-top: 5px;
        }

        .middle-content {
            text-align: center;
            padding: 20px;
            margin: 0;
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
            <!-- 'Logout' button with custom margin-top -->
            <a href="logout.php" class="btn btn-danger w-35 d-block mx-auto">Logout</a>

        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">


       <div class="box-container">
    <!-- Room 101 to 130 -->
    <div class="box" onclick="window.location.href='room_101.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 101</h3>
    </div>
    <div class="box" onclick="window.location.href='room_102.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 102</h3>
    </div>
    <div class="box" onclick="window.location.href='room_103.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 103</h3>
    </div>
    <div class="box" onclick="window.location.href='room_104.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 104</h3>
    </div>
    <div class="box" onclick="window.location.href='room_105.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 105</h3>
    </div>
    <div class="box" onclick="window.location.href='room_106.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 106</h3>
    </div>
    <div class="box" onclick="window.location.href='room_107.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 107</h3>
    </div>
    <div class="box" onclick="window.location.href='room_108.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 108</h3>
    </div>
    <div class="box" onclick="window.location.href='room_109.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 109</h3>
    </div>
    <div class="box" onclick="window.location.href='room_110.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 110</h3>
    </div>
    <div class="box" onclick="window.location.href='room_111.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 111</h3>
    </div>
    <div class="box" onclick="window.location.href='room_112.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 112</h3>
    </div>
    <div class="box" onclick="window.location.href='room_113.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 113</h3>
    </div>
    <div class="box" onclick="window.location.href='room_114.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 114</h3>
    </div>
    <div class="box" onclick="window.location.href='room_115.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 115</h3>
    </div>
    <div class="box" onclick="window.location.href='room_116.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 116</h3>
    </div>
    <div class="box" onclick="window.location.href='room_117.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 117</h3>
    </div>
    <div class="box" onclick="window.location.href='room_118.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 118</h3>
    </div>
    <div class="box" onclick="window.location.href='room_119.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 119</h3>
    </div>
    <div class="box" onclick="window.location.href='room_120.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 120</h3>
    </div>
    <div class="box" onclick="window.location.href='room_121.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 121</h3>
    </div>
    <div class="box" onclick="window.location.href='room_122.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 122</h3>
    </div>
    <div class="box" onclick="window.location.href='room_123.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 123</h3>
    </div>
    <div class="box" onclick="window.location.href='room_124.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 124</h3>
    </div>
    <div class="box" onclick="window.location.href='room_125.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 125</h3>
    </div>
    <div class="box" onclick="window.location.href='room_126.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 126</h3>
    </div>
    <div class="box" onclick="window.location.href='room_127.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 127</h3>
    </div>
    <div class="box" onclick="window.location.href='room_128.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 128</h3>
    </div>
    <div class="box" onclick="window.location.href='room_129.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 129</h3>
    </div>
    <div class="box" onclick="window.location.href='room_130.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 130</h3>
    </div>

    <!-- Room 201 to 230 -->
    <div class="box" onclick="window.location.href='room_201.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 201</h3>
    </div>
    <div class="box" onclick="window.location.href='room_202.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 202</h3>
    </div>
    <div class="box" onclick="window.location.href='room_203.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 203</h3>
    </div>
    <div class="box" onclick="window.location.href='room_204.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 204</h3>
    </div>
    <div class="box" onclick="window.location.href='room_205.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 205</h3>
    </div>
    <div class="box" onclick="window.location.href='room_206.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 206</h3>
    </div>
    <div class="box" onclick="window.location.href='room_207.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 207</h3>
    </div>
    <div class="box" onclick="window.location.href='room_208.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 208</h3>
    </div>
    <div class="box" onclick="window.location.href='room_209.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 209</h3>
    </div>
    <div class="box" onclick="window.location.href='room_210.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 210</h3>
    </div>
    <div class="box" onclick="window.location.href='room_211.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 211</h3>
    </div>
    <div class="box" onclick="window.location.href='room_212.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 212</h3>
    </div>
    <div class="box" onclick="window.location.href='room_213.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 213</h3>
    </div>
    <div class="box" onclick="window.location.href='room_214.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 214</h3>
    </div>
    <div class="box" onclick="window.location.href='room_215.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 215</h3>
    </div>
    <div class="box" onclick="window.location.href='room_216.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 216</h3>
    </div>
    <div class="box" onclick="window.location.href='room_217.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 217</h3>
    </div>
    <div class="box" onclick="window.location.href='room_218.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 218</h3>
    </div>
    <div class="box" onclick="window.location.href='room_219.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 219</h3>
    </div>
    <div class="box" onclick="window.location.href='room_220.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 220</h3>
    </div>
    <div class="box" onclick="window.location.href='room_221.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 221</h3>
    </div>
    <div class="box" onclick="window.location.href='room_222.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 222</h3>
    </div>
    <div class="box" onclick="window.location.href='room_223.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 223</h3>
    </div>
    <div class="box" onclick="window.location.href='room_224.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 224</h3>
    </div>
    <div class="box" onclick="window.location.href='room_225.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 225</h3>
    </div>
    <div class="box" onclick="window.location.href='room_226.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 226</h3>
    </div>
    <div class="box" onclick="window.location.href='room_227.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 227</h3>
    </div>
    <div class="box" onclick="window.location.href='room_228.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 228</h3>
    </div>
    <div class="box" onclick="window.location.href='room_229.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 229</h3>
    </div>
    <div class="box" onclick="window.location.href='room_230.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 230</h3>
    </div>

    <!-- Room 301 to 330 -->
    <div class="box" onclick="window.location.href='room_301.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 301</h3>
    </div>
    <div class="box" onclick="window.location.href='room_302.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 302</h3>
    </div>
    <div class="box" onclick="window.location.href='room_303.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 303</h3>
    </div>
    <div class="box" onclick="window.location.href='room_304.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 304</h3>
    </div>
    <div class="box" onclick="window.location.href='room_305.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 305</h3>
    </div>
    <div class="box" onclick="window.location.href='room_306.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 306</h3>
    </div>
    <div class="box" onclick="window.location.href='room_307.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 307</h3>
    </div>
    <div class="box" onclick="window.location.href='room_308.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 308</h3>
    </div>
    <div class="box" onclick="window.location.href='room_309.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 309</h3>
    </div>
    <div class="box" onclick="window.location.href='room_310.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 310</h3>
    </div>
    <div class="box" onclick="window.location.href='room_311.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 311</h3>
    </div>
    <div class="box" onclick="window.location.href='room_312.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 312</h3>
    </div>
    <div class="box" onclick="window.location.href='room_313.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 313</h3>
    </div>
    <div class="box" onclick="window.location.href='room_314.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 314</h3>
    </div>
    <div class="box" onclick="window.location.href='room_315.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 315</h3>
    </div>
    <div class="box" onclick="window.location.href='room_316.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 316</h3>
    </div>
    <div class="box" onclick="window.location.href='room_317.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 317</h3>
    </div>
    <div class="box" onclick="window.location.href='room_318.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 318</h3>
    </div>
    <div class="box" onclick="window.location.href='room_319.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 319</h3>
    </div>
    <div class="box" onclick="window.location.href='room_320.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 320</h3>
    </div>
    <div class="box" onclick="window.location.href='room_321.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 321</h3>
    </div>
    <div class="box" onclick="window.location.href='room_322.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 322</h3>
    </div>
    <div class="box" onclick="window.location.href='room_323.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 323</h3>
    </div>
    <div class="box" onclick="window.location.href='room_324.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 324</h3>
    </div>
    <div class="box" onclick="window.location.href='room_325.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 325</h3>
    </div>
    <div class="box" onclick="window.location.href='room_326.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 326</h3>
    </div>
    <div class="box" onclick="window.location.href='room_327.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 327</h3>
    </div>
    <div class="box" onclick="window.location.href='room_328.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 328</h3>
    </div>
    <div class="box" onclick="window.location.href='room_329.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 329</h3>
    </div>
    <div class="box" onclick="window.location.href='room_330.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 330</h3>
    </div>

    <!-- Room 401 to 430 -->
    <div class="box" onclick="window.location.href='room_401.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 401</h3>
    </div>
    <div class="box" onclick="window.location.href='room_402.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 402</h3>
    </div>
    <div class="box" onclick="window.location.href='room_403.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 403</h3>
    </div>
    <div class="box" onclick="window.location.href='room_404.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 404</h3>
    </div>
    <div class="box" onclick="window.location.href='room_405.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 405</h3>
    </div>
    <div class="box" onclick="window.location.href='room_406.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 406</h3>
    </div>
    <div class="box" onclick="window.location.href='room_407.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 407</h3>
    </div>
    <div class="box" onclick="window.location.href='room_408.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 408</h3>
    </div>
    <div class="box" onclick="window.location.href='room_409.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 409</h3>
    </div>
    <div class="box" onclick="window.location.href='room_410.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 410</h3>
    </div>
    <div class="box" onclick="window.location.href='room_411.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 411</h3>
    </div>
    <div class="box" onclick="window.location.href='room_412.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 412</h3>
    </div>
    <div class="box" onclick="window.location.href='room_413.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 413</h3>
    </div>
    <div class="box" onclick="window.location.href='room_414.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 414</h3>
    </div>
    <div class="box" onclick="window.location.href='room_415.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 415</h3>
    </div>
    <div class="box" onclick="window.location.href='room_416.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 416</h3>
    </div>
    <div class="box" onclick="window.location.href='room_417.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 417</h3>
    </div>
    <div class="box" onclick="window.location.href='room_418.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 418</h3>
    </div>
    <div class="box" onclick="window.location.href='room_419.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 419</h3>
    </div>
    <div class="box" onclick="window.location.href='room_420.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 420</h3>
    </div>
    <div class="box" onclick="window.location.href='room_421.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 421</h3>
    </div>
    <div class="box" onclick="window.location.href='room_422.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 422</h3>
    </div>
    <div class="box" onclick="window.location.href='room_423.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 423</h3>
    </div>
    <div class="box" onclick="window.location.href='room_424.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 424</h3>
    </div>
    <div class="box" onclick="window.location.href='room_425.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 425</h3>
    </div>
    <div class="box" onclick="window.location.href='room_426.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 426</h3>
    </div>
    <div class="box" onclick="window.location.href='room_427.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 427</h3>
    </div>
    <div class="box" onclick="window.location.href='room_428.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 428</h3>
    </div>
    <div class="box" onclick="window.location.href='room_429.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 429</h3>
    </div>
    <div class="box" onclick="window.location.href='room_430.php';" style="cursor: pointer;">
        <div class="icon"><i class="fas fa-door-open"></i></div>
        <h3>Room 430</h3>
    </div>
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