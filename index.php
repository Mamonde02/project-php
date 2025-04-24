<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome HobbyTapp</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto flex justify-between items-center p-6">
            <h1 class="text-2xl font-bold text-indigo-600">HobbyTapp</h1>
            <nav>
                <a href="frontend/views/login.php" class="text-gray-700 hover:text-indigo-600 mx-3">Login</a>
                <a href="frontend/views/signup.php" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">Sign Up</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="text-center py-20 px-6 bg-indigo-50">
        <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Discover Your Hobbies in One Place</h2>
        <p class="text-gray-600 text-lg mb-8 max-w-2xl mx-auto">
            A simple, interesting, exciting and fun way to manage your hobbies system using PHP, MySQL, and Tailwind CSS as our tech stack.
        </p>
        <a href="frontend/views/signup.php" class="bg-indigo-600 text-white px-6 py-3 rounded-lg shadow hover:bg-indigo-700 transition">
            Get Started
        </a>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="max-w-5xl mx-auto text-center">
            <h3 class="text-3xl font-semibold text-gray-800 mb-8">What You’ll Get</h3>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-6 border rounded-lg shadow hover:shadow-md transition">
                    <h4 class="text-xl font-bold text-indigo-600 mb-2">All-in-One Hobby Dashboard🤹</h4>
                    <p class="text-gray-600">Keep track of all your hobbies in a centralized dashboard.</p>
                </div>
                <div class="p-6 border rounded-lg shadow hover:shadow-md transition">
                    <h4 class="text-xl font-bold text-indigo-600 mb-2">Daily Dose of Laughter🤡</h4>
                    <p class="text-gray-600">Enjoy a random joke every time you visit, thanks to our Joke API integration.</p>
                </div>
                <div class="p-6 border rounded-lg shadow hover:shadow-md transition">
                    <h4 class="text-xl font-bold text-indigo-600 mb-2">Random Cat Facts😺</h4>
                    <p class="text-gray-600">Get entertained and educated with quirky, fun cat facts delivered fresh from the CatFact API.</p>
                </div>
                <div class="p-6 border rounded-lg shadow hover:shadow-md transition">
                    <h4 class="text-xl font-bold text-indigo-600 mb-2">Top Anime Highlights🦊</h4>
                    <p class="text-gray-600">Stay updated with the latest trending anime using real-time data from the Jikan API.</p>
                </div>
                <div class="p-6 border rounded-lg shadow hover:shadow-md transition">
                    <h4 class="text-xl font-bold text-indigo-600 mb-2">Real-Time Weather Updates⛅️</h4>
                    <p class="text-gray-600">Check your current local weather so you can plan your hobby time right.</p>
                </div>
                <div class="p-6 border rounded-lg shadow hover:shadow-md transition">
                    <h4 class="text-xl font-bold text-indigo-600 mb-2">Clean & Responsive Design💻</h4>
                    <p class="text-gray-600">Enjoy a smooth experience across all devices, thanks to Tailwind CSS, Bootstrap & uiverse.io sponsorship.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Weather Section -->
    <div class="max-w-xl mx-auto mt-6 space-y-4">

        <!-- Accordion 1: Temperature -->
        <div class="border border-gray-300 rounded-lg overflow-hidden">
            <button onclick="toggleAccordion('temp')" class="w-full px-4 py-3 bg-blue-500 text-white flex justify-between items-center">
                Temperature Info
                <svg id="icon-temp" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="content-temp" class="max-h-0 overflow-hidden transition-all duration-500 bg-white text-gray-700 px-4 py-3 space-y-2">
                <p>🌡️ Temperature: <strong><?php echo $temperature; ?>°C</strong></p>
                <p>🥵 Feels Like: <strong><?php echo $feelsLike; ?>°C</strong></p>
            </div>
        </div>

        <!-- Accordion 2: Wind -->
        <div class="border border-gray-300 rounded-lg overflow-hidden">
            <button onclick="toggleAccordion('wind')" class="w-full px-4 py-3 bg-green-500 text-white flex justify-between items-center">
                Wind Info
                <svg id="icon-wind" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="content-wind" class="max-h-0 overflow-hidden transition-all duration-500 bg-white text-gray-700 px-4 py-3 space-y-2">
                <p>💨 Speed: <strong><?php echo $windSpeed; ?> km/h</strong></p>
                <p>🧭 Direction: <strong><?php echo $windDirection; ?>°</strong></p>
            </div>
        </div>

        <!-- Accordion 3: Forecast -->
        <div class="border border-gray-300 rounded-lg overflow-hidden">
            <button onclick="toggleAccordion('forecast')" class="w-full px-4 py-3 bg-purple-500 text-white flex justify-between items-center">
                Forecast Info
                <svg id="icon-forecast" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="content-forecast" class="max-h-0 overflow-hidden transition-all duration-500 bg-white text-gray-700 px-4 py-3 space-y-2">
                <p>🔮 Forecast: <strong><?php echo $forecast; ?></strong></p>
                <p>🌞 UV Index: <strong><?php echo $uvIndex; ?></strong></p>
                <p>💧 Humidity: <strong><?php echo $humidity; ?>%</strong></p>
            </div>
        </div>

    </div>



    <?php
    date_default_timezone_set('Asia/Manila'); // 🇵🇭 Set to Philippine time zone

    $lat = "10.3157"; // Cebu City
    $lon = "123.8854";
    $url = "https://api.open-meteo.com/v1/forecast?latitude=$lat&longitude=$lon&current_weather=true";

    $response = @file_get_contents($url);

    if ($response === FALSE) {
        $error = "⚠️ Failed to connect to the weather API.";
        $weatherData = null;
    } else {
        $data = json_decode($response, true);

        if (isset($data['current_weather'])) {
            $utcTime = $data['current_weather']['time']; // This is in UTC
            $dt = new DateTime($utcTime, new DateTimeZone("UTC"));
            $dt->setTimezone(new DateTimeZone("Asia/Manila")); // Convert to PHT

            $weatherData = [
                'temperature' => $data['current_weather']['temperature'],
                'windspeed' => $data['current_weather']['windspeed'],
                'condition_code' => $data['current_weather']['weathercode'],
                'time' => $dt->format("F j, Y g:i A")
            ];
            $error = null;
        } else {
            $weatherData = null;
            $error = "⚠️ Weather data is currently unavailable.";
        }
    }
    ?>

    <?php if ($error): ?>
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded-md shadow-md text-center max-w-md mx-auto">
            <?php echo $error; ?>
        </div>

    <?php elseif ($weatherData): ?>
        <div class="bg-blue-50 border rounded-xl shadow-md max-w-md mx-auto mt-6 p-6">
            <h3 class="text-xl font-semibold text-indigo-600 mb-3">🌤️ Cebu City Weather</h3>
            <p class="text-gray-700 mb-1"><strong>Temperature:</strong> <?= $weatherData['temperature']; ?>°C</p>
            <p class="text-gray-700 mb-1"><strong>Wind Speed:</strong> <?= $weatherData['windspeed']; ?> km/h</p>
            <p class="text-gray-700 mb-1"><strong>Weather Update Time:</strong> <?= $weatherData['time']; ?></p>
            <p class="text-gray-700 mt-4"><strong>📍 Current Philippine Time:</strong> <span id="liveClock"></span></p>
        </div>
    <?php endif; ?>

    <div class="mt-16 bg-blue-50 p-6 border rounded-lg shadow hover:shadow-md transition flex flex-col items-center text-center">
        <img src="frontend/assets/Picme.jpeg" alt="Developer Image" class="w-24 h-24 rounded-full mb-4 object-cover shadow-md">
        <h4 class="text-xl font-bold text-indigo-600 mb-1">Developed by</h4>
        <p class="text-gray-700 font-semibold mb-1">John Raymund Valeroso</p>
        <p class="text-gray-500 text-sm">Web Developer | Full Stack Developer | Software Developer</p>
    </div>


    <!-- Footer -->
    <footer class="bg-indigo-500 py-6 mt-10 text-center text-sm text-white">
        © <?= date("Y") ?> HobbyTapp. All rights reserved.
    </footer>

    <script>
        function updateClock() {
            const now = new Date();
            const options = {
                timeZone: 'Asia/Manila',
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric',
                hour12: true
            };
            const formatter = new Intl.DateTimeFormat([], options);
            document.getElementById("liveClock").textContent = formatter.format(now);
        }

        setInterval(updateClock, 1000); // update every second
        updateClock(); // run on page load


        function toggleAccordion(id) {
            const content = document.getElementById(`content-${id}`);
            const icon = document.getElementById(`icon-${id}`);
            content.classList.toggle('max-h-0');
            content.classList.toggle('max-h-96');
            icon.classList.toggle('rotate-180');
        }
    </script>

</body>

</html>