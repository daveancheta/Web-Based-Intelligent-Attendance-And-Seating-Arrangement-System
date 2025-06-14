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

// Check if session variables exist
if (
    !isset($_SESSION['subject']) || !isset($_SESSION['class_time']) || !isset($_SESSION['block']) ||
    !isset($_SESSION['class_days']) || !isset($_SESSION['professor']) || !isset($_SESSION['room'])
) {
    echo "<script>alert('Please select a class first.'); window.location.href = '09-room.php';</script>";
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
$current_subject = $_SESSION['subject'];
$email1 = $_SESSION['F_email'];
$email2 = $_SESSION['M_email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $seat_number = isset($_POST['seat_number']) ? mysqli_real_escape_string($conn, $_POST['seat_number']) : "";

    // Check if the seat number OR student number already exists for this subject
    $check_query = "SELECT * FROM info_ass 
                   WHERE (seat_number = '$seat_number' OR student_number = '$student_number')
                   AND subject = '$current_subject'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('This seat is already assigned to another student, or your student number is already registered for this subject.'); window.location.href = '15-room-sched.php';</script>";
    } else {
        // Insert Query using session variables
        $sql = "INSERT INTO info_ass (seat_number, student_number, student_name, subject, class_time, block, class_days, room, professor) 
                VALUES ('$seat_number', '$student_number', '" . $_SESSION['first_name'] . " " . $_SESSION['middle_name'] . " " . $_SESSION['surname'] . "', '$current_subject', '" . $_SESSION['class_time'] . "', '" . $_SESSION['block'] . "', '" . $_SESSION['class_days'] . "', '" . $_SESSION['room'] . "', '" . $_SESSION['professor'] . "')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Seat Registered successfully'); window.location.href = '15-room-sched.php';</script>";
        } else {
            echo "<script>alert('Error occurred while registering the seat'); window.location.href = '15-room-sched.php';</script>";
        }
    }
}

// Get seats only for the current subject
$sql = "SELECT student_number, seat_number FROM info_ass 
        WHERE subject = '" . mysqli_real_escape_string($conn, $current_subject) . "' 
        ORDER BY seat_number ASC";
$result = $conn->query($sql);

$id = 1; // Replace this with the actual ID you want to filter by

$stmt = $conn->prepare("SELECT status FROM attendance WHERE id = ?");
$stmt->bind_param("i", $id); // assuming 'id' is an integer
$stmt->execute();
$result1 = $stmt->get_result();

if ($result1 && $result1->num_rows > 0) {
    $row = $result1->fetch_assoc();
    $status = strtolower(trim($row['status']));
} else {
    $status = 'offline';
}

$student_number = $_SESSION['student_number'];
$current_subject = $_SESSION['subject'];

$stmt1 = $conn->prepare("SELECT status FROM info_ass WHERE student_number = ? AND subject = ?");
$stmt1->bind_param("ss", $student_number, $current_subject); // student_number is likely a string
$stmt1->execute();
$result2 = $stmt1->get_result();

if ($result2 && $result2->num_rows > 0) {
    $row = $result2->fetch_assoc();
    $status2 = strtolower(trim($row['status']));
} else {
    $status2 = 'offline';
}

// Set timezone - important for correct time display
date_default_timezone_set('Asia/Manila'); // Change to your timezone

// Current date and time functions
function getCurrentDate($format = 'Y-m-d')
{
    return date($format);
}

function getCurrentTime($format = 'h:i:s A')
{
    return date($format);
}

function getCurrentDateTime($format = 'Y-m-d h:i:s A')
{
    return date($format);
}

// Format time from database (e.g., convert "14:30:00" to "2:30 PM")
function formatTime($time, $format = 'h:i A')
{
    return date($format, strtotime($time));
}

// Format date from database
function formatDate($date, $format = 'F j, Y')
{
    return date($format, strtotime($date));
}

// Show time difference
function getTimeDifference($datetime)
{
    $time_diff = time() - strtotime($datetime);

    if ($time_diff < 60) {
        return "Just now";
    } elseif ($time_diff < 3600) {
        return floor($time_diff / 60) . " minutes ago";
    } elseif ($time_diff < 86400) {
        return floor($time_diff / 3600) . " hours ago";
    } else {
        return floor($time_diff / 86400) . " days ago";
    }
}

// Get current day name
function getCurrentDay()
{
    return date('l'); // Monday, Tuesday, etc.
}

// Example usage variables
$current_date = getCurrentDate('F j, Y'); // May 4, 2025
$current_time = getCurrentTime('h:i:s A'); // 02:30:45 PM
$current_day = getCurrentDay(); // Sunday

// For schedule display (similar to your room_101 query)
$class_time_from_db = "14:30:00"; // Example time from database
$formatted_class_time = formatTime($class_time_from_db); // 2:30 PM
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance - <?php echo htmlspecialchars($_SESSION['subject'] ?? ''); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Winky+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="image/ntc-logo-1.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Winky Sans", sans-serif;
    }

    .navbar {
        background-color: white;
        overflow: hidden;
        padding: 10px 20px;
    }

    .navbar img {
        height: 60px;
        vertical-align: middle;
    }

    .navbar a {
        float: left;
        color: #160893;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 24px;
        font-weight: 600;
    }

    hr {
        border: none;
        height: 2px;
        background-color: #444;
        margin: 0;
        opacity: 1;
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

    .box {
        background-color: #ffffff;
        padding: 0px;
        text-align: center;
        border-radius: 10px;
        border: 2px solid #160893;
    }

    .box .icon {
        font-size: 40px;
        margin-bottom: 10px;
    }

    .icon i {
        font-size: 40px;
        color: #160893;
    }

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

    h3,
    p,
    strong,
    button,
    select,
    option {
        font-family: 'Poppins', sans-serif;
        font-weight: bold;
        margin: 10px;
    }

    h3 {
        color: #160893;
        text-transform: uppercase;
    }

    .rounded-pill {
        background-color: #160893;
        color: #ffffff;
        border: none;
    }

    .imgs {
        width: 50%;
        height: auto;
        display: block;
        margin: auto;
    }

    .class-info {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        font-family: 'Poppins', sans-serif;
    }

    .class-info h4 {
        color: #160893;
        margin-bottom: 15px;
    }

    .class-info p {
        margin: 5px 0;
        font-size: 14px;
    }

    .class-info strong {
        color: #333;
    }

    .no-seats-message {
        text-align: center;
        width: 100%;
        padding: 20px;
    }

    @media screen and (max-width: 768px) {
        .middle-content {
            padding: 15px;
        }

        .box {
            padding: 10px;
            font-size: 14px;
        }

        .icon i {
            font-size: 30px;
        }

        .imgs {
            width: 80%;
        }
    }

    @media screen and (max-width: 480px) {
        .navbar a {
            font-size: 18px;
        }

        .middle-content h1 {
            font-size: 1.8rem;
        }

        .box {
            width: 90%;
            margin: auto;
        }

        .imgs {
            width: 90%;
        }
    }
</style>

<body>
    <div class="navbar">
        <a href="04-home.php">
            <img src="image/ntc-logo-1.png" alt="Logo">
            NATIONAL TEACHERS COLLEGE
        </a>
    </div>
    <hr>
    <button class="btn text-white" data-bs-toggle="modal" data-bs-target="#myModal" style="background-color: #160893; font-family: 'Poppins', sans serif;">
        Seating Arrangement
    </button>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-family: 'Poppins', sans serif;">Seating Arrangement</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center" style="font-family: 'Poppins', sans serif;">
                    Not Laboratory
                    <img src="./image/notlab.jpg" alt="Not Laboratory Image" style="width: 100%;">
                    Laboratory
                    <img src="./image/lab.png" alt="Laboratory Image" style="width: 100%;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="font-family: 'Poppins', sans serif;">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php if ($status === 'register'): ?>
        <div class="middle-content">
            <h1><?php echo htmlspecialchars($_SESSION['subject'] ?? ''); ?></h1>
            <!-- Button trigger modal -->
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background-color: #160893; color: white; font-family: 'Poppins', sans serif">
                Select your Seat
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Select your Seat</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">
                                <select name="seat_number" id="seat_number" required>
                                    <option value="" disabled selected style="font-family: 'Poppins', sans-serif;">Select your Seat</option>
                                    <option value="S1">Seat 1</option>
                                    <option value="S2">Seat 2</option>
                                    <option value="S3">Seat 3</option>
                                    <option value="S4">Seat 4</option>
                                    <option value="S5">Seat 5</option>
                                    <option value="S6">Seat 6</option>
                                    <option value="S7">Seat 7</option>
                                    <option value="S8">Seat 8</option>
                                    <option value="S9">Seat 9</option>
                                    <option value="S10">Seat 10</option>
                                    <option value="S11">Seat 11</option>
                                    <option value="S12">Seat 12</option>
                                    <option value="S13">Seat 13</option>
                                    <option value="S14">Seat 14</option>
                                    <option value="S15">Seat 15</option>
                                    <option value="S16">Seat 16</option>
                                    <option value="S17">Seat 17</option>
                                    <option value="S18">Seat 18</option>
                                    <option value="S19">Seat 19</option>
                                    <option value="S20">Seat 20</option>
                                    <option value="S21">Seat 21</option>
                                    <option value="S22">Seat 22</option>
                                    <option value="S23">Seat 23</option>
                                    <option value="S24">Seat 24</option>
                                    <option value="S25">Seat 25</option>
                                    <option value="S26">Seat 26</option>
                                    <option value="S27">Seat 27</option>
                                    <option value="S28">Seat 28</option>
                                    <option value="S29">Seat 29</option>
                                    <option value="S30">Seat 30</option>
                                    <option value="S31">Seat 31</option>
                                    <option value="S32">Seat 32</option>
                                    <option value="S33">Seat 33</option>
                                    <option value="S34">Seat 34</option>
                                    <option value="S35">Seat 35</option>
                                    <option value="S36">Seat 36</option>
                                    <option value="S37">Seat 37</option>
                                    <option value="S38">Seat 38</option>
                                    <option value="S39">Seat 39</option>
                                    <option value="S40">Seat 40</option>
                                    <option value="S41">Seat 41</option>
                                    <option value="S42">Seat 42</option>
                                    <option value="S43">Seat 43</option>
                                    <option value="S44">Seat 44</option>
                                    <option value="S45">Seat 45</option>
                                    <option value="S46">Seat 46</option>
                                    <option value="S47">Seat 47</option>
                                    <option value="S48">Seat 48</option>
                                    <option value="S49">Seat 49</option>
                                    <option value="S50">Seat 50</option>
                                    <option value="S51">Seat 51</option>
                                    <option value="S52">Seat 52</option>
                                    <option value="S53">Seat 53</option>
                                    <option value="S54">Seat 54</option>
                                    <option value="S55">Seat 55</option>
                                    <option value="S56">Seat 56</option>
                                    <option value="S57">Seat 57</option>
                                    <option value="S58">Seat 58</option>
                                    <option value="S59">Seat 59</option>
                                    <option value="S60">Seat 60</option>
                                </select>
                                <input type="hidden" name="subject" value="<?php echo htmlspecialchars($_SESSION['subject'] ?? ''); ?>">
                                <input type="hidden" name="class_time" value="<?php echo htmlspecialchars($_SESSION['class_time'] ?? ''); ?>">
                                <input type="hidden" name="block" value="<?php echo htmlspecialchars($_SESSION['block'] ?? ''); ?>">
                                <input type="hidden" name="class_days" value="<?php echo htmlspecialchars($_SESSION['class_days'] ?? ''); ?>">
                                <input type="hidden" name="professor" value="<?php echo htmlspecialchars($_SESSION['professor'] ?? ''); ?>">
                                <input type="hidden" name="room" value="<?php echo htmlspecialchars($_SESSION['room'] ?? ''); ?>">
                                <input type="hidden" name="student_number" value="<?php echo htmlspecialchars($student_number); ?>">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="font-family: 'Poppins', sans serif">Close</button>
                                <button type="submit" class="btn" style="background-color: #160893; color: white; font-family: 'Poppins', sans serif">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container containers">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-5 g-4">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col">';
                        echo '<div class="box h-100">';
                        echo '<h3>' . htmlspecialchars($row["seat_number"]) . '</h3>';
                        echo '<p><strong>' . htmlspecialchars($row["student_number"]) . '</strong></p>';
                        echo '<button class="rounded-pill"><i class="fa-solid fa-check fs-3"></i></button>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="col-12 no-seats-message">';
                    echo '<div class="alert alert-info text-center" style="max-width: 600px; margin: 0 auto; border-radius: 10px;"><i class="bi bi-person-wheelchair"></i> No registered seats for ' . htmlspecialchars($current_subject) . ' as of now</div>';
                    echo '</div>';
                }
                $conn->close();
                ?>
            </div>
        </div>
        <img src="image/seat normsdal.png" alt="" class="img-fluid imgs">
    <?php else: ?>
        <div class="middle-content">
            <h1><?php echo htmlspecialchars($_SESSION['subject'] ?? ''); ?></h1>
            <div class="card-body text-center py-4">
                <div class="time-display" id="live-clock" style="display: none;"><?php echo $current_time; ?></div>
                <div class="date-display mt-2" id="live-date" style="display: none;"><?php echo $current_day; ?>, <?php echo $current_date; ?></div>
            </div>
            <div class="container containers">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-5 g-4">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $isCurrentUser = $row["student_number"] === $_SESSION['student_number'];
                    ?>
                            <div class="col">
                                <div class="box h-100" <?php if ($isCurrentUser): ?> data-bs-toggle="modal" data-bs-target="#exampleModal" style="cursor: pointer;" <?php endif; ?>>
                                    <h3><?php echo htmlspecialchars($row["seat_number"]); ?></h3>
                                    <p><strong><?php echo htmlspecialchars($row["student_number"]); ?></strong></p>
                                    <button class="rounded-pill"><i class="fa-solid fa-check fs-3"></i></button>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<div class="col-12 no-seats-message">';
                        echo '<div class="alert alert-info text-center" style="max-width: 600px; margin: 0 auto; border-radius: 10px;"><i class="bi bi-person-wheelchair"></i> No registered seats for ' . htmlspecialchars($current_subject) . ' as of now</div>';
                        echo '</div>';
                    }
                    $conn->close();
                    ?>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-family: 'Poppins', sans serif;">Attendance</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="font-family: 'Poppins', sans serif;">
                            Mark your attendance as present?
                            <form action="attendance-present.php" method="POST">
                                <input type="hidden" name="student_number" value="<?php echo htmlspecialchars($student_number); ?>">
                                <input type="hidden" name="subject" value="<?php echo htmlspecialchars($_SESSION['subject'] ?? ''); ?>">
                                <input type="hidden" name="timein" value="<?php echo $current_time; ?>">
                                <input type="hidden" name="block" value="<?php echo htmlspecialchars($_SESSION['block'] ?? ''); ?>">
                                <input type="hidden" name="datentime" value="<?php echo htmlspecialchars($current_date); ?>">
                                <input type="hidden" name="email1" value="<?php echo htmlspecialchars($_SESSION['F_email'] ?? ''); ?>">
                                <input type="hidden" name="email2" value="<?php echo htmlspecialchars($_SESSION['M_email'] ?? ''); ?>">
                                <input type="hidden" name="status" value="present">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="font-family: 'Poppins', sans serif;">Close</button>
                                    <?php if ($status2 === 'present'): ?>
                                        <button type="submit" name="submit" class="btn btn-dark text-white" disabled style="font-family: 'Poppins', sans serif; cursor: not-allowed;">Attendance Done</button>
                                    <?php else: ?>
                                        <button type="submit" name="submit" class="btn" style="font-family: 'Poppins', sans serif; background-color: #160893; color: white;">Mark as Present</button>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="image/seat normsdal.png" alt="" class="img-fluid imgs">
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to update the clock
        function updateClock() {
            const now = new Date();
            let hours = now.getHours();
            const ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12;
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');
            const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            const dayName = days[now.getDay()];
            const monthName = months[now.getMonth()];
            const date = now.getDate();
            const year = now.getFullYear();
            document.getElementById('live-clock').textContent = `${hours}:${minutes}:${seconds} ${ampm}`;
            document.getElementById('live-date').textContent = `${dayName}, ${monthName} ${date}, ${year}`;
            setTimeout(updateClock, 1000);
        }
        document.addEventListener('DOMContentLoaded', updateClock);
    </script>
</body>

</html>