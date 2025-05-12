<?php
session_start();
require_once "../../backend/config/database.php";
require_once "../../backend/models/message.php";

$messageModel = new Message($pdo);

if (!isset($_SESSION['user_id'])) {
    error_log("getMessages.php - User session not set.");
    echo json_encode(["error" => "User not logged in"]);
    exit();
}

$sender_id = $_SESSION['user_id'];
$receiver_id = $_GET['receiver_id'] ?? '';

error_log("getMessages.php - Fetching messages between Sender: $sender_id and Receiver: $receiver_id");



// $stmt = $pdo->prepare("SELECT * FROM messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY timestamp ASC");
// $stmt = $pdo->prepare($sql);
// $stmt->execute([$sender_id, $receiver_id, $receiver_id, $sender_id]);

// $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

$messages = $messageModel->getMessages($sender_id, $receiver_id);


if (!$messages) {
    error_log("getMessages.php - No messages found.");
    echo json_encode(["error" => "No messages found"]);
} else {
    error_log("getMessages.php - " . count($messages) . " messages found.");
    foreach ($messages as &$message) {
        $message['timestamp'] = date("Y-m-d H:i:s", strtotime($message['timestamp']));
        $message['sender_username'] = htmlspecialchars($message['sender_username']);
        $message['receiver_username'] = htmlspecialchars($message['receiver_username']);
    }
}

echo json_encode($messages);
