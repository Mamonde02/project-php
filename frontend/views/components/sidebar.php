<!-- <?php
session_start();
?> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sidebar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <div class="w-64 h-screen bg-white border-r shadow-sm flex flex-col fixed">
        <div class="py-6 text-center border-b">
            <h2 class="text-xl font-semibold text-indigo-600">Dashboard</h2>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="dashboard.php" class="flex items-center text-gray-700 hover:bg-indigo-100 px-3 py-2 rounded-md transition">
                🏠 <span class="ml-2">Home</span>
            </a>
            <a href="notes.php" class="flex items-center text-gray-700 hover:bg-indigo-100 px-3 py-2 rounded-md transition">
                📝 <span class="ml-2">Notes</span>
            </a>
            <a href="profile.php" class="flex items-center text-gray-700 hover:bg-indigo-100 px-3 py-2 rounded-md transition">
                👤 <span class="ml-2">Profile</span>
            </a>

            <?php if (isset($_SESSION['user'])): ?>
                <a href="/php-auth/frontend/logout.php" class="flex items-center justify-center bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md mt-6 transition">
                    🚪 Logout
                </a>
            <?php else: ?>
                <a href="login.php" class="flex items-center text-indigo-600 hover:text-indigo-800 px-3 py-2 rounded-md mt-6 font-medium transition">
                    🔑 <span class="ml-2">Login</span>
                </a>
            <?php endif; ?>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="ml-64 p-6 w-full">
        <!-- Your content here -->
    </div>

</body>

</html>