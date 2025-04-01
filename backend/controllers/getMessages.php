<?php
session_start();
require_once "../../backend/config/database.php";

if (!isset($_SESSION['user_id'])) {
    error_log("getMessages.php - User session not set.");
    echo json_encode(["error" => "User not logged in"]);
    exit();
}

$sender_id = $_SESSION['user_id'];
$receiver_id = $_GET['receiver_id'] ?? '';

error_log("getMessages.php - Fetching messages between Sender: $sender_id and Receiver: $receiver_id");

$stmt = $pdo->prepare("SELECT * FROM messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY timestamp ASC");
$stmt->execute([$sender_id, $receiver_id, $receiver_id, $sender_id]);

$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$messages) {
    error_log("getMessages.php - No messages found.");
} else {
    error_log("getMessages.php - " . count($messages) . " messages found.");
}

echo json_encode($messages);
