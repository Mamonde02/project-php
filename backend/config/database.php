<?php
require_once 'baseconfig.php';
// $host = "localhost";
// $dbname = "auth_system";
// $dbusername = "root";
// $dbpassword = "valeroso";
$host = getenv('DB_HOST') ?: 'localhost';
$dbname = getenv('DB_NAME') ?: 'auth_system';
$dbusername = getenv('DB_USER') ?: 'root';
$dbpassword = getenv('DB_PASS') ?: 'valeroso';
$port = getenv('DB_PORT') ?: 5432;

try {
    // mysql driver
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    // pgsql driver
    // $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "✅ Server is running: Database connected successfully!";
} catch (PDOException $e) {
    // Debugging line to check the connection error
    // die("Connection failed: " . $e->getMessage());
    error_log("Database connection failed: " . $e->getMessage());

    // die("<script>alert('❌ Server is down: Database connection failed!');</script>" . $e->getMessage());
    // echo ("<script>alert('❌ Server is down: Database connection failed!');</script>");
    header("Location: " . BASE_URL . "frontend/views/error500.php");
    exit();
}



// // Assuming you have a valid database connection here
// $servername = 'localhost';
// $db_id = 'root';
// $db_password = 'valeroso'; // change
// $db_name = 'maininventorydb';

// // Attempt to connect to the database
// $con = mysqli_connect($servername, $db_id, $db_password, $db_name);

// // Check for connection errors
// if (!$con) {
//     die('Connection failed: ' . mysqli_connect_error());
// }
