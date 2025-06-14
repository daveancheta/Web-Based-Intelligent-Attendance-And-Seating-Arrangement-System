<?php
session_start();
require 'db.php';

if (!isset($_SESSION['room_id']) || !isset($_SESSION['user_name'])) {
    header("Location: index.php");
    exit;
}

$room_id = $_SESSION['room_id'];
$user_name = $_SESSION['user_name'];

// Get student's full name from database
$stmt = $conn->prepare("SELECT first_name, surname FROM data_student WHERE student_number = ?");
$stmt->bind_param("s", $user_name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $student_data = $result->fetch_assoc();
    $display_name = htmlspecialchars($student_data['first_name'] . ' ' . $student_data['surname'], ENT_QUOTES, 'UTF-8');
} else {
    $display_name = $user_name; // Fallback to student number if name not found
}

$stmt = $conn->prepare("SELECT name FROM rooms WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $room_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $room_data = $result->fetch_assoc();
    $room_name = htmlspecialchars($room_data['name'], ENT_QUOTES, 'UTF-8');
} else {
    $room_name = "Unknown Room";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Room - <?php echo $room_name; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="icon" type="image/png" href="image/ntc-logo-1.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Spice&family=Bungee+Tint&family=Oswald:wght@200..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Winky+Sans:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
            width: 100%;
            overflow: hidden;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: rgb(255, 255, 255);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .chat-container {
            width: 100%;
            height: 100%;
            max-width: 600px;
            max-height: 700px;
            background-color: #fff;
            border-radius: 18px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .chat-header {
            background: linear-gradient(135deg, rgb(30, 33, 155), rgb(39, 43, 174));
            color: white;
            padding: 16px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .back-button {
            color: white;
            background: none;
            border: none;
            font-size: 22px;
            cursor: pointer;
            margin-right: 15px;
            transition: transform 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 50%;
        }

        .back-button:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: scale(1.1);
        }

        .user-avatar {
            width: 44px;
            height: 44px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 15px;
            font-size: 22px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-info {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            font-size: 18px;
            letter-spacing: 0.3px;
        }

        .user-status {
            font-size: 14px;
            margin-top: 2px;
            display: flex;
            align-items: center;
            opacity: 0.9;
        }

        .status-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #4caf50;
            margin-right: 6px;
            display: inline-block;
            position: relative;
        }

        .status-indicator::after {
            content: '';
            position: absolute;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: rgba(76, 175, 80, 0.3);
            top: -2px;
            left: -2px;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.7;
            }

            50% {
                transform: scale(1.2);
                opacity: 0.3;
            }

            100% {
                transform: scale(1);
                opacity: 0.7;
            }
        }

        .chat-box {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            gap: 12px;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="none"/><path d="M0 50 L50 0 L100 50 L50 100 Z" fill="rgba(39, 43, 174, 0.02)"/></svg>');
            background-size: 50px;
        }

        .message-wrapper {
            display: flex;
            margin-bottom: 4px;
        }

        .user-wrapper {
            justify-content: flex-end;
        }

        .other-wrapper {
            justify-content: flex-start;
        }

        .message {
            max-width: 75%;
            padding: 12px 18px;
            border-radius: 18px;
            font-size: 15px;
            line-height: 1.4;
            word-wrap: break-word;
            position: relative;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .message p {
            font-size: 12px;
            margin-bottom: 2px;
            font-weight: 600;
            opacity: 0.8;
        }

        .user-message {
            background: linear-gradient(135deg, rgb(30, 33, 155), rgb(39, 43, 174));
            color: white;
            border-bottom-right-radius: 6px;
        }

        .other-message {
            background-color: white;
            color: #333;
            border-bottom-left-radius: 6px;
        }

        .system-message {
            background-color: rgba(0, 0, 0, 0.03);
            color: #666;
            border-radius: 10px;
            padding: 8px 12px;
            font-size: 13px;
            text-align: center;
            margin: 6px auto;
            max-width: 80%;
            box-shadow: none;
        }

        .chat-input {
            display: flex;
            padding: 14px;
            border-top: 1px solid #eaeaea;
            background: #fff;
            position: relative;
        }

        .chat-input input {
            -webkit-appearance: none;
            appearance: none;
            background-color: #f5f5f5;
            border-radius: 24px;
            font-size: 15px;
            padding: 12px 20px;
            height: 48px;
            flex-grow: 1;
            border: 1px solid #e8e8e8;
            outline: none;
            transition: border 0.2s, box-shadow 0.2s;
        }

        .chat-input input:focus {
            border: 1px solid rgb(39, 43, 174);
            box-shadow: 0 0 0 2px rgba(39, 43, 174, 0.1);
        }

        .chat-input button {
            background: linear-gradient(135deg, rgb(30, 33, 155), rgb(39, 43, 174));
            color: white;
            border: none;
            padding: 0 22px;
            border-radius: 24px;
            margin-left: 10px;
            cursor: pointer;
            font-weight: 600;
            font-size: 15px;
            transition: transform 0.2s, box-shadow 0.2s;
            white-space: nowrap;
            height: 48px;
            box-shadow: 0 2px 5px rgba(39, 43, 174, 0.2);
        }

        .chat-input button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(39, 43, 174, 0.3);
        }

        .chat-input button:active {
            transform: translateY(1px);
            box-shadow: 0 1px 3px rgba(39, 43, 174, 0.2);
        }

        /* Typing indicator styles */
        .typing-indicator {
            background-color: white;
            padding: 10px 16px;
            border-radius: 18px;
            border-bottom-left-radius: 6px;
            display: inline-flex;
            align-items: center;
            max-width: 75%;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.3s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .typing-text {
            font-size: 13px;
            margin-left: 10px;
            color: #666;
        }

        .typing-dot {
            width: 6px;
            height: 6px;
            background-color: #888;
            border-radius: 50%;
            margin: 0 2px;
            opacity: 0.7;
        }

        .typing-dot:nth-child(1) {
            animation: typingAnimation 1.2s infinite;
        }

        .typing-dot:nth-child(2) {
            animation: typingAnimation 1.2s infinite 0.4s;
        }

        .typing-dot:nth-child(3) {
            animation: typingAnimation 1.2s infinite 0.8s;
        }

        @keyframes typingAnimation {

            0%,
            100% {
                opacity: 0.7;
                transform: translateY(0);
            }

            50% {
                opacity: 1;
                transform: translateY(-5px);
            }
        }

        /* Mobile specific styles */
        @media (max-width: 768px) {
            .chat-container {
                width: 100%;
                height: 100%;
                max-width: none;
                max-height: none;
                border-radius: 0;
            }

            body {
                padding: 0;
                margin: 0;
            }

            .chat-header {
                padding: 12px;
                position: sticky;
                top: 0;
                z-index: 100;
            }

            .chat-input {
                padding: 12px;
            }

            .message {
                max-width: 85%;
            }

            .input {
                width: 0;
            }
        }

        /* Scrollbar styling */
        .chat-box::-webkit-scrollbar {
            width: 6px;
        }

        .chat-box::-webkit-scrollbar-track {
            background: transparent;
        }

        .chat-box::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 20px;
        }

        .chat-box::-webkit-scrollbar-thumb:hover {
            background-color: rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>
<div class="chat-container">
        <div class="chat-header">
            <button class="back-button" id="leaveButton">←</button>
            <div class="user-avatar">
                <img src="image/ntc-logo-1.png" alt="Chat Avatar">
            </div>
            <div class="user-info">
                <div class="user-name">
                    <?php echo $room_name; ?>
                </div>
                <div class="user-status">
                    <span class="status-indicator"></span>
                    <span id="userCount">Active Users: 0</span>
                </div>
            </div>
        </div>

        <div id="chat-box" class="chat-box">
            <div class="message-wrapper">
                <div class="message system-message">
                    <?php echo htmlspecialchars($user_name); ?> joined the chat
                </div>
            </div>
        </div>

        <form id="messageForm" class="chat-input">
            <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
            <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
            <input class="input" type="text" id="message" name="message" placeholder="Type a message..." autocomplete="off">
            <button type="submit">Send</button>
        </form>
    </div>

    <script>
        let messageInterval = null;
        let currentRoom = <?php echo json_encode($room_id); ?>;
        let userName = "<?php echo addslashes($user_name); ?>";
        let displayName = "<?php echo addslashes($display_name); ?>";
        let typingTimer;
        let isTyping = false;

        function fetchMessages(roomId) {
            $.get("get_messages.php", {
                room_id: roomId
            }, function(data) {
                let messages = JSON.parse(data);
                let chatBox = $("#chat-box");
                let isAtBottom = chatBox[0].scrollHeight - chatBox.scrollTop() <= chatBox.outerHeight() + 10;

                let oldContent = chatBox.html();
                let newContent = "";

                messages.forEach(msg => {
                    if (msg.message.includes("joined the chat") || msg.message.includes("left the chat")) {
                        newContent += `
                        <div class="message-wrapper">
                            <div class="message system-message" style="user-select: none;">
                                <span class="text-capitalize">${msg.user_name === userName ? displayName : msg.user_name}</span> ${msg.message.includes("joined") ? "joined" : "left"} the chat
                            </div>
                        </div>
                    `;
                    } else {
                        let messageClass = msg.user_name === userName ? "user-wrapper" : "other-wrapper";
                        let messageType = msg.user_name === userName ? "user-message" : "other-message";

                        newContent += `
                        <div class="message-wrapper ${messageClass}">
                            <div class="message ${messageType}">
                                <p class="text-capitalize">${msg.user_name === userName ? displayName : msg.user_name}</p>
                                ${msg.message}
                            </div>
                        </div>
                    `;
                    }
                });

                // Now check for typing users
                $.get("get_typing_status.php", {
                    room_id: roomId,
                    current_user: userName
                }, function(typingData) {
                    let typingUsers = JSON.parse(typingData);
                    if (typingUsers.length > 0) {
                        let names = typingUsers.map(user => user.display_name).join(", ");
                        newContent += `
                        <div class="message-wrapper other-wrapper">
                            <div class="typing-indicator">
                                <div class="typing-dot"></div>
                                <div class="typing-dot"></div>
                                <div class="typing-dot"></div>
                                <span class="typing-text">${names} ${typingUsers.length > 1 ? 'are' : 'is'} typing...</span>
                            </div>
                        </div>
                    `;
                    }

                    if (newContent !== oldContent) {
                        chatBox.html(newContent);
                        if (isAtBottom) {
                            chatBox.scrollTop(chatBox[0].scrollHeight);
                        }
                    }
                });
            });
        }

        function joinRoom(newRoomId) {
            if (messageInterval) clearInterval(messageInterval);
            currentRoom = newRoomId;

            $.post("user_join.php", {
                room_id: newRoomId,
                user_name: userName
            });

            fetchMessages(currentRoom);
            messageInterval = setInterval(() => fetchMessages(currentRoom), 1000);
        }

        // On page load
        $(document).ready(function() {
            $.post("user_join.php", {
                room_id: currentRoom,
                user_name: userName
            });

            fetchMessages(currentRoom);
            messageInterval = setInterval(() => fetchMessages(currentRoom), 1000);

            setTimeout(() => {
                let chatBox = $("#chat-box");
                chatBox.scrollTop(chatBox[0].scrollHeight);
            }, 100);
        });

        $("#messageForm").submit(function(e) {
            e.preventDefault();
            let message = $("#message").val();
            if (message.trim() === "") return;

            $.post("send_message.php", $(this).serialize(), function(response) {
                if (response.success) {
                    $("#message").val("");
                    fetchMessages(currentRoom);
                    $.post("typing_status.php", {
                        room_id: currentRoom,
                        user_name: userName,
                        is_typing: false
                    });
                    isTyping = false;
                } else {
                    alert("Message sending failed!");
                }
            }, "json");
        });

        function handleTyping() {
            if (!isTyping) {
                isTyping = true;
                $.post("typing_status.php", {
                    room_id: currentRoom,
                    user_name: userName,
                    is_typing: true
                });
            }

            clearTimeout(typingTimer);
            typingTimer = setTimeout(() => {
                if (isTyping) {
                    isTyping = false;
                    $.post("typing_status.php", {
                        room_id: currentRoom,
                        user_name: userName,
                        is_typing: false
                    });
                }
            }, 1000);
        }

        $("#message").on("input", handleTyping);

        // Handle Leave button
        $("#leaveButton").click(function() {
            window.isLeavingViaButton = true;
            $.post("user_leave.php", {
                room_id: currentRoom,
                user_name: userName
            }, function() {
                $.post("logout.php", function() {
                    window.location.href = "index.php";
                });
            });
        });

        // Handle tab close
        window.addEventListener('beforeunload', function(e) {
            if (!window.isLeavingViaButton) {
                $.ajax({
                    type: 'POST',
                    url: 'user_leave.php',
                    async: false,
                    data: {
                        room_id: currentRoom,
                        user_name: userName
                    }
                });
            }
        });

        function fetchUsers() {
    fetch('get_active_users.php?room_id=' + currentRoom)
        .then(response => response.json())
        .then(data => {
            const userCount = document.getElementById('userCount');
            userCount.textContent = `Active Users: ${data.user_count}`;
        })
        .catch(error => {
            console.error('Fetch error:', error);
        });
}
        


// Fetch users every second (1000 ms) and immediately on page load
setInterval(fetchUsers, 1000);
fetchUsers();







        // Room switch (example buttons with class .room-button)
        $(".room-button").on("click", function() {
            let newRoomId = $(this).data("room-id");
            joinRoom(newRoomId);
        });
    </script>


</body>

</html>