<?php
// session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
        }

        .navbar a:hover {
            background-color: #575757;
            border-radius: 5px;
        }

        .logout-btn {
            background-color: red;
            padding: 8px 15px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div>
            <a href="dashboard.php">Dashboard</a>
            <a href="joke.php">Jokes</a>
            <a href="profile.php">Profile</a>
            <a href="chat.php">Chat</a>
        </div>
        <div>
            <?php if (isset($_SESSION['user'])): ?>
                <span style="color: white; margin-right: 10px;">Welcome, <?php echo $_SESSION['user']; ?>!</span>
                <a class="logout-btn" href="/php-auth/frontend/logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>