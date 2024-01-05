<?php
$host = '127.0.0.1';
$port = 3306;  // Default MySQL port
$dbname = 'moodle';
$user = 'moodle';
$pass = 'moodle';

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname";
    $conn = new PDO($dsn, $user, $pass);

    // Set PDO to throw exceptions on errors
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Now you can use $conn for your database operations

    // Example: Fetch all records from a table
    $stmt = $conn->query("SELECT * FROM mdl_input_data");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    print_r($results);

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
