<?php
$conn = new mysqli("localhost", "root", "", "ntc_database");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$gizmo = "gizmo"; // This should match a row in your gizmo_status table

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

$sql = "SELECT concern, response FROM bot_assistant";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gizmo Bot Chat</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="../image/ntc-logo-1.png">
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
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0f0f0;
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
      display: flex;
      flex-direction: column;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      border-radius: 15px;
    }

    .chat-header {
      background-color: rgb(39, 43, 174);
      color: white;
      padding: 15px;
      display: flex;
      align-items: center;
    }

    .back-button {
      color: white;
      background: none;
      border: none;
      font-size: 24px;
      cursor: pointer;
      margin-right: 15px;
    }

    .user-avatar {
      width: 40px;
      height: 40px;
      background-color: #ddd;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      margin-right: 15px;
      font-size: 22px;
      overflow: hidden;
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
      font-weight: bold;
      font-size: 18px;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .star-rating {
      background-color: #f8e71c;
      color: #000;
      padding: 3px 10px;
      border-radius: 14px;
      font-size: 14px;
      font-weight: bold;
    }

    .user-status {
      display: flex;
      align-items: center;
      font-size: 14px;
      margin-top: 4px;
    }

    .status-indicator {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background-color: #4caf50;
      margin-right: 6px;
    }

    .status-text {
      background-color: #4caf50;
      color: white;
      padding: 3px 8px;
      border-radius: 10px;
      font-size: 12px;
      font-weight: bold;
    }

    .status-indicator-offline {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background-color: rgb(242, 0, 0);
      margin-right: 6px;
    }

    .status-text-offline {
      background-color: rgb(255, 0, 0);
      color: white;
      padding: 3px 8px;
      border-radius: 10px;
      font-size: 12px;
      font-weight: bold;
    }

    .settings-button {
      color: white;
      background: none;
      border: none;
      font-size: 24px;
      cursor: pointer;
    }

    .announce-banner {
      padding: 12px;
      background-color: #fff;
      text-align: center;
      border-bottom: 1px solid #eee;
    }

    .announce-button {
      background: none;
      border: none;
      color: #333;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      font-size: 16px;
    }

    .announce-icon {
      margin-right: 12px;
      font-size: 20px;
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
    }

    .user-wrapper {
      justify-content: flex-end;
    }

    .bot-wrapper {
      justify-content: flex-start;
    }

    .message {
      max-width: 75%;
      padding: 12px 18px;
      border-radius: 24px;
      font-size: 16px;
      line-height: 1.5;
      word-wrap: break-word;
    }

    .user-message {
      background-color: rgb(39, 43, 174);
      color: white;
      border-bottom-right-radius: 6px;
    }

    .bot-message {
      background-color: #e4e6eb;
      color: #111;
      border-bottom-left-radius: 6px;
    }

    .chat-input {
      display: flex;
      padding: 12px;
      border-top: 1px solid #ddd;
      background: #fff;
      position: sticky;
      bottom: 0;
    }

    select.form-select {
      -webkit-appearance: none;
      appearance: none;
      background-color: #f9f9f9;
      border-radius: 24px;
      font-size: 16px;
      padding: 12px 20px;
      height: 48px;
      flex-grow: 1;
      transition: none !important;
      animation: none !important;
    }

    .chat-input button {
      background-color: rgb(39, 43, 174);
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 24px;
      margin-left: 10px;
      cursor: pointer;
      font-weight: bold;
      font-size: 16px;
      transition: background 0.2s;
      white-space: nowrap;
    }

    .chat-input button:hover {
      background-color: rgb(33, 58, 150);
      color: #ffffff;
    }

    /* Typing animation styles */
    .typing-indicator {
      background-color: #e4e6eb;
      padding: 12px 18px;
      border-radius: 24px;
      border-bottom-left-radius: 6px;
      display: inline-flex;
      align-items: center;
      max-width: 75%;
    }

    .typing-dot {
      width: 8px;
      height: 8px;
      background-color: #666;
      border-radius: 50%;
      margin: 0 2px;
      opacity: 0.4;
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
        opacity: 0.4;
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
        padding: 10px;
        position: sticky;
        top: 0;
        z-index: 100;
      }

      .chat-input {
        padding: 10px;
      }

      select.form-select {
        padding: 10px 15px;
      }

      .chat-input button {
        padding: 10px 15px;
      }
    }
  </style>
</head>

<body>

  <div class="chat-container">
    <div class="chat-header">
      <button class="back-button" onclick="history.back()">←</button>
      <div class="user-avatar">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSvCIHkIbL9PfcAMb7GgC6HnSKDdJ9a-rUHmg&s" alt="Gizmo Avatar">
      </div>
      <div class="user-info">
        <div class="user-name">
          Gizmo
        </div>
        <div class="user-status">
          <div id="status-indicator" class="status-indicator"></div>
          <span class="status-text" id="status-display">Checking status...</span>
        </div>
      </div>
    </div>

    <div class="announce-banner" id="announce-banner">
      <button class="announce-button">
        <span class="announce-icon">📢</span>
        <span id="announce-text">Select a concern below!</span>
      </button>
    </div>

    <div id="chatBox" class="chat-box">
      <div class="message-wrapper bot-wrapper">
        <div class="message bot-message" id="initial-message">Hello! How can I help you today?</div>
      </div>
    </div>



    <div class="chat-input">
      <?php
      if ($result->num_rows > 0) {
        echo '<select id="concernInput" class="form-select">';
        echo '<option value="" disabled selected>Select your concern</option>';

        while ($row = $result->fetch_assoc()) {
          $concern = htmlspecialchars($row["concern"]);
          echo '<option value="' . $concern . '">' . $concern . '</option>';
        }

        echo '</select>';
      } else {
        echo '<p class="text-center text-danger">No classes scheduled</p>';
      }

      $conn->close();
      ?>
      <button onclick="loadStudent()" id="send-button">Send</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      function setViewportHeight() {
        let vh = window.innerHeight * 0.01;
        document.documentElement.style.setProperty('--vh', `${vh}px`);
      }

      setViewportHeight();
      window.addEventListener('resize', setViewportHeight);

      function loadStudent() {
        const select = document.getElementById("concernInput");
        const concern = select.value.trim();
        if (concern === "") return;

        const chatBox = document.getElementById("chatBox");

        select.disabled = true;
        document.getElementById("send-button").disabled = true;
        const userWrap = document.createElement("div");
        userWrap.className = "message-wrapper user-wrapper";
        userWrap.innerHTML = `<div class="message user-message">${concern}</div>`;
        chatBox.appendChild(userWrap);
        chatBox.scrollTop = chatBox.scrollHeight;

        const typingWrap = document.createElement("div");
        typingWrap.className = "message-wrapper bot-wrapper";
        typingWrap.innerHTML = `
      <div class="typing-indicator">
        <div class="typing-dot"></div>
        <div class="typing-dot"></div>
        <div class="typing-dot"></div>
      </div>
    `;
        chatBox.appendChild(typingWrap);
        chatBox.scrollTop = chatBox.scrollHeight;

        setTimeout(() => {
          typingWrap.remove();

          const xhr = new XMLHttpRequest();
          xhr.open("GET", "get-users.php?concern=" + encodeURIComponent(concern), true);
          xhr.onload = function() {
            if (this.status === 200) {
              const data = JSON.parse(this.responseText);

              const botWrap = document.createElement("div");
              botWrap.className = "message-wrapper bot-wrapper";
              botWrap.innerHTML =
                `<div class="message bot-message">
              ${data.message}
              ${data.link ? `<br><a href="${data.link}" target="_blank">Click here</a>` : ""}
            </div>`;
              chatBox.appendChild(botWrap);
              chatBox.scrollTop = chatBox.scrollHeight;
            }

            select.disabled = false;
            document.getElementById("send-button").disabled = false;
          };
          xhr.send();
        }, 2000);

        select.selectedIndex = 0;
      }

      function updateStatus() {
        fetch('get_status.php')
          .then(response => response.json())
          .then(data => {
            const statusDiv = document.getElementById('status-display');
            const statusIndicator = document.getElementById('status-indicator');
            const announceText = document.getElementById('announce-text');
            const concernInput = document.getElementById('concernInput');
            const initialMessage = document.getElementById('initial-message');

            if (data.status === 'online') {
              statusDiv.innerHTML = 'Online';
              statusDiv.className = 'status-text';
              statusIndicator.className = 'status-indicator';

              announceText.innerText = 'Select a concern below!';

              initialMessage.innerHTML = 'Hello! How can I help you today?';

              concernInput.disabled = false;
              concernInput.querySelector('option[disabled]').innerText = 'Select your concern';
            } else {
              statusDiv.innerHTML = 'Offline';
              statusDiv.className = 'status-text-offline';
              statusIndicator.className = 'status-indicator-offline';

              announceText.innerText = 'OUT OF SERVICE RIGHT NOW!';

              initialMessage.innerHTML = '<strong>GIZMO</strong> is out for service right now please try again later.';

              concernInput.disabled = true;
              concernInput.querySelector('option[disabled]').innerText = 'OUT OF SERVICE';
            }
          })
          .catch(error => console.error('Error:', error));
      }

      updateStatus();

      setInterval(updateStatus, 1000);
    </script>

</body>

</html>