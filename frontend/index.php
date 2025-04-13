<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome | PHP Auth</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto flex justify-between items-center p-6">
            <h1 class="text-2xl font-bold text-indigo-600">PHP Auth</h1>
            <nav>
                <a href="views/login.php" class="text-gray-700 hover:text-indigo-600 mx-3">Login</a>
                <a href="views/signup.php" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">Sign Up</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="text-center py-20 px-6 bg-indigo-50">
        <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Simplify Your Login System</h2>
        <p class="text-gray-600 text-lg mb-8 max-w-2xl mx-auto">
            A simple, secure, and responsive authentication system using PHP, MySQL, and Tailwind CSS.
        </p>
        <a href="views/signup.php" class="bg-indigo-600 text-white px-6 py-3 rounded-lg shadow hover:bg-indigo-700 transition">
            Get Started
        </a>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="max-w-5xl mx-auto text-center">
            <h3 class="text-3xl font-semibold text-gray-800 mb-8">What You’ll Get</h3>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-6 border rounded-lg shadow hover:shadow-md transition">
                    <h4 class="text-xl font-bold text-indigo-600 mb-2">Secure Login</h4>
                    <p class="text-gray-600">Protect your users with hashed passwords and safe sessions.</p>
                </div>
                <div class="p-6 border rounded-lg shadow hover:shadow-md transition">
                    <h4 class="text-xl font-bold text-indigo-600 mb-2">Clean Design</h4>
                    <p class="text-gray-600">Responsive layout using Tailwind for a modern UI feel.</p>
                </div>
                <div class="p-6 border rounded-lg shadow hover:shadow-md transition">
                    <h4 class="text-xl font-bold text-indigo-600 mb-2">Ready to Deploy</h4>
                    <p class="text-gray-600">Easily deploy on platforms like Render with Docker support.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-200 py-6 mt-10 text-center text-sm text-gray-600">
        © <?= date("Y") ?> PHP Auth Project. All rights reserved.
    </footer>

</body>

</html>