<?php
session_start();
require_once "../../backend/config/database.php";
require_once "../../backend/models/message.php";

$messageModel = new Message($pdo);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $sender_id = $_SESSION['user_id'];
    $receiver_id = $_POST['receiver_id'];
    $message = trim($_POST['message']);

    error_log("sendMessage.php - Sender: $sender_id, Receiver: $receiver_id, Message: $message");

    if (!empty($message)) {
        // $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
        $sendMessage = $messageModel->sendMessage($sender_id, $receiver_id, $message);
        if ($sendMessage) {
            error_log("Message successfully inserted into database.");
            // return a success response
            echo json_encode([
                "status" => "success",
                "message" => "Message sent successfully.",
                "data" => [
                    "sender_id" => $sender_id,
                    "receiver_id" => $receiver_id,
                    "message" => $message
                ],
            ]);
        } else {
            error_log("Failed to insert message.");
            // return an error response
            echo json_encode([
                "status" => "error",
                "message" => "Failed to send message.",
                "data" => [
                    "sender_id" => $sender_id,
                    "receiver_id" => $receiver_id,
                    "message" => $message
                ],
                "session" => isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null

            ]);
        }
    } else {
        error_log("sendMessage.php - Message is empty.");
        echo json_encode([
            "status" => "error",
            "message" => "Message cannot be empty.",
            "data" => [],
            "session" => isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null
        ]);
    }
} else {
    error_log("sendMessage.php - Invalid request or session not set.");
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request.",
        "data" => [],
        "session" => isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null
    ]);
}
