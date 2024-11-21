<?php
// Start session
session_start();

// Zrušení všech session proměnných
session_unset();

// Zničení celé session
session_destroy();

// Přesměrování na přihlašovací stránku
header('Location: index.php');
exit();
?>
