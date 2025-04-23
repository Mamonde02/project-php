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
    <script>
        tailwind.config = {
            theme: {
                extend: {},
            }
        }
    </script>
</head>

<body class="bg-gray-50 font-sans">

    <!-- Sticky Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                <!-- Brand or Logo -->
                <div class="flex items-center">
                    <a href="dashboard.php" class="text-xl font-semibold text-indigo-600">HobbyTapp</a>
                </div>

                <!-- Hamburger (mobile) -->
                <div class="md:hidden">
                    <button onclick="toggleMenu()" class="text-gray-700 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <!-- Navigation links -->
                <div class="hidden md:flex space-x-4">
                    <a href="dashboard.php" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition">Dashboard</a>
                    <a href="joke.php" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition">Jokes</a>
                    <a href="profile.php" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition">Profile</a>
                    <a href="chat.php" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition">Chat</a>
                    <a href="watch.php" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition">Watch</a>
                </div>

                <!-- Auth -->
                <div class="hidden md:flex items-center space-x-4">
                    <?php if (isset($_SESSION['user'])): ?>
                        <span class="text-sm text-gray-600">Welcome, <span class="font-medium"><?php echo $_SESSION['user']; ?></span>!</span>
                        <a href="<?php echo BASE_URL . 'frontend/logout.php'; ?>" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1.5 rounded-md text-sm transition">Logout</a>
                    <?php else: ?>
                        <a href="login.php" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="md:hidden hidden px-4 pb-4">
            <div class="flex flex-col space-y-2">
                <a href="dashboard.php" class="text-gray-700 hover:text-indigo-600 block">Dashboard</a>
                <a href="joke.php" class="text-gray-700 hover:text-indigo-600 block">Jokes</a>
                <a href="profile.php" class="text-gray-700 hover:text-indigo-600 block">Profile</a>
                <a href="chat.php" class="text-gray-700 hover:text-indigo-600 block">Chat</a>
                <a href="watch.php" class="text-gray-700 hover:text-indigo-600 block">Watch</a>

                <?php if (isset($_SESSION['user'])): ?>
                    <span class="text-sm text-gray-600">Welcome, <?php echo $_SESSION['user']; ?>!</span>
                    <a href="<?php echo BASE_URL . 'frontend/logout.php'; ?>" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1.5 rounded-md text-sm transition mt-2">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium mt-2">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- JS for toggling mobile menu -->
    <script>
        function toggleMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }
    </script>

</body>

</html>