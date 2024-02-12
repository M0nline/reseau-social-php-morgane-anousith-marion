<?php
// Vérifie si l'utilisateur est connecté
$isConnected = isset($_SESSION['connected_id']);
// Récupère l'ID de l'utilisateur connecté s'il est défini
$connectedUserId = $isConnected ? $_SESSION['connected_id'] : '';
?>

<?php if (!$isConnected) : 
    header("Location: news.php");
exit;
endif; ?>