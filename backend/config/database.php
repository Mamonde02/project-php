<?php
$host = "localhost";
$dbname = "auth_system";
$username = "root";
$password = "valeroso";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
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
