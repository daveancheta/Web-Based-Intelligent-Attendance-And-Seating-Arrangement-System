<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ntc_database";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT start_time, end_time, block, professor, day, subject, password FROM room_109 ORDER BY start_time ASC";
$result = $conn->query($sql);

$id = 1; 

$stmt = $conn->prepare("SELECT status FROM attendance WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result1 = $stmt->get_result();

if ($result1 && $result1->num_rows > 0) {
    $row_status = $result1->fetch_assoc();
    $status = strtolower(trim($row_status['status']));
} else {
    $status = 'register';
}

if (isset($_POST['select_class'])) {
    $_SESSION['subject'] = $_POST['subject'];
    $_SESSION['class_time'] = $_POST['start_time'] . ' - ' . $_POST['end_time'];
    $_SESSION['block'] = $_POST['block'];
    $_SESSION['class_days'] = $_POST['day'];
    $_SESSION['professor'] = $_POST['professor'];
    $_SESSION['room'] = $_POST['room'];

    header("Location: 15-room-sched.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Schedule</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Winky+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="image/ntc-logo-1.png">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://unpkg.com/html5-qrcode"></script>
    <style>
        #my-qr-reader {
            padding: 20px;
            border: 1.5px solid #b2b2b2;
            border-radius: 8px;
            width: 100%;
        }

        #qr-content,
        #error {
            margin-top: 10px;
            font-size: 16px;
            padding: 10px;
            background: white;
            border: 1px solid #b2b2b2;
            border-radius: 5px;
            display: none;
        }

        .modal-dialog {
            max-width: 600px;
         
        }
    </style>
</head>

<body>
    <div class="navbar">
        <a href="04-home.php">
            <img src="image/ntc-logo-1.png" alt="Logo"> NATIONAL TEACHERS COLLEGE
        </a>
    </div>

    <hr>


    <div class="middle-content">
        <h1>Room 109</h1>
    </div>
    <?php if ($status === 'attendance'): ?>
     
        <div class="box-container mt-4" style="cursor: pointer;">
            <?php if ($result->num_rows > 0) : ?>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                    <?php while ($row = $result->fetch_assoc()) :
                        $formattedStartTime = date('h:ia', strtotime($row["start_time"]));
                        $formattedEndTime = date('h:ia', strtotime($row["end_time"]));
                    ?>
                        <div class="col">
                            <div class="card h-100 shadow-sm border-0"
                                style="border-radius: 12px;"
                                data-bs-toggle="modal"
                                data-bs-target="#exampleModal"
                                onclick="setModalContent(
                         '<?= htmlspecialchars($row['subject'], ENT_QUOTES) ?>',
                         '<?= htmlspecialchars($row['professor'], ENT_QUOTES) ?>',
                         '<?= htmlspecialchars($row['day'], ENT_QUOTES) ?>',
                         '<?= htmlspecialchars($row['block'], ENT_QUOTES) ?>',
                         '<?= htmlspecialchars($formattedStartTime, ENT_QUOTES) ?>',
                         '<?= htmlspecialchars($formattedEndTime, ENT_QUOTES) ?>',
                         '<?= htmlspecialchars($row['password'], ENT_QUOTES) ?>'
                     )">
                    
                                <div class="card-header text-white" style="background-color: #2962FF; border-top-left-radius: 12px; border-top-right-radius: 12px;">
                                    <h5 class="card-title mb-0"><?= htmlspecialchars($row["subject"]) ?></h5>
                                </div>

                             
                                <div class="card-body">
                                 
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="badge rounded-pill px-3 py-2 text-white" style="background-color: #00BFA6; font-weight: 600;">
                                            <?= htmlspecialchars($formattedStartTime) ?> - <?= htmlspecialchars($formattedEndTime) ?>
                                        </span>
                                        <span class="badge text-dark" style="font-weight: 500; padding: 0.5em 0.75em; background-color: #FFD600;"><?= htmlspecialchars($row["day"]) ?></span>
                                    </div>

                                 
                                    <p class="mb-1" style="color: #263238;"><strong>Block:</strong> <?= htmlspecialchars($row["block"]) ?></p>
                                    <p class="mb-0" style="color: #263238;"><strong>Professor:</strong> <?= htmlspecialchars($row["professor"]) ?></p>
                                </div>

                                <!-- Footer -->
                                <div class="card-footer bg-light text-center" style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                                    <small class="text-muted">Class Schedule</small>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else : ?>
                <div class="alert alert-info text-center" style="max-width: 600px; margin: 0 auto; border-radius: 10px;">
                    <i class="fas fa-calendar-times me-2"></i> No classes scheduled
                </div>
            <?php endif; ?>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Scan the QR code from your teacher's device</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="my-qr-reader"></div>
                        <div id="qr-content"></div>
                        <div id="error"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>

        <div class="box-container mt-4" style="cursor: pointer;">
            <?php if ($result->num_rows > 0) : ?>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                    <?php while ($row = $result->fetch_assoc()) :
                        $formattedStartTime = date('h:ia', strtotime($row["start_time"]));
                        $formattedEndTime = date('h:ia', strtotime($row["end_time"]));
                    ?>
                        <div class="col">
                            <div class="card h-100 shadow-sm border-0"
                                style="border-radius: 12px;"
                                onclick="submitClassData(
                         '<?= htmlspecialchars($row['subject'], ENT_QUOTES) ?>',
                         '<?= htmlspecialchars($row['professor'], ENT_QUOTES) ?>',
                         '<?= htmlspecialchars($row['day'], ENT_QUOTES) ?>',
                         '<?= htmlspecialchars($row['block'], ENT_QUOTES) ?>',
                         '<?= htmlspecialchars($formattedStartTime, ENT_QUOTES) ?>',
                         '<?= htmlspecialchars($formattedEndTime, ENT_QUOTES) ?>'
                     )">
                              
                                <div class="card-header text-white" style="background-color: #2962FF; border-top-left-radius: 12px; border-top-right-radius: 12px;">
                                    <h5 class="card-title mb-0"><?= htmlspecialchars($row["subject"]) ?></h5>
                                </div>

                               
                                <div class="card-body">
                                   
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="badge rounded-pill px-3 py-2 text-white" style="background-color: #00BFA6; font-weight: 600;">
                                            <?= htmlspecialchars($formattedStartTime) ?> - <?= htmlspecialchars($formattedEndTime) ?>
                                        </span>
                                        <span class="badge text-dark" style="font-weight: 500; padding: 0.5em 0.75em; background-color: #FFD600;"><?= htmlspecialchars($row["day"]) ?></span>
                                    </div>

                                    <!-- Info -->
                                    <p class="mb-1" style="color: #263238;"><strong>Block:</strong> <?= htmlspecialchars($row["block"]) ?></p>
                                    <p class="mb-0" style="color: #263238;"><strong>Professor:</strong> <?= htmlspecialchars($row["professor"]) ?></p>
                                </div>

                                <!-- Footer -->
                                <div class="card-footer bg-light text-center" style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                                    <small class="text-muted">Class Schedule</small>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else : ?>
                <div class="alert alert-info text-center" style="max-width: 600px; margin: 0 auto; border-radius: 10px;">
                    <i class="fas fa-calendar-times me-2"></i> No classes scheduled
                </div>
            <?php endif; ?>
        </div>
        </div>
    <?php endif; ?>

    <script>
        let currentClassInfo = {
            subject: '',
            professor: '',
            day: '',
            block: '',
            start_time: '',
            end_time: '',
            room: '109',
            password: '' 
        };

        function setModalContent(subject, professor, day, block, startTime, endTime, password) {
           
            currentClassInfo = {
                subject: subject,
                professor: professor,
                day: day,
                block: block,
                start_time: startTime,
                end_time: endTime,
                room: '109', 
                password: password 
            };
            
            console.log("Class info set:", currentClassInfo);
        }

        document.addEventListener("DOMContentLoaded", function() {
            
            const myModal = document.getElementById('exampleModal');
            let html5QrcodeScanner = null; 

            myModal.addEventListener('shown.bs.modal', function() {
                const qrContentDiv = document.getElementById('qr-content');
                const userDetailsDiv = document.getElementById('error');
                
             
                qrContentDiv.style.display = 'none';
                userDetailsDiv.style.display = 'none';

                function onScanSuccess(decodedText) {
                    console.log("QR code detected:", decodedText);
                    qrContentDiv.innerText = "QR Code Scanned Successfully!";
                    qrContentDiv.style.display = 'block';

                
                    fetch(`get_user_data.php?password=${encodeURIComponent(decodedText)}&subject=${encodeURIComponent(currentClassInfo.subject)}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! Status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log("API response:", data);
                            
                            if (data.success) {
                                userDetailsDiv.innerHTML = `
                                    <p class="text-success">Authentication successful!</p>
                                    <p>Redirecting to room schedule...</p>
                                `;
                                userDetailsDiv.style.display = 'block';

                              
                                const formData = new FormData();
                                formData.append('select_class', 'true');
                                formData.append('subject', currentClassInfo.subject);
                                formData.append('start_time', currentClassInfo.start_time);
                                formData.append('end_time', currentClassInfo.end_time);
                                formData.append('block', currentClassInfo.block);
                                formData.append('day', currentClassInfo.day);
                                formData.append('professor', currentClassInfo.professor);
                                formData.append('room', currentClassInfo.room);

                                fetch(window.location.href, {
                                    method: 'POST',
                                    body: formData
                                }).then(response => {
                                    if (!response.ok) {
                                        throw new Error(`HTTP error! Status: ${response.status}`);
                                    }
                                    window.location.href = "15-room-sched.php";
                                }).catch(error => {
                                    console.error('Error submitting form:', error);
                                    userDetailsDiv.innerHTML = '<p class="text-danger">Error saving session data. Please try again.</p>';
                                });
                            } else {
                                userDetailsDiv.innerHTML = `<p class="text-danger">${data.message || 'Invalid QR code. Please try again.'}</p>`;
                                userDetailsDiv.style.display = 'block';
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching data:', error);
                            userDetailsDiv.innerHTML = '<p class="text-danger">Error processing QR code. Please try again.</p>';
                            userDetailsDiv.style.display = 'block';
                        });
                }

            
                if (html5QrcodeScanner) {
                    html5QrcodeScanner.clear().catch(error => {
                        console.error("Failed to clear html5QrcodeScanner. ", error);
                    });
                }

              
                html5QrcodeScanner = new Html5QrcodeScanner(
                    "my-qr-reader", {
                        fps: 10,
                        qrbox: 250,
                        supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
                    },
                    /* verbose= */
                    false);
                html5QrcodeScanner.render(onScanSuccess);
            });

            myModal.addEventListener('hidden.bs.modal', function() {
                if (html5QrcodeScanner) {
                    html5QrcodeScanner.clear().catch(error => {
                        console.error("Failed to clear html5QrcodeScanner. ", error);
                    });
                    html5QrcodeScanner = null;
                }
            });
        });

        function submitClassData(subject, professor, day, block, startTime, endTime) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '';

            function addInput(name, value) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = name;
                input.value = value;
                form.appendChild(input);
            }

            addInput('select_class', 'true');
            addInput('subject', subject);
            addInput('start_time', startTime);
            addInput('end_time', endTime);
            addInput('block', block);
            addInput('day', day);
            addInput('professor', professor);
            addInput('room', '109'); 

           
            document.body.appendChild(form);
            form.submit();

          
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>