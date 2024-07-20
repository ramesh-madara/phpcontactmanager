<?php
$host = 'localhost';
$dbname = 'contact_manager';
$username = 'root'; // Adjust as necessary
$password = ''; // Adjust as necessary

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
