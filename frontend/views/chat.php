<?php
require_once "../../backend/config/baseconfig.php";
require_once "../../backend/config/database.php";
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to access the chat.";
    exit();
}

// fetch all the users using select element dropdown
// remove the current user or logged-in user
// $stmt = $pdo->prepare("SELECT * FROM users");
// $stmt->execute();
$stmt = $pdo->prepare("SELECT * FROM users WHERE id != ?");
$stmt->execute([$_SESSION['user_id']]);
$users = $stmt->fetchAll();

// printf("<pre>%s</pre>", var_export($users, true));

$logged_in_user = $_SESSION['user_id']; // Get the logged-in user's ID
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #chat-box {
            height: 400px;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #f9f9f9;
        }

        .message {
            padding: 8px;
            border-radius: 5px;
            margin-bottom: 5px;
            /* max-width: 70%; */
            width: fit-content;
            border-radius: 8px;
        }

        .message-time {
            font-size: 0.8em;
            color: #888;
            width: 8.125rem;
        }

        .sentdatetime {
            background-color: rgba(0, 123, 255, 0.71);
            color: white;
            text-align: right;
            margin-left: auto;
            border-radius: 6px;
        }

        .receiveddatetime {
            background-color: #e5e5e5;
            color: black;
            text-align: left;
            border-radius: 6px;
        }

        .sent {
            background-color: #007bff;
            color: white;
            text-align: right;
            margin-left: auto;
        }

        .received {
            background-color: #e5e5e5;
            color: black;
            text-align: left;
        }
    </style>
</head>

<body class="bg-gray-100">
    <?php include('components/navbar.php'); ?>
    <div class="container mt-4">
        <div class="mb-3">
            <!-- fetch all the users using select element dropdown -->
            <label for="receiver_id" class="form-label">Chat with User:</label>
            <select id="receiver_id" class="form-select">
                <option value="">Select Users</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
                <?php endforeach; ?>
            </select>

            <!-- <label for="receiver_id" class="form-label">Chat with User ID:</label>
            <input type="text" id="receiver_id" class="form-control" placeholder="Enter Receiver ID"> -->
        </div>

        <div id="chat-box" class="border p-3"></div>

        <div class="mt-3">
            <input type="text" id="message" class="form-control" placeholder="Type a message...">
            <button id="sendBtn" class="btn btn-primary mt-2">Send</button>
        </div>
    </div>

    <script>
        const loggedInUserId = <?php echo json_encode($logged_in_user); ?>;
        const BASE_URL = <?php echo json_encode(BASE_URL); ?>;
    </script>

    <script src="../js/chat.js"></script>

</body>

</html>





<!-- <script>
    let loggedInUserId = <?php echo json_encode($logged_in_user); ?>;

    function fetchMessages() {
        let receiver_id = $('#receiver_id').val();
        if (!receiver_id) return;

        console.log("Fetching messages for Receiver ID:", receiver_id);

        $.get('<?php echo BASE_URL; ?>backend/controllers/getMessages.php', {
            receiver_id
        }, function(data) {
            console.log("Response from getMessages.php:", data);

            let messages = JSON.parse(data);
            let chatBox = $('#chat-box');
            chatBox.empty();

            messages.forEach(msg => {
                let messageClass = (msg.sender_id == loggedInUserId) ? "sent" : "received";
                chatBox.append(`<div class="message ${messageClass}"><strong>${msg.sender_id}:</strong> ${msg.message}</div>`);
            });

            chatBox.scrollTop(chatBox.prop("scrollHeight"));
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error("AJAX error fetching messages:", textStatus, errorThrown);
        });
    }

    $('#sendBtn').click(function() {
        let message = $('#message').val();
        let receiver_id = $('#receiver_id').val();

        console.log("Sending message:", message, "to Receiver ID:", receiver_id);

        if (message.trim() !== '' && receiver_id) {
            $.post('../../backend/controllers/sendMessage.php', {
                receiver_id,
                message
            }, function() {
                console.log("Message sent successfully");
                $('#message').val('');
                fetchMessages();
            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX error sending message:", textStatus, errorThrown);
            });
        } else {
            console.warn("Cannot send an empty message or invalid receiver ID.");
            alert('Please select a user to chat with.');
        }
    });

    // Add logic to toggle send button visibility
    $('#message').on('input', function() {
        let message = $(this).val().trim();
        if (message === '') {
            $('#sendBtn').prop('disabled', true); // Disable the button
        } else {
            $('#sendBtn').prop('disabled', false); // Enable the button
        }
    });

    // Initially disable the send button
    $('#sendBtn').prop('disabled', true);

    setInterval(fetchMessages, 3000); // Refresh messages every 3 seconds
</script> -->