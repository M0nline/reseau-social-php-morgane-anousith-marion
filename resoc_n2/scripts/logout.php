<?php
// Vérifiez si une session n'est pas déjà active avant de démarrer une nouvelle session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
session_destroy();
header("Location: ../login.php"); 
exit();
?>