<?php
// Automatically detect HTTP or HTTPS
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";

// Your host (localhost or your domain)
$host = $_SERVER['HTTP_HOST'];

// Set the base path of your project
// If you're using XAMPP and your project is in htdocs/php-auth
$projectPath = '/php-auth/'; // <-- make sure this matches your folder

define('BASE_URL', $protocol . $host . $projectPath);


// Remove trailing slash
// $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
// $host = $_SERVER['HTTP_HOST'];
// $scriptDir = dirname($_SERVER['SCRIPT_NAME']);

// define('BASE_URL', rtrim($protocol . "://" . $host . $scriptDir, "/") . "/");