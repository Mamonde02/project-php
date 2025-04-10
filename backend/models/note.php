<?php
// /backend/models/Note.php
require_once __DIR__ . '/../config/database.php';

class Note
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllNotesByUser($userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM notes WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNoteById($noteId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM notes WHERE id = ?");
        $stmt->execute([$noteId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createNote($userId, $title, $content)
    {
        $stmt = $this->pdo->prepare("INSERT INTO notes (user_id, title, content) VALUES (?, ?, ?)");
        return $stmt->execute([$userId, $title, $content]);
    }

    public function updateNote($id, $title, $content)
    {
        $stmt = $this->pdo->prepare("UPDATE notes SET title = ?, content = ? WHERE id = ?");
        return $stmt->execute([$title, $content, $id]);
    }

    public function deleteNote($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM notes WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
