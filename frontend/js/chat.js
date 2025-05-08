function fetchMessages() {
    let receiver_id = $('#receiver_id').val();
    if (!receiver_id) return;

    console.log("Fetching messages for Receiver ID:", receiver_id);

    $.get(`${BASE_URL}backend/controllers/getMessages.php`, {
        receiver_id
    }, function (data) {
        console.log("Response from getMessages.php:", data);

        let messages = JSON.parse(data);
        console.log("Testing Parsed messages:", messages);

        let chatBox = $('#chat-box');
        chatBox.empty();

        messages.forEach(msg => {
            let messageClass = (msg.sender_id == loggedInUserId) ? "sent" : "received";
            let messageClassdate = (msg.sender_id == loggedInUserId) ? "sentdatetime" : "receiveddatetime";

            let messageTime = new Date(msg.timestamp).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            let messageDate = new Date(msg.timestamp).toLocaleDateString([], { year: 'numeric', month: '2-digit', day: '2-digit' });


            chatBox.append(`<div class="message ${messageClass}"><strong>${msg.sender_username}:</strong> ${msg.message}</div>`);
            chatBox.append(`<div class="message-time ${messageClassdate}">${messageTime} (${messageDate})</div>`);
        });

        // chatBox.scrollTop(chatBox.prop("scrollHeight"));
        // chatBox.animate({ scrollTop: chatBox.prop("scrollHeight") }, 1000);


    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.error("AJAX error fetching messages:", textStatus, errorThrown);
    });
}

$('#sendBtn').click(function () {
    let message = $('#message').val();
    let receiver_id = $('#receiver_id').val();

    console.log("Sending message:", message, "to Receiver ID:", receiver_id);

    if (message.trim() !== '' && receiver_id) {
        $.post(`${BASE_URL}backend/controllers/sendMessage.php`, {
            receiver_id,
            message
        }, function () {
            console.log("Message sent successfully");
            $('#message').val('');
            fetchMessages();
        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.error("AJAX error sending message:", textStatus, errorThrown);
        });
    } else {
        console.warn("Cannot send an empty message or invalid receiver ID.");
        alert('Please select a user to chat with.');
    }
});

// Enable/disable send button based on message input
$('#message').on('input', function () {
    $('#sendBtn').prop('disabled', $(this).val().trim() === '');
});
$('#sendBtn').prop('disabled', true);

setInterval(fetchMessages, 3000); // Refresh messages every 3 seconds
