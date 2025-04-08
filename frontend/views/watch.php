<?php
session_start();
require_once "../../backend/config/database.php";


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

    <div class="container mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold text-center mb-8">Anime List Collection</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            <?php foreach ($animes as $anime): ?>
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <!-- <img class="w-full h-48 object-cover" src="https://via.placeholder.com/300x200?text=Watch+1" alt="Watch 1"> -->
                    <img class="w-full h-48 object-cover" src=<?php echo $anime["images"]["jpg"]["image_url"] ?> alt="Watch Anime 1">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold"><?php echo $anime["title"]; ?></h2>
                        <p class="text-gray-600">Type: <?php echo $anime["type"] ?></p>
                        <p class="text-gray-600">Score: <?php echo $anime["score"] ?></p>
                        <p class="text-gray-600">Year: <?php echo $anime["year"] ?></p>

                        <p class="text-blue-500 font-bold mt-2">Rating: <?php echo $anime["score"] ?></p>
                        <button class="mt-4 w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">View</button>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

</body>

</html>