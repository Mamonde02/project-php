<?php
session_start();
require_once "../config/database.php";
require_once "../config/baseconfig.php";

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access");
}


// ADD NOTE
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_note'])) {
    $title = trim($_POST['title']);
    $notetype = trim($_POST['notetype']);
    $comment = trim($_POST['comment']);
    $user_id = $_SESSION['user_id']; // Get logged-in user ID

    $stmt = $pdo->prepare("INSERT INTO notes (user_id, title, notetype, comment) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$user_id, $title, $notetype, $comment])) {
        // header("Location: ../../frontend/views/dashboard.php");

        // $msg_success = "Note added successfully.";
        // header("Location: ../../frontend/views/dashboard.php?msg_success=" . urlencode($msg_success));
        // exit();

        // Set alert message
        $_SESSION['alert_message'] = "Note added successfully!";
        $_SESSION['alert_type'] = "success"; // Bootstrap alert color

        // Redirect back to the dashboard
        // header("Location: ../../frontend/views/dashboard.php");
        // exit();

        // $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/php-auth/';
        // header("Location: " . $baseUrl . "frontend/views/dashboard.php");

        header("Location: " . BASE_URL . "frontend/views/dashboard.php");

        exit();
    } else {
        // echo "Failed to add note!";
        // echo "<script>alert('Failed to add note!'); window.location.href='../../frontend/views/dashboard.php';</script>";

        $_SESSION['alert_message'] = "Failed to add note!";
        $_SESSION['alert_type'] = "warning"; // Bootstrap alert color
        // header("Location: ../../frontend/views/dashboard.php");
        // exit();

        // $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/php-auth/';
        // header("Location: " . $baseUrl . "frontend/views/dashboard.php");

        header("Location: " . BASE_URL . "frontend/views/dashboard.php");
        exit();
    }
}

// DELETE NOTE
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_note'])) {
    $note_id = $_POST['note_id'];

    $stmt = $pdo->prepare("DELETE FROM notes WHERE id = ?");
    if ($stmt->execute([$note_id])) {
        // header("Location: ../../frontend/views/dashboard.php");

        // $msg_fail = "Note is deleted successfully.";
        // header("Location: ../../frontend/views/dashboard.php?msg_fail=" . urlencode($msg_fail));
        // exit();

        // Set alert message
        $_SESSION['alert_message'] = "Note deleted successfully!";
        $_SESSION['alert_type'] = "danger"; // Bootstrap alert color

        // Redirect back to the dashboard
        // header("Location: ../../frontend/views/dashboard.php");
        // exit();

        // $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/php-auth/';
        // header("Location: " . $baseUrl . "frontend/views/dashboard.php");

        header("Location: " . BASE_URL . "frontend/views/dashboard.php");
        exit();
    } else {
        // echo "Failed to delete note!";
        // echo "<script>alert('Failed to delete note!'); window.location.href='../../frontend/views/dashboard.php';</script>";

        $_SESSION['alert_message'] = "Failed to delete note!";
        $_SESSION['alert_type'] = "warning"; // Bootstrap alert color
        // header("Location: ../../frontend/views/dashboard.php");
        // exit();

        // $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/php-auth/';
        // header("Location: " . $baseUrl . "frontend/views/dashboard.php");

        header("Location: " . BASE_URL . "frontend/views/dashboard.php");
        exit();
    }
}

// UPDATE NOTE
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_note'])) {
    $note_id = $_POST['note_id'];

    $title = trim($_POST['title']);
    $notetype = trim($_POST['notetype']);
    $comment = trim($_POST['comment']);

    $stmt = $pdo->prepare("UPDATE notes SET title = ?, notetype = ?, comment = ? WHERE id = ?");
    if ($stmt->execute([$title, $notetype, $comment, $note_id])) {
        // header("Location: ../../frontend/views/dashboard.php");

        // $msg = "Note is updated successfully.";
        // header("Location: ../../frontend/views/dashboard.php?msg=" . urlencode($msg));
        // exit();

        // Set alert message
        $_SESSION['alert_message'] = "Note updated successfully!";
        $_SESSION['alert_type'] = "warning"; // Bootstrap alert color

        // Redirect back to the dashboard
        // header("Location: ../../frontend/views/dashboard.php");
        // exit();

        // $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/php-auth/';
        // header("Location: " . $baseUrl . "frontend/views/dashboard.php");

        header("Location: " . BASE_URL . "frontend/views/dashboard.php");
        exit();
    } else {
        // echo "Failed to update note!";
        // echo "<script>alert('Failed to update note!'); window.location.href='../../frontend/views/dashboard.php';</script>";

        $_SESSION['alert_message'] = "Failed to update note!";
        $_SESSION['alert_type'] = "warning"; // Bootstrap alert color
        // header("Location: ../../frontend/views/dashboard.php");
        // exit();

        // $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/php-auth/';
        // header("Location: " . $baseUrl . "frontend/views/dashboard.php");

        header("Location: " . BASE_URL . "frontend/views/dashboard.php");
        exit();
    }
}
