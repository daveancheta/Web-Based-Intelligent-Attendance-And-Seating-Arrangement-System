<?php
session_start();

$rooms = ["Room 1", "Room 2", "Room 3", "Room 4"]; // Example rooms
$selectedRoom = isset($_GET['room']) ? $_GET['room'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Rooms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h2 class="mb-3">Select a Chat Room</h2>

    <!-- Room Selection Buttons -->
    <div class="d-flex gap-2">
        <?php foreach ($rooms as $room): ?>
            <a href="?room=<?php echo urlencode($room); ?>" class="btn btn-primary"><?php echo $room; ?></a>
        <?php endforeach; ?>
    </div>

    <hr>

    <!-- Display Chat Room -->
    <?php if ($selectedRoom): ?>
        <h3>Chatting in: <?php echo htmlspecialchars($selectedRoom); ?></h3>

        <div class="border p-3 mt-3" style="height: 300px; overflow-y: auto;">
            <p><strong>User1:</strong> Hello in <?php echo htmlspecialchars($selectedRoom); ?>!</p>
            <p><strong>User2:</strong> Hey there!</p>
            <!-- Example messages, fetch from DB in real case -->
        </div>

        <!-- Message Input -->
        <form method="POST" class="mt-2">
            <input type="hidden" name="room" value="<?php echo htmlspecialchars($selectedRoom); ?>">
            <input type="text" name="message" class="form-control" placeholder="Type your message..." required>
            <button type="submit" class="btn btn-success mt-2">Send</button>
        </form>
    <?php else: ?>
        <p>Select a room to start chatting.</p>
    <?php endif; ?>

</body>
</html>
