<?php
session_start();
session_destroy();
// header("Location: frontend/views/login.php");
header("Location: views/login.php"); // Redirect to login page

$baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/php-auth/';
header("Location: " . $baseUrl . "frontend/views/login.php");

exit();
?>
