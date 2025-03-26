<!-- <?php
session_start();
?> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #333;
            color: white;
            padding-top: 20px;
            position: fixed;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 15px;
            text-decoration: none;
            margin: 5px 10px;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        .sidebar .logout-btn {
            background-color: red;
            padding: 10px;
            text-align: center;
            margin-top: 20px;
        }

        .sidebar .logout-btn:hover {
            background-color: darkred;
        }

        .content {
            margin-left: 260px;
            padding: 20px;
            width: calc(100% - 260px);
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <!-- <aside> -->
            <h2 style="text-align: center;">Dashboard</h2>
            <a href="dashboard.php">🏠 Home</a>
            <a href="notes.php">📝 Notes</a>
            <a href="profile.php">👤 Profile</a>
            <?php if (isset($_SESSION['user'])): ?>
                <a class="logout-btn" href="/php-auth/frontend/logout.php">🚪 Logout main</a>
            <?php else: ?>
                <a href="login.php">🔑 Login</a>
            <?php endif; ?>
        <!-- </aside> -->
    </div>

</body>

</html>