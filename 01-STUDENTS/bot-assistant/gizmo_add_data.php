<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "ntc_database";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// CREATE
if (isset($_POST['add'])) {
    $concern = $_POST['concern'];
    $response = $_POST['response'];
    $link = $_POST['link'];
    $conn->query("INSERT INTO bot_assistant (concern, response, link) VALUES ('$concern', '$response', '$link')");
}

// UPDATE
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $concern = $_POST['concern'];
    $response = $_POST['response'];
    $link = $_POST['link'];
    $conn->query("UPDATE bot_assistant SET concern='$concern', response='$response', link='$link' WHERE id=$id");
}

// DELETE
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM bot_assistant WHERE id=$id");
}

// READ
$result = $conn->query("SELECT * FROM bot_assistant");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bot Assistant Control Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="./image/ntc-logo-1.png">

    <style>
        :root {
            --bg-color: #f8f9fa;
            --primary: #2a9d8f;
            --secondary: #264653;
            --light: #e9ecef;
            --shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        body {
            background-color: var(--bg-color);
            font-family: 'Segoe UI', sans-serif;
        }

        .panel {
            background-color: white;
            border-radius: 15px;
            box-shadow: var(--shadow);
            padding: 30px;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .btn-primary {
            background-color: var(--primary);
            border: none;
        }

        .btn-primary:hover {
            background-color: #21867a;
        }

        .btn-success {
            background-color: var(--secondary);
            border: none;
        }

        .btn-success:hover {
            background-color: #1f3e3d;
        }

        .modal-content {
            border-radius: 12px;
            box-shadow: var(--shadow);
        }

        .form-control:focus {
            box-shadow: none;
            border-color: var(--primary);
        }
    </style>
</head>
<body class="p-4">

<div class="container">
    <div class="panel">
        <h2 class="mb-4 text-secondary"><i class="bi bi-robot me-2"></i>Bot Assistant Control Panel</h2>

        <!-- Add Form -->
        <form method="POST" class="row g-3 mb-4">
            <div class="col-md-4">
                <input type="text" name="concern" class="form-control" placeholder="Concern" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="response" class="form-control" placeholder="Response" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="link" class="form-control" placeholder="Link">
            </div>
            <div class="col-md-1 d-grid">
                <button type="submit" name="add" class="btn btn-primary">Add</button>
            </div>
        </form>

        <!-- Data Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>ID</th>
                        <th>Concern</th>
                        <th>Response</th>
                        <th>Link</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td class="text-center"><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['concern']) ?></td>
                        <td><?= htmlspecialchars($row['response']) ?></td>
                        <td><a href="<?= htmlspecialchars($row['link']) ?>" target="_blank"><?= htmlspecialchars($row['link']) ?></a></td>
                        <td class="text-center d-flex flex-row gap-2">
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id'] ?>">
                                <i class="bi bi-pencil-square"></i>
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
$result->data_seek(0); // Reset result pointer
while ($row = $result->fetch_assoc()) { ?>
<div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-pencil me-2"></i>Edit Entry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <div class="mb-3">
                    <label>Concern</label>
                    <input type="text" name="concern" class="form-control" value="<?= htmlspecialchars($row['concern']) ?>" required>
                </div>
                <div class="mb-3">
                    <label>Response</label>
                    <input type="text" name="response" class="form-control" value="<?= htmlspecialchars($row['response']) ?>" required>
                </div>
                <div class="mb-3">
                    <label>Link</label>
                    <input type="text" name="link" class="form-control" value="<?= htmlspecialchars($row['link']) ?>">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="update" class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
</div>
<?php } ?>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Focus fix script -->
<script>
</script>
</body>
</html>