<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM friends WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$friends = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Vaši přátelé</title>
</head>
<body>
    <h2>Vaši přátelé</h2>
    <a href="add_friend.php">Přidat přítele</a><br><br>
    
    <ul>
        <?php foreach ($friends as $friend): ?>
            <li>
                <?php echo $friend['first_name'] . ' ' . $friend['last_name'] . ' - ' . $friend['birth_date']; ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="logout.php">Odhlásit se</a>

</body>
</html>
