<?php
// Vérifie si l'utilisateur est connecté
$isConnected = isset($_SESSION['connected_id']);
// Récupère l'ID de l'utilisateur connecté s'il est défini
$connectedUserId = $isConnected ? $_SESSION['connected_id'] : '';
?>

<?php if (!$isConnected) : ?>
    <a href='admin.php'><img src="img/croix.png" alt="Logo de notre réseau social" /></a>
    <nav id="menu">
        <a href="news.php">Actualités</a>
        <a href="tags.php?tag_id=1">Mots-clés</a>
    </nav>
    <nav id="user">
        <a href="login.php">Me connecter</a>
    </nav>
<?php else :
    // echo "en session avec l'id:" . $_SESSION['connected_id'];
?>
    <a href='admin.php'><img src="img/resoc.jpg" alt="Logo de notre réseau social" /></a>
    <nav id="menu">
        <a href="news.php">Actualités</a>
        <a href="wall.php?user_id=<?php echo $connectedUserId; ?>">Mur</a>
        <a href="feed.php?user_id=<?php echo $connectedUserId; ?>">Flux</a>
        <a href="tags.php?tag_id=1">Mots-clés</a>
    </nav>
    <nav id="user">
        <a href="#">▾ Profil</a>
        <ul>
            <li><a href="settings.php?user_id=<?php echo $connectedUserId; ?>">Paramètres</a></li>
            <li><a href="followers.php?user_id=<?php echo $connectedUserId; ?>">Mes suiveurs</a></li>
            <li><a href="subscriptions.php?user_id=<?php echo $connectedUserId; ?>">Mes abonnements</a></li>
            <li><a href="scripts/logout.php">Déconnexion</a></li>
        </ul>
    </nav>
<?php endif; ?>
