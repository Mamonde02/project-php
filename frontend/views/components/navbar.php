<?php
// session_start();
require_once "../../backend/config/baseconfig.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Navbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 font-sans">

    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Left links -->
                <div class="flex space-x-4">
                    <a href="dashboard.php" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition">Dashboard</a>
                    <a href="joke.php" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition">Jokes</a>
                    <a href="profile.php" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition">Profile</a>
                    <a href="chat.php" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition">Chat</a>
                    <a href="watch.php" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition">Watch</a>
                </div>

                <!-- Right side -->
                <div class="flex items-center space-x-4">
                    <?php if (isset($_SESSION['user'])): ?>
                        <span class="text-sm text-gray-600">Welcome, <span class="font-medium"><?php echo $_SESSION['user']; ?></span>!</span>
                        <a href="<?php echo BASE_URL . 'frontend/logout.php'; ?>" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1.5 rounded-md text-sm transition">Logout</a>
                    <?php else: ?>
                        <a href="login.php" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

</body>

</html>