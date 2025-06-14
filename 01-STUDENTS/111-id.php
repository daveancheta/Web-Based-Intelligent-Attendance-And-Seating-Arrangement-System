<?php
// Set timezone - important for correct time display
date_default_timezone_set('Asia/Manila'); // Change to your timezone

// Current date and time functions
function getCurrentDate($format = 'Y-m-d') {
    return date($format);
}

function getCurrentTime($format = 'h:i:s A') {
    return date($format);
}

function getCurrentDateTime($format = 'Y-m-d h:i:s A') {
    return date($format);
}

// Format time from database (e.g., convert "14:30:00" to "2:30 PM")
function formatTime($time, $format = 'h:i A') {
    return date($format, strtotime($time));
}

// Format date from database
function formatDate($date, $format = 'F j, Y') {
    return date($format, strtotime($date));
}

// Show time difference
function getTimeDifference($datetime) {
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
function getCurrentDay() {
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
    <title>PHP Time Display with Live Clock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .time-display {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .date-display {
            font-size: 1.5rem;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .auto-refresh {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Current Time Card -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white text-center">
                        <h2 class="mb-0">Current Time</h2>
                    </div>
                    <div class="card-body text-center py-4">
                        <div class="time-display" id="live-clock"><?php echo $current_time; ?></div>
                        <div class="date-display mt-2" id="live-date"><?php echo $current_day; ?>, <?php echo $current_date; ?></div>
                        <div class="auto-refresh">Time updates every second</div>
                    </div>
                </div>
                
                <!-- Example: Class Schedule -->
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0">Today's Schedule</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Time</th>
                                    <th>Room</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Example schedule data (in a real app, this would come from the database)
                                $schedule = [
                                    [
                                        'subject' => 'Mathematics',
                                        'start_time' => '08:30:00',
                                        'end_time' => '10:00:00',
                                        'room' => '101'
                                    ],
                                    [
                                        'subject' => 'English',
                                        'start_time' => '10:30:00',
                                        'end_time' => '12:00:00',
                                        'room' => '101'
                                    ],
                                    [
                                        'subject' => 'Science',
                                        'start_time' => '13:30:00',
                                        'end_time' => '15:00:00',
                                        'room' => '102'
                                    ]
                                ];
                                
                                $current_timestamp = time();
                                
                                foreach ($schedule as $class):
                                    $start_timestamp = strtotime($class['start_time']);
                                    $end_timestamp = strtotime($class['end_time']);
                                    
                                    // Determine class status
                                    if ($current_timestamp < $start_timestamp) {
                                        $status = 'Upcoming';
                                        $status_class = 'text-primary';
                                    } elseif ($current_timestamp >= $start_timestamp && $current_timestamp <= $end_timestamp) {
                                        $status = 'Ongoing';
                                        $status_class = 'text-success';
                                    } else {
                                        $status = 'Completed';
                                        $status_class = 'text-muted';
                                    }
                                ?>
                                <tr>
                                    <td><?php echo $class['subject']; ?></td>
                                    <td><?php echo formatTime($class['start_time']); ?> - <?php echo formatTime($class['end_time']); ?></td>
                                    <td>Room <?php echo $class['room']; ?></td>
                                    <td class="<?php echo $status_class; ?>"><?php echo $status; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Date Time Format Examples -->
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h3 class="mb-0">Date & Time Format Examples</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Date Formats</h4>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Short Date:</span>
                                        <strong><?php echo getCurrentDate('m/d/Y'); ?></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Long Date:</span>
                                        <strong><?php echo getCurrentDate('l, F j, Y'); ?></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>MySQL Format:</span>
                                        <strong><?php echo getCurrentDate('Y-m-d'); ?></strong>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h4>Time Formats</h4>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>12-hour:</span>
                                        <strong><?php echo getCurrentTime('h:i:s A'); ?></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>24-hour:</span>
                                        <strong><?php echo getCurrentTime('H:i:s'); ?></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Short Time:</span>
                                        <strong><?php echo getCurrentTime('h:i A'); ?></strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Function to update the clock
    function updateClock() {
        const now = new Date();
        
        // Format time (12-hour format with AM/PM)
        let hours = now.getHours();
        const ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12; // Convert 0 to 12
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');
        
        // Format date
        const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const dayName = days[now.getDay()];
        const monthName = months[now.getMonth()];
        const date = now.getDate();
        const year = now.getFullYear();
        
        // Update the clock display
        document.getElementById('live-clock').textContent = 
            `${hours}:${minutes}:${seconds} ${ampm}`;
        
        // Update the date display
        document.getElementById('live-date').textContent = 
            `${dayName}, ${monthName} ${date}, ${year}`;
        
        // Update every second
        setTimeout(updateClock, 1000);
    }
    
    // Start the clock when the page loads
    document.addEventListener('DOMContentLoaded', updateClock);
    </script>
</body>
</html>