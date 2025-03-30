<?php
session_start();
require_once "../../backend/config/database.php";

if (!isset($_SESSION['user_id'])) {
    echo "User ID is not set in session. Please log in again.";
    exit();
}

// fetch user information testing...
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$userinfo = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch only one row
// $userinfo = $stmt->fetchAll();
// echo ("<br>user info: " . htmlspecialchars($userinfo[0]['email'])); 

if (!$userinfo) {
    echo "User not found!";
    exit();
}

$_SESSION['name'] = $userinfo['username'];
$_SESSION['email'] = $userinfo['email'];
$_SESSION['password'] = $userinfo['password'];

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Profile</h1>
    <h2>Welcome, <?php echo $_SESSION['name']; ?>!</h2>
    <p>User ID: <?php echo $_SESSION['user_id']; ?></p>
    <p>Email: <?php echo $_SESSION['email']; ?></p>
    <p>Password: <?php echo $_SESSION['password']; ?></p>
    <a href="logout.php">Logout</a>




</body>

</html>