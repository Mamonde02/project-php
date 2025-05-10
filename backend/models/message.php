<?php
class Message
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getMessages($sender_id, $receiver_id)
    {
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

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$sender_id, $receiver_id, $receiver_id, $sender_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function sendMessage($sender_id, $receiver_id, $message)
    {
        $stmt = $this->pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
        return $stmt->execute([$sender_id, $receiver_id, $message]);
    }
}
