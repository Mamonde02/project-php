<?php
session_start();
require_once "../../backend/config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $sender_id = $_SESSION['user_id'];
    $receiver_id = $_POST['receiver_id'];
    $message = trim($_POST['message']);

    error_log("sendMessage.php - Sender: $sender_id, Receiver: $receiver_id, Message: $message");

    if (!empty($message)) {
        $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
        if ($stmt->execute([$sender_id, $receiver_id, $message])) {
            error_log("Message successfully inserted into database.");
        } else {
            error_log("Failed to insert message.");
        }
    } else {
        error_log("sendMessage.php - Message is empty.");
    }
} else {
    error_log("sendMessage.php - Invalid request or session not set.");
}
