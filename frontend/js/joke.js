
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

                <br>Setup: ${setup}
                <br>Delivery: ${delivery} 
                <br>ID: ${id}`;

        // Declare the elements for the Joke and target them
        const errorElement = document.getElementById("error");
        errorElement.innerHTML = `Error: ${data.error}`;

        const categoryElement = document.getElementById("category");
        categoryElement.innerHTML = `Category: ${data.category}`;


    } catch (error) {
        console.error(error);
    }
});