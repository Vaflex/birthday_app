<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birth_date = $_POST['birth_date'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO friends (first_name, last_name, birth_date, user_id) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$first_name, $last_name, $birth_date, $user_id]);

    header('Location: dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Přidat přítele</title>
</head>
<body>
    <h2>Přidat přítele</h2>
    <form method="POST">
        <input type="text" name="first_name" placeholder="Křestní jméno" required><br><br>
        <input type="text" name="last_name" placeholder="Příjmení" required><br><br>
        <input type="date" name="birth_date" placeholder="Datum narození" required><br><br>
        <button type="submit">Přidat</button>
    </form>
</body>
</html>
