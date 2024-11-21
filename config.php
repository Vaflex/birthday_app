<?php
$host = 'localhost';  // nebo jiný hostitel
$dbname = 'birthday_app';
$username = 'root';   // nebo jiný uživatelský účet MySQL
$password = '';       // nebo zadej své heslo k MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
