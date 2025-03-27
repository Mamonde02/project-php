<?php
session_start();
require_once "../config/database.php";

// SIGNUP
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $email, $password])) {
        header("Location: ../../frontend/views/login.php");
        exit();
    } else {
        // echo "Signup failed!";
        echo "<script>alert('Singup failed!'); window.location.href='../../frontend/views/signup.php';</script>";
    }
}

// LOGIN
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];


    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id']; // store user ID in session
        $_SESSION['user'] = $user['username']; // store username in session
        $_SESSION['useremail'] = $user['email']; // store email in session

        header("Location: ../../frontend/views/dashboard.php");
        exit();
    } else {
        // echo "Invalid credentials!";
        echo "<script>alert('Invalid credentials!'); window.location.href='../../frontend/views/login.php';</script>";
    }
}
