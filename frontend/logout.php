<?php
session_start();
session_destroy();
// header("Location: frontend/views/login.php");
header("Location: views/login.php"); // Redirect to login page
exit();
?>
