<?php
session_start();
require_once "../../backend/config/database.php";

// user session authentication
if (!isset($_SESSION['user_id'])) {
    echo "<br><br> User ID is not set in session. Please log in again.";
    // header("Location: login.php");
    header("Location: access_denied.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joking Joker Jokes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<!-- class="bg-gray-100 min-h-screen" -->

<body>
    <?php include('components/sidebar.php'); ?>

    <div class="ml-64 mt-16 p-4 flex justify-center items-center">
        <!-- Joke Card -->
        <div class="bg-white w-full max-w-md rounded-xl shadow-lg overflow-hidden flex flex-col">
            <div class="bg-blue-500 h-56 w-full"></div>

            <div class="p-6 text-center flex-1">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Joke of the Day?</h2>
                <p id="joke" class="text-gray-600 mb-4">Waiting for a Joke</p>

                <p id="setup" class="text-gray-600"></p>
                <p id="delivery" class="text-gray-600"></p>
                <p id="type" class="text-sm text-gray-400"></p>
                <p id="id" class="text-sm text-gray-400"></p>
            </div>

            <div class="px-6 py-4 bg-blue-50 flex justify-between items-center border-t">
                <p id="category" class="text-xs text-gray-500 uppercase tracking-wide"></p>
                <button id="jokeButton"
                    class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold uppercase px-4 py-2 rounded-md transition">
                    Click me for joke
                </button>
            </div>
        </div>
    </div>

    <script src="../js/joke.js"></script>
</body>

</html>