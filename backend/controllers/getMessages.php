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

$sql = "
    SELECT 
        m.*, 
        sender.id AS sender_user_id, sender.username AS sender_username, 
        receiver.id AS receiver_user_id, receiver.username AS receiver_username 
    FROM messages m
    JOIN users sender ON m.sender_id = sender.id
    JOIN users receiver ON m.receiver_id = receiver.id
    WHERE (m.sender_id = ? AND m.receiver_id = ?) OR (m.sender_id = ? AND m.receiver_id = ?)
    ORDER BY m.timestamp ASC
";

// $stmt = $pdo->prepare("SELECT * FROM messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY timestamp ASC");
// $stmt = $pdo->prepare($sql);
// $stmt->execute([$sender_id, $receiver_id, $receiver_id, $sender_id]);

// $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

$messages = $messageModel->getMessages($sender_id, $receiver_id);


if (!$messages) {
    error_log("getMessages.php - No messages found.");
} else {
    error_log("getMessages.php - " . count($messages) . " messages found.");
}

echo json_encode($messages);
