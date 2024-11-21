<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hashování hesla
    $email = $_POST['email'];

    // Získání hodnoty pro is_admin - pokud je checkbox označen, nastaví hodnotu na 1 (admin)
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    // Vložení nového uživatele do databáze
    $sql = "INSERT INTO users (username, password, email, is_admin) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $password, $email, $is_admin]);

    // Přesměrování na přihlašovací stránku po úspěšné registraci
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Registrace</title>
</head>
<body>
    <h2>Registrace</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Uživatelské jméno" required><br><br>
        <input type="password" name="password" placeholder="Heslo" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        
        <!-- Checkbox pro označení administrátora (možnost pro správce) -->
        <label for="is_admin">
            <input type="checkbox" name="is_admin" value="1"> Udělat mě administrátorem
        </label><br><br>
        
        <button type="submit">Registrovat</button>
    </form>
</body>
</html>
