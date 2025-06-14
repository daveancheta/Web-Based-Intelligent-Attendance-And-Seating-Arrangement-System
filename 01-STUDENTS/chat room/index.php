<?php
// Update your index.php file with these changes

// Add this code where your PHP processing starts (before the HTML)
require 'db.php';
session_start();

// Handle room creation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['room_name'])) {
    $room_name = trim($_POST['room_name']);
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : NULL;

    if (!empty($room_name)) {
        $stmt = $conn->prepare("INSERT INTO rooms (name, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $room_name, $password);
        $stmt->execute();
        $stmt->close();
    }

    // Simply redirect back to index instead of exiting
    header("Location: index.php");
    exit();
}

// Check for join_error to display if redirected due to error
// This is for displaying error messages in non-JS solution
if (isset($_SESSION['join_error']) && !isset($_GET['room_id'])) {
    $join_error = $_SESSION['join_error'];
    $join_room_id = isset($_SESSION['join_room_id']) ? $_SESSION['join_room_id'] : 0;
}


// Get student number from session for the modal
$student_number = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : '';

// Fetch rooms as before
$rooms = $conn->query("SELECT id, name, password FROM rooms ORDER BY created_at ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Keep your existing head content -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chat Rooms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="image/ntc-logo-1.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sigmar&family=Winky+Sans:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <!-- Keep your existing styles and add modal styles -->
    <style>
        /* Your existing styles */
        :root {
            --primary-color: #160893;
            --secondary-color: #160893;
            --bg-color:rgb(255, 255, 255);
            --card-color: #ffffff;
            --text-color: #050505;
            --text-secondary: #65676b;
        }

        body {
            background-color: var(--bg-color);
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Styling the navigation bar */
        .navbar {
            overflow: hidden;
            padding: 10px 20px;
        }

        /* Logo styling */
        .navbar img {
            height: 60px;
            vertical-align: middle;
        }

        /* Text styling */
        .navbar a {
            float: left;
            color: #160893;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 24px;
            font-weight: 600;
            font-family: 'Winky sans', sans-serif;
        }

        hr {
            border: none;
            height: 2px;
            background-color: black;
            margin: 0;
            opacity: 1;
        }
        
        .messenger-container {
            width: 100%;
            max-width: 900px;
            background-color: var(--card-color);
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1), 0 8px 16px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            height: 80vh;
            margin: 20px auto;
        }

        .header {
            background-color: var(--primary-color);
            color: white;
            padding: 15px 20px;
            text-align: center;
            border-top-right-radius: 8px;
            border-top-left-radius: 8px;
        }

        .header h2 {
            margin: 0;
            font-weight: 600;
        }

        .create-room {
            padding: 20px;
            border-bottom: 1px solid #ddd;
        }

        .form-control {
            border-radius: 6px;
            padding: 10px;
            border: 1px solid #dddfe2;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px #e7f3ff;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            border-radius: 6px;
            padding: 10px;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #166fe5;
        }

        .btn-success {
            background-color: var(--secondary-color);
            border: none;
            border-radius: 6px;
            padding: 10px;
            font-weight: 600;
        }

        .btn-success:hover {
            background-color: #160893;
        }

        .rooms-list {
            flex: 1;
            overflow-y: auto;
        }

        .room-item {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            border-bottom: 1px solid #e4e6eb;
            transition: background-color 0.2s;
            cursor: pointer;
        }

        .room-item:hover {
            background-color: #f5f6f7;
        }

        .room-icon {
            width: 40px;
            height: 40px;
            background-color: #e4e6eb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            color: var(--primary-color);
            font-size: 18px;
        }

        .room-details {
            flex: 1;
        }

        .room-name {
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 2px;
        }

        .room-status {
            font-size: 13px;
            color: var(--text-secondary);
        }

        .join-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 14px;
            font-weight: 600;
            white-space: nowrap;
        }

        .join-btn.locked {
            background-color: #e4e6eb;
            color: var(--text-color);
        }

        .join-btn.locked i {
            margin-right: 5px;
        }

        .rooms-list::-webkit-scrollbar {
            width: 8px;
        }

        .rooms-list::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .rooms-list::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        .rooms-list::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Modal styles */
        .modal-header {
            background-color: var(--primary-color);
            color: white;
        }
        
        .modal-header .btn-close {
            filter: invert(1) brightness(200%); /* This makes the close button white */
            opacity: 0.8;
        }
        
        .modal-header .btn-close:hover {
            opacity: 1;
        }
        
        .modal-title {
            font-weight: 600;
        }
        
        .modal-error {
            color: #dc3545;
            margin-bottom: 15px;
            display: none;
        }

        @media (max-width: 576px) {
            .messenger-container {
                border-radius: 0;
                height: 100vh;
                margin: 0;
            }
            .header {
                border-radius: 0;
            }

            .rooms-list {
                max-height: none;
                flex: 1;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="../04-home.php">
            <img src="image/ntc-logo-1.png" alt="Logo">
            NATIONAL TEACHERS COLLEGE
        </a>
    </div>
    <hr>
    <div class="messenger-container">
        <div class="header">
            <h2><i class="fas fa-comments"></i> Chat Rooms</h2>
        </div>

    

        <div class="rooms-list">
            <?php while ($room = $rooms->fetch_assoc()): ?>
                <div class="room-item">
                    <div class="room-icon">
                        <i class="fas fa-door-open"></i>
                    </div>
                    <div class="room-details">
                        <div class="room-name"><?php echo htmlspecialchars($room['name']); ?></div>
                        <div class="room-status"><?php echo $room['password'] ? 'Private room' : 'Public room'; ?></div>
                    </div>
                    <?php if ($room['password']): ?>
                        <!-- Button for password-protected room -->
                        <button class="join-btn locked" data-bs-toggle="modal" data-bs-target="#passwordModal<?php echo $room['id']; ?>">
                            <i class="fas fa-lock"></i> Join
                        </button>
                    <?php else: ?>
                        <!-- Direct form submission for non-password rooms -->
                        <form method="POST" action="join_room_process.php" style="margin:0">
                            <input type="hidden" name="room_id" value="<?php echo $room['id']; ?>">
                            <input type="hidden" name="user_name" value="<?php echo htmlspecialchars($student_number); ?>">
                            <button type="submit" class="join-btn">Join</button>
                        </form>
                    <?php endif; ?>
                </div>
                
                <?php if ($room['password']): ?>
                <!-- Password Modal for each protected room -->
                <div class="modal fade" id="passwordModal<?php echo $room['id']; ?>" tabindex="-1" aria-labelledby="passwordModalLabel<?php echo $room['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="passwordModalLabel<?php echo $room['id']; ?>">Join Room: <?php echo htmlspecialchars($room['name']); ?></h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="join_room_process.php">
                                <div class="modal-body">
                                    <?php if (isset($_SESSION['join_error']) && $_SESSION['join_room_id'] == $room['id']): ?>
                                        <div class="alert alert-danger">
                                            <?php 
                                                echo $_SESSION['join_error']; 
                                                unset($_SESSION['join_error']);
                                                unset($_SESSION['join_room_id']);
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <input type="hidden" name="room_id" value="<?php echo $room['id']; ?>">
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Your Name</label>
                                        <input type="text" class="form-control" name="user_name" value="<?php echo htmlspecialchars($student_number); ?>" readonly>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Room Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Enter room password" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Join Room</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            <?php endwhile; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>