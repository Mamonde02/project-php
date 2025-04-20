<?php
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
    die("Connection failed: " . $e->getMessage());
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
