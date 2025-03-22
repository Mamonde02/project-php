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

    <h2>Joke</h2>
    <h3>Joke of the Day</h3>
    <button id="jokeButton">Get Joke</button>
    <!-- refresh the page refer to get a new joke "joke" element -->
    <p id="joke"></p>

    <p id="error"></p>
    <p id="category"></p>
    <p id="setup"></p>
    <p id="delivery"></p>
    <p id="type"></p>
    <p id="id"></p>


    <script>
        const jokeButton = document.getElementById("jokeButton");
        jokeButton.addEventListener('click', async () => {
            try {
                const response = await fetch("https://v2.jokeapi.dev/joke/Any");
                const data = await response.json();
                console.log(data);

                const joke = data.joke;
                const category = data.category;
                const setup = data.setup;
                const delivery = data.delivery;
                const type = data.type;
                const id = data.id;
                const jokeElement = document.getElementById("joke");

                // Generate Display and Render the Jokes 
                jokeElement.innerHTML = `Joke: ${joke}
                <br>Type: ${type} 
                <br>Category: ${category} 
                <br>Setup: ${setup}
                <br>Delivery: ${delivery} 
                <br>ID: ${id}`;

            } catch (error) {
                console.error(error);
            }
        });
    </script>

</body>

</html>