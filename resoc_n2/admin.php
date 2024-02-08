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
        <?php include('scripts/header.php'); ?>
    </header>

    <?php require('scripts/db_connect.php'); ?>
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
            include('scripts/rq_error.php');
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