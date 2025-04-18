<?php

$projectPath = '/'; // <-- For Docker (use '/' if app is at the root)
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false && $_SERVER['SERVER_PORT'] == '80') {
    // For XAMPP (php-auth is the folder inside htdocs)
    $projectPath = '/php-auth/';
}

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? "https://" : "http://";
define('BASE_URL', $protocol . $_SERVER['HTTP_HOST'] . $projectPath);




// Automatically detect HTTP or HTTPS
// $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";

// // Your host (localhost or your domain)
// $host = $_SERVER['HTTP_HOST'];

// // Set the base path of your project
// // If you're using XAMPP and your project is in htdocs/php-auth
// $projectPath = '/php-auth/'; // <-- make sure this matches your folder

// define('BASE_URL', $protocol . $host . $projectPath);


// Remove trailing slash
// $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
// $host = $_SERVER['HTTP_HOST'];
// $scriptDir = dirname($_SERVER['SCRIPT_NAME']);

// define('BASE_URL', rtrim($protocol . "://" . $host . $scriptDir, "/") . "/");