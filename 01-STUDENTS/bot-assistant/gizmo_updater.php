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


$gizmo = "gizmo"; 

$stmt = $conn->prepare("SELECT gizmo, status FROM gizmo_status WHERE gizmo = ?");
$stmt->bind_param("s", $gizmo);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $status = strtolower(trim($row['status']));
} else {
    $status = 'offline';
}

if (isset($_POST['submit'])) {
    $gizmoNewStatus = $_POST['status'];

    $stmt = $conn->prepare("UPDATE gizmo_status SET status = ? WHERE gizmo = ?");
    $stmt->bind_param("ss", $gizmoNewStatus, $gizmo);
    $stmt->execute();

    if ($result) {
        echo "<script>alert('Status Updated Successfully!'); window.location.href = 'gizmo_updater.php';</script>";
    } else {
        $error = "Error updating status: " . $stmt->error;
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>Gizmo Status Control Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" href="./image/ntc-logo-1.png">
    <style>
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
        
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: #f5f7fa;
            color: var(--text-color);
            line-height: 1.6;
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
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-header">
            <div class="admin-avatar">
                <i class="bi bi-robot" style="font-size: 2rem;"></i>
            </div>
            <div class="admin-header-content">
                <h1 class="admin-title">Gizmo Status Control Panel</h1>
                <div class="admin-subtitle">
                    <span class="status-indicator <?php echo $status === 'online' ? 'status-online' : 'status-offline'; ?>"></span>
                    <span>Current Status: <?php echo ucfirst($status); ?></span>
                </div>
            </div>
        </div>
        
    
            
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

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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