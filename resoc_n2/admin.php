<?php
require('scripts/db_connect.php');
// Vérifiez si une session n'est pas déjà active avant de démarrer une nouvelle session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once('scripts/redir.php')
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Administration</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <header>
        <?php include_once('scripts/header.php'); ?>
    </header>

    <div id="wrapper" class='admin'>
        <aside>
            <h2>Mots-clés</h2>
            <?php
            $laQuestionEnSql = "SELECT * FROM `tags` LIMIT 50";
            $lesInformations = $mysqli->query($laQuestionEnSql);


            while ($tag = $lesInformations->fetch_assoc()) {
            ?>
                <article>
                    <h3>#<?php echo $tag['label'] ?></h3>
                    <p>id:<?php echo $tag['id'] ?></p>
                    <nav>
                        <a href="tags.php?tag_id=<?php echo $tag['id'] ?>">Messages</a>
                    </nav>
                </article>
            <?php } ?>
        </aside>
        <main>
            <h2>Utilisatrices</h2>
            <?php
            $laQuestionEnSql = "SELECT * FROM `users` LIMIT 50";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            include_once('scripts/rq_error.php');
            while ($user = $lesInformations->fetch_assoc()) {
            ?>
                <article>
                    <h3><a href="wall.php?user_id=<?php echo $user['id']; ?>"><?php echo $user['alias']; ?></a></h3>
                    <p>id:<?php echo $user['id'] ?></p>
                    <nav>
                        <a href="wall.php?user_id=<?php echo $user['id'] ?>">Mur</a>
                        | <a href="feed.php?user_id=<?php echo $user['id'] ?>">Flux</a>
                        | <a href="settings.php?user_id=<?php echo $user['id'] ?>">Paramètres</a>
                        | <a href="followers.php?user_id=<?php echo $user['id'] ?>">Suiveuses</a>
                        | <a href="subscriptions.php?user_id=<?php echo $user['id'] ?>">Abonnements</a>
                    </nav>
                </article>
            <?php } ?>
        </main>
    </div>
</body>

</html>