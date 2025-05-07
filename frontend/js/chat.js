function fetchMessages() {
    let receiver_id = $('#receiver_id').val();
    if (!receiver_id) return;

    console.log("Fetching messages for Receiver ID:", receiver_id);

    $.get(`${BASE_URL}backend/controllers/getMessages.php`, {
        receiver_id
    }, function (data) {
        console.log("Response from getMessages.php:", data);

        let messages = JSON.parse(data);
        let chatBox = $('#chat-box');
        chatBox.empty();

        messages.forEach(msg => {
            let messageClass = (msg.sender_id == loggedInUserId) ? "sent" : "received";
            chatBox.append(`<div class="message ${messageClass}"><strong>${msg.sender_id}:</strong> ${msg.message}</div>`);
        });

        chatBox.scrollTop(chatBox.prop("scrollHeight"));
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
