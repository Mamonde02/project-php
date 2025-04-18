<?php
session_start();
require_once "../config/database.php";
require_once "../models/user.php";
require_once "../config/baseconfig.php";

$userModel = new User($pdo);

// SIGNUP
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    // $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    // $confirm_password = password_hash($_POST['confirm_password'], PASSWORD_DEFAULT);

    $password_raw = $_POST['password'];
    $confirm_password_raw = $_POST['confirm_password'];

    if ($password_raw !== $confirm_password_raw) {
        // echo "Passwords do not match!";
        // echo "<script>alert('Passwords do not match!'); window.location.href='../../frontend/views/signup.php';</script>";
        // exit();

        // $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/php-auth/';
        $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/';
        header("Location: " . $baseUrl . "frontend/views/signup.php");
        exit();
    }

    if (strlen($password_raw) < 6) {
        // echo "<script>alert('Passwords should be 6 characters!'); window.location.href='../../frontend/views/signup.php';</script>";

        $_SESSION['error'] = "Password should be 6 characters!";

        // $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/php-auth/';
        $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/';
        header("Location: " . $baseUrl . "frontend/views/signup.php");
        exit();
    }

    // Hash only after confirmation
    $password = password_hash($password_raw, PASSWORD_DEFAULT);

    // Check if email already exists
    // $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    // $stmt->execute([$email]);

    $existingUser = $userModel->findByEmail($email);

    if ($existingUser) {
        // echo "Email already exists!";
        // echo "<script>alert('Email already exists!'); window.location.href='../../frontend/views/signup.php';</script>";
        // exit();

        // $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/php-auth/';
        $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/';
        header("Location: " . $baseUrl . "frontend/views/signup.php");
        exit();
    }

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $email, $password])) {
        // header("Location: ../../frontend/views/login.php");
        // exit();

        // $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/php-auth/';
        $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/';
        header("Location: " . $baseUrl . "frontend/views/login.php");
        exit();
    } else {
        // echo "Signup failed!";
        // echo "<script>alert('Singup failed!'); window.location.href='../../frontend/views/signup.php';</script>";

        $_SESSION['error'] = "Signup failed!";

        // $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/php-auth/';
        $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/';
        header("Location: " . $baseUrl . "frontend/views/signup.php");
        exit();
    }
}

// LOGIN
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];


    // $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    // $stmt->execute([$email]);
    // $user = $stmt->fetch();

    $user = $userModel->findByEmail($email);


    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id']; // store user ID in session
        $_SESSION['user'] = $user['username']; // store username in session
        $_SESSION['useremail'] = $user['email']; // store email in session

        // ✅ Set toast message
        $_SESSION['toast_message'] = "Welcome to Homepage Dashboard, " . $user['username'] . "!";

        // header("Location: ../../frontend/views/dashboard.php");
        // exit();

        // $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/php-auth/';

        // import BASE_URL from config.php
        header("Location: " . BASE_URL . "frontend/views/dashboard.php");
        exit();
    } else {
        // echo "Invalid credentials!";
        // echo "<script>alert('Invalid credentials!'); window.location.href='../../frontend/views/login.php';</script>";

        $_SESSION['message'] = "Invalid credentials.";
        $_SESSION['message_type'] = "danger";
        // header("Location: ../../frontend/views/login.php");
        // exit();

        // $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/php-auth/';
        $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/';
        header("Location: " . $baseUrl . "frontend/views/login.php");
        exit();
    }
}

// UPDATE USER PROFILE
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {

    $user_id = $_SESSION['user_id'];
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        // Check if the email is already taken by another user
        // do logic here create another model
        // $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
        // $stmt->execute([$email, $user_id]);

        $checkEmail = $userModel->checkByEmailId($email, $user_id);
        if ($checkEmail) {
            $_SESSION['message'] = "Email is already in use by another account.";
            $_SESSION['message_type'] = "danger";

            // header("Location: ../../frontend/views/profile.php");
            // exit();

            // $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/php-auth/';
            $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/';
            header("Location: " . $baseUrl . "frontend/views/profile.php");
            exit();
        }

        // // Update user information
        // if ($password) {
        //     // $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
        //     // $stmt->execute([$username, $email, $password, $user_id]);
        //     // $updateUser = $userModel->update($user_id, $username, $email, $password);
        //     $updateUser = $userModel->updateProfile($user_id, $username, $email);
        // } else {
        //     $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
        //     $stmt->execute([$username, $email, $user_id]);
        // }

        $updateUser = $userModel->updateProfile($user_id, $username, $email);

        // Update session variables
        $_SESSION['user'] = $username;
        $_SESSION['useremail'] = $email;
        $_SESSION['password'] = $password;

        $_SESSION['message'] = "Profile updated successfully!";
        $_SESSION['message_type'] = "success";
        // header("Location: ../../frontend/views/profile.php");
        // exit();

        // $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/php-auth/';
        $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/';
        header("Location: " . $baseUrl . "frontend/views/profile.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['message'] = "An error occurred: " . $e->getMessage();
        $_SESSION['message_type'] = "danger";
        // header("Location: ../../frontend/views/profile.php");
        // exit();

        $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/php-auth/';
        header("Location: " . $baseUrl . "frontend/views/profile.php");
        exit();
    }
}

// CHANGE PASSWORD
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_password'])) {
    $user_id = $_SESSION['user_id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $_SESSION['message'] = "New password and confirm password do not match.";
        $_SESSION['message_type'] = "danger";
        // header("Location: ../../frontend/views/profile.php");
        // exit();

        // $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/php-auth/';
        $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/';
        header("Location: " . $baseUrl . "frontend/views/profile.php");
        exit();
    }

    try {
        $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!password_verify($current_password, $user['password'])) {
            $_SESSION['message'] = "Current password is incorrect.";
            $_SESSION['message_type'] = "danger";
            // header("Location: ../../frontend/views/profile.php");
            // exit();  

            // $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/php-auth/';
            $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/';
            header("Location: " . $baseUrl . "frontend/views/profile.php");
            exit();
        }

        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->execute([password_hash($new_password, PASSWORD_DEFAULT), $user_id]);

        $_SESSION['message'] = "Password changed successfully!";
        $_SESSION['message_type'] = "success";
        // header("Location: ../../frontend/views/profile.php");
        // exit();

        // $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/php-auth/';
        $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/';
        header("Location: " . $baseUrl . "frontend/views/profile.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['message'] = "An error occurred: " . $e->getMessage();
        $_SESSION['message_type'] = "danger";
        // header("Location: ../../frontend/views/profile.php");
        // exit();

        // $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/php-auth/';
        $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/';
        header("Location: " . $baseUrl . "frontend/views/profile.php");
        exit();
    }
}
