<?php
// Start session
session_start();

// Pokud je uživatel již přihlášen, přesměrujeme ho na dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

// Zpracování přihlášení
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kontrola uživatele v databázi
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Ověření hesla
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Špatné přihlašovací údaje!";
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

    <!-- Pokud došlo k chybě při přihlášení -->
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <!-- Přihlašovací formulář -->
    <form method="POST">
        <input type="text" name="username" placeholder="Uživatelské jméno" required><br><br>
        <input type="password" name="password" placeholder="Heslo" required><br><br>
        <button type="submit">Přihlásit</button>
    </form>

    <br>
    <!-- Odkaz na stránku registrace pro nové uživatele -->
    <a href="register.php">Nemáš účet? Zaregistruj se zde</a>
</body>
</html>
