<?php
session_start();
require_once "../../backend/config/database.php";

if (!isset($_SESSION['user_id'])) {
    echo "User ID is not set in session. Please log in again.";
    header("Location: login.php");
    exit();
}


// <!-- https://api.jikan.moe/v4/top/anime -->

$url = 'https://api.jikan.moe/v4/top/anime?limit=10';

$response = file_get_contents($url);
$data = json_decode($response, true);

// collect data anime 10 list
$animes = $data["data"];

// print_r($data);

// print_r($data["data"][0]["title"]);

$id = $data["data"][0]["mal_id"];
$title = $data["data"][0]["title"];
$type = $data["data"][0]["type"];
$source = $data["data"][0]["source"];
$score = $data["data"][0]["score"];
$synopsis = $data["data"][0]["synopsis"];
$season = $data["data"][0]["season"];
$year = $data["data"][0]["year"];


$image = $data["data"][0]["images"]["jpg"]["image_url"];
$trailer = $data["data"][0]["trailer"]["url"];
$url = $data["data"][0]["url"];

// print_r($image);
// print_r($score);
// print_r($synopsis);
// print_r($season);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Watch Cards</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <?php include('components/navbar.php'); ?>

    <div class="container mx-auto px-4 py-10">
        <div class="max-w-md mx-auto mb-6">
            <input
                type="text"
                id="searchInput"
                placeholder="Search by title..."
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
        </div>

        <h1 class="text-3xl font-bold text-center mb-8">Anime List Collection</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            <?php foreach ($animes as $anime): ?>
                <!-- <div class="bg-white shadow-md rounded-lg overflow-hidden"> -->
                <div class="anime-card bg-white shadow-md rounded-lg overflow-hidden" data-title="<?php echo strtolower($anime['title']); ?>">
                    <!-- <img class="w-full h-48 object-cover" src="https://via.placeholder.com/300x200?text=Watch+1" alt="Watch 1"> -->
                    <img class="w-full h-48 object-cover" src=<?php echo $anime["images"]["jpg"]["image_url"] ?> alt="Watch Anime 1">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold"><?php echo $anime["title"]; ?></h2>
                        <p class="text-gray-600">Type: <?php echo $anime["type"] ?></p>
                        <p class="text-gray-600">Score: <?php echo $anime["score"] ?></p>
                        <p class="text-gray-600">Year: <?php echo $anime["year"] ?></p>

                        <p class="text-blue-500 font-bold mt-2">Rating: <?php echo $anime["score"] ?></p>
                        <!-- view the anime url details button -->
                        <button class="mt-4 w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700"
                            onclick="window.location.href = '<?php echo $anime["url"] ?>'">
                            View Details
                        </button>
                        <button class="mt-4 w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700"
                            onclick="window.location.href = '<?php echo $anime["trailer"]["url"] ?>'">
                            Watch Trailer
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const animeCards = document.querySelectorAll('.anime-card');

        searchInput.addEventListener('input', () => {
            const query = searchInput.value.toLowerCase();

            animeCards.forEach(card => {
                const title = card.getAttribute('data-title');
                card.style.display = title.includes(query) ? 'block' : 'none';
            });
        });
    </script>
    
</body>

</html>