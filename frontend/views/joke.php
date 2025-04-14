<?php
session_start();
require_once "../../backend/config/database.php";

// user session authentication
if (!isset($_SESSION['user_id'])) {
    echo "<br><br> User ID is not set in session. Please log in again.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joking Joker Jokes</title>
</head>

<body>
    <?php include('components/sidebar.php'); ?>

    <div class="content">
        <!-- <button id="jokeButton">Get Joke</button> -->
        <!-- refresh the page refer to get a new joke "joke" element -->
        <!-- <p id="joke"></p>
        
        <p id="error"></p>
        <p id="category"></p>
        <p id="setup"></p>
        <p id="delivery"></p>
        <p id="type"></p>
        <p id="id"></p> -->


        <!-- From Uiverse.io by Yaya12085 -->
        <div class="card">
            <div class="header"></div>
            <div class="info">
                <p class="title">Joke of the Day?</p>
                <p id="joke">Waiting for a Joke</p>

                <!-- <p id="error"></p> -->
                <!-- <p id="category"></p> -->
                <p id="setup"></p>
                <p id="delivery"></p>
                <p id="type"></p>
                <p id="id"></p>

            </div>
            <div class="footer">
                <!-- <p class="tag">#HTML #CSS </p> -->
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

</body>

<style>
    /* From Uiverse.io by Yaya12085 */
    .card {
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

</html>