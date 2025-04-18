<?php
session_start();
session_destroy();
require_once "../backend/config/baseconfig.php";
// header("Location: frontend/views/login.php");
// header("Location: views/login.php"); // Redirect to login page

// $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/php-auth/';
// $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/';
// header("Location: " . $baseUrl . "frontend/views/login.php");

header("Location: " . BASE_URL . "frontend/views/login.php");

exit();
?>
