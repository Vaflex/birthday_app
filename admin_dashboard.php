<?php
session_start();
include('config.php');

// Ověření, zda je uživatel přihlášen a má administrátorská práva
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    // Pokud není přihlášený administrátor, přesměrujeme ho na přihlašovací stránku
    header('Location: login.php');
    exit();
}

// Načtení všech uživatelů pro administraci
$sql = "SELECT id, username, email, is_admin FROM users";
$stmt = $pdo->query($sql);
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Administrátorský panel</title>
</head>
<body>
    <h2>Správa uživatelů</h2>

    <table>
        <thead>
            <tr>
                <th>Uživatelské jméno</th>
                <th>Email</th>
                <th>Admin?</th>
                <th>Akce</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo $user['is_admin'] == 1 ? 'Ano' : 'Ne'; ?></td>
                    <td>
                        <!-- Tlačítko pro smazání uživatele -->
                        <form action="delete_user.php" method="POST" onsubmit="return confirm('Opravdu chcete smazat tohoto uživatele?');">
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                            <button type="submit">Smazat</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="logout.php">Odhlásit se</a>

</body>
</html>
