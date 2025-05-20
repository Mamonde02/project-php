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

    <div class="ml-64 mt-16 p-6 flex justify-center items-center min-h-[80vh]">
        <!-- Joke Card -->
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden flex flex-col transition hover:shadow-blue-200 duration-300 ease-in-out">

            <!-- Header with Gradient -->
            <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 h-48 w-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white animate-bounce" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C6.48 2 2 6.48 2 12c0 3.09 1.38 5.84 3.55 7.68-.02-.59-.05-1.5.01-2.15.06-.68.39-1.35.86-1.83-2.04-.23-3.95-1.01-3.95-4.49 0-1 .36-1.82.95-2.46-.1-.23-.42-1.15.09-2.4 0 0 .77-.25 2.52.95a8.54 8.54 0 0 1 4.6 0c1.75-1.2 2.52-.95 2.52-.95.5 1.25.19 2.17.09 2.4.59.64.95 1.46.95 2.46 0 3.5-1.92 4.25-3.75 4.48.6.52 1.03 1.4 1.03 2.83 0 2.05-.02 3.7-.02 4.2 0 .23.15.5.55.42A10.006 10.006 0 0 0 22 12c0-5.52-4.48-10-10-10z" />
                </svg>
            </div>

            <!-- Joke Content -->
            <div class="p-6 text-center space-y-3 flex-1">
                <h2 class="text-2xl font-bold text-gray-800">Joke of the Day</h2>
                <p id="joke" class="text-gray-700 italic">Waiting for a Joke...</p>

                <p id="setup" class="text-gray-600 font-medium"></p>
                <p id="delivery" class="text-gray-600 font-medium"></p>

                <div class="text-xs text-gray-400 space-x-2 mt-2">
                    <span id="type"></span>
                    <span id="id"></span>
                </div>
            </div>

            <!-- Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t flex justify-between items-center">
                <p id="category" class="text-xs text-indigo-500 font-semibold uppercase tracking-wide"></p>
                <button id="jokeButton"
                    class="bg-indigo-500 hover:bg-indigo-600 text-white text-xs font-bold uppercase px-4 py-2 rounded-full transition duration-300 shadow-md hover:shadow-lg">
                    New Joke
                </button>
            </div>
        </div>
    </div>

    <script src="../js/joke.js"></script>
</body>

</html>



<!-- previous version of code -->
<!-- <body>

    <div class="content">
        <button id="jokeButton">Get Joke</button>
        refresh the page refer to get a new joke "joke" element
        <p id="joke"></p>
        
        <p id="error"></p>
        <p id="category"></p>
        <p id="setup"></p>
        <p id="delivery"></p>
        <p id="type"></p>
        <p id="id"></p>


        
        <div class="card">
            <div class="header"></div>
            <div class="info">
                <p class="title">Joke of the Day?</p>
                <p id="joke">Waiting for a Joke</p>

                <p id="error"></p>
                <p id="category"></p>
                <p id="setup"></p>
                <p id="delivery"></p>
                <p id="type"></p>
                <p id="id"></p>

            </div>
            <div class="footer">
                <p class="tag">#HTML #CSS </p>
                <p class="tag" id="category"></p>

                <button
                    type="button"
                    class="action"
                    id="jokeButton">
                    Click me for joke
                </button>
            </div>
        </div>
    </div>

    <script src="../js/joke.js"></script>

</body> -->

<!-- <style>
    /* From Uiverse.io by Yaya12085 */
    .card {
        border: 2px solid red;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        /* center manually using margin */
        margin: 0 auto;
        margin-top: 50px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border-radius: 0.75rem;
        background-color: white;
        width: 400px;
        max-width: 90%;
        height: 370px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, .1),
            0 2px 4px -2px rgba(0, 0, 0, .1);
    }

    .header {
        position: relative;
        background-clip: border-box;
        margin-top: 1.5rem;
        margin-left: 1rem;
        margin-right: 1rem;
        border-radius: 0.75rem;
        background-color: rgb(33 150 243);
        box-shadow: 0 10px 15px -3px rgba(33, 150, 243, .4), 0 4px 6px -4px rgba(33, 150, 243, .4);
        height: 14rem;
    }

    .info {
        border: none;
        padding: 1.5rem;
        text-align: center;
    }

    .title {
        color: rgb(38 50 56);
        letter-spacing: 0;
        line-height: 1.375;
        font-weight: 600;
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }

    .footer {
        padding: 0.75rem;
        border: 1px solid rgb(236 239 241);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: rgba(0, 140, 255, 0.082);
    }

    .tag {
        font-weight: 300;
        font-size: .80rem;
        display: block;
    }

    .action {
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        border: none;
        outline: none;
        box-shadow: 0 4px 6px -1px rgba(33, 150, 243, .4), 0 2px 4px -2px rgba(33, 150, 243, .4);
        color: rgb(255 255 255);
        text-transform: uppercase;
        font-weight: 700;
        font-size: .75rem;
        padding: 0.75rem 1.5rem;
        background-color: rgb(33 150 243);
        border-radius: 0.5rem;
        cursor: pointer;
    }

    .content {
        margin-left: 250px;
        margin-top: 60px;
        padding: 20px;
        width: calc(100% - 250px);
    }
</style>

</html> -->