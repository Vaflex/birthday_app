<?php
session_start();
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Získání uživatelských údajů z databáze
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Ověření správnosti hesla
    if ($user && password_verify($password, $user['password'])) {
        // Uložení informací o uživateli do session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['is_admin'] = $user['is_admin']; // Uložení, zda je uživatel administrátor

        // Přesměrování na administrátorský nebo běžný panel podle role
        if ($_SESSION['is_admin'] == 1) {
            header('Location: admin_dashboard.php'); // Administrátorský panel
        } else {
            header('Location: dashboard.php'); // Běžný uživatelský panel
        }
        exit();
    } else {
        // Pokud přihlašovací údaje nejsou správné
        echo "Špatné přihlašovací údaje!";
    }
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Přihlášení</title>
</head>
<body>
    <h2>Přihlášení</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Uživatelské jméno" required><br><br>
        <input type="password" name="password" placeholder="Heslo" required><br><br>
        <button type="submit">Přihlásit</button>
    </form>
</body>
</html>
