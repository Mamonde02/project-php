<?php
session_start();
require_once "../config/database.php";

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access");
}

// Copy for logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['saveChangesBtn'])) {
    // Validate and sanitize input
    $currentPassword = mysqli_real_escape_string($conn, $_POST['currentPassword']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
    $confirmNewPassword = mysqli_real_escape_string($conn, $_POST['confirmNewPassword']);

    // Fetch the current password from the database
    $query = "SELECT password FROM tblusers WHERE id = $adminId";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $currentPasswordFromDB = $row['password'];

        // Verify the current password
        if ($currentPassword === $currentPasswordFromDB) {
            // Check if the new password and confirm new password match
            if ($newPassword === $confirmNewPassword) {
                // Update the password in the database (without hashing)
                $updateQuery = "UPDATE tblusers SET password = '$newPassword' WHERE id = $adminId";
                $updateResult = mysqli_query($conn, $updateQuery);

                if ($updateResult) {
                    // Password updated successfully
                    $msg_success = "Password updated successfully.";
                    header("Location: editadminaccount.php?msg_success=" . urlencode($msg_success));
                    exit();
                } else {
                    $msg_fail = "Failed to update password. Please try again.";
                    header("Location: editadminaccount.php?msg_fail=" . urlencode($msg_fail));
                    exit();
                }
            } else {
                $msg_fail = "New password and confirm new password do not match.";
                header("Location: editadminaccount.php?msg_fail=" . urlencode($msg_fail));
                exit();
            }
        } else {
            $msg_fail = "Current password is incorrect.";
            header("Location: editadminaccount.php?msg_fail=" . urlencode($msg_fail));
            exit();
        }
    } else {
        $msg_fail = "Failed to fetch user data. Please try again.";
        header("Location: editadminaccount.php?msg_fail=" . urlencode($msg_fail));
        exit();
    }
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
        header("Location: ../../frontend/views/dashboard.php");
        exit();
    } else {
        echo "Failed to add note!";
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
        header("Location: ../../frontend/views/dashboard.php");
        exit();
    } else {
        echo "Failed to delete note!";
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
        header("Location: ../../frontend/views/dashboard.php");
        exit();
    } else {
        echo "Failed to update note!";
    }
}
