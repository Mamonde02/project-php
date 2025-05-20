<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sidebar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex flex-col md:flex-row min-h-screen">

    <!-- Mobile Header -->
    <header class="md:hidden bg-white shadow-md flex items-center justify-between px-4 py-3">
        <h1 class="text-indigo-600 font-bold text-lg">Dashboard</h1>
        <button onclick="toggleSidebar()" class="text-gray-600 focus:outline-none">
            ☰
        </button>
    </header>

    <!-- Sidebar -->
    <div id="sidebar"
        class="fixed md:static z-20 w-64 h-screen bg-white border-r shadow-sm transform md:translate-x-0 -translate-x-full transition-transform duration-300 ease-in-out">
        <div class="py-6 text-center border-b">
            <h2 class="text-xl font-semibold text-indigo-600">Dashboard</h2>
        </div>

        <nav class="px-4 py-6 space-y-2">
            <a href="dashboard.php"
                class="flex items-center text-gray-700 hover:bg-indigo-100 px-3 py-2 rounded-md transition">
                🏠 <span class="ml-2">Home</span>
            </a>
            <a href="notes.php"
                class="flex items-center text-gray-700 hover:bg-indigo-100 px-3 py-2 rounded-md transition">
                📝 <span class="ml-2">Notes</span>
            </a>
            <a href="profile.php"
                class="flex items-center text-gray-700 hover:bg-indigo-100 px-3 py-2 rounded-md transition">
                👤 <span class="ml-2">Profile</span>
            </a>

            <?php if (isset($_SESSION['user'])): ?>
                <a href="/php-auth/frontend/logout.php"
                    class="flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md mt-6 transition">
                    🚪 Logout
                </a>
            <?php else: ?>
                <a href="login.php"
                    class="flex items-center text-indigo-600 hover:text-indigo-800 px-3 py-2 rounded-md mt-6 font-medium transition">
                    🔑 <span class="ml-2">Login</span>
                </a>
            <?php endif; ?>
        </nav>
    </div>

    <!-- Main Content -->
    <!-- ml-64 p-6 w-full -->
    <div>
        <!-- Your content here -->
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("-translate-x-full");
        }
    </script>

</body>

</html>