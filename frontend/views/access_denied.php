<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center px-4">
    <div class="max-w-md w-full space-y-8 text-center bg-white shadow-md rounded-lg p-12">
        <!-- Icon -->
        <div class="flex justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>

        <!-- Heading -->
        <h1 class="text-3xl font-extrabold text-gray-900">Access Denied</h1>

        <!-- Message -->
        <p class="mt-2 text-gray-600">You don't have permission to access this page.</p>

        <!-- Buttons -->
        <div class="mt-6 flex justify-center space-x-4">
            <a href="login.php" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Login
            </a>
            <a href="../../index.php" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Home
            </a>
        </div>
    </div>
</body>

</html>