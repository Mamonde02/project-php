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

// $_SESSION['name'] = $userinfo['username'];
// $_SESSION['email'] = $userinfo['email'];
// $_SESSION['password'] = $userinfo['password'];

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- <h1>Profile</h1>
    <h2>Welcome, <?php echo $_SESSION['name']; ?>!</h2>
    <p>User ID: <?php echo $_SESSION['user_id']; ?></p>
    <p>Email: <?php echo $_SESSION['email']; ?></p>
    <p>Password: <?php echo $_SESSION['password']; ?></p>
    <a href="logout.php">Logout</a> -->



    <div class="container mt-4">
        <h1>Profile</h1>
        <h2>Welcome, <?php echo htmlspecialchars($userinfo['username']); ?>!</h2>
        <p><strong>User ID:</strong> <?php echo htmlspecialchars($userinfo['id']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($userinfo['email']); ?></p>
        <!-- <p><strong>Account Created:</strong> <?php echo htmlspecialchars($userinfo['created_at']); ?></p> -->

        <a href="logout.php" class="btn btn-danger">Logout</a>
        <a href="dashboard.php" class="btn btn-primary">Dashboard</a>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>