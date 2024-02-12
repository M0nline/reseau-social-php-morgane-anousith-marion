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
        <title>ReSoC - Paramètres</title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <header>
        <?php include_once('scripts/header.php'); ?>

        </header>
        <div id="wrapper" class='profile'>


            <aside>
                <img src="img/user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>Paramètres</h3>
                    <p>Sur cette page vous trouverez les informations de l'utilisatrice
                        n° <?php echo intval($_GET['user_id']) ?></p>

                </section>
            </aside>
            <main>
                <?php
                // on récupère l'id 
                $userId = intval($_GET['user_id']);
                $laQuestionEnSql = "
                    SELECT users.*, 
                        count(DISTINCT posts.id) as totalpost, 
                        count(DISTINCT given.post_id) as totalgiven, 
                        count(DISTINCT received.user_id) as totalreceived 
                    FROM users 
                    LEFT JOIN posts ON posts.user_id=users.id 
                    LEFT JOIN likes as given ON given.user_id=users.id 
                    LEFT JOIN likes as received ON received.post_id=posts.id 
                    WHERE users.id = '$userId' 
                    GROUP BY users.id
                    ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                include_once('scripts/rq_error.php');
                $user = $lesInformations->fetch_assoc();

                        ?>                
                <article class='parameters'>
                    <h3>Mes paramètres</h3>
                    <dl>
                        <dt>Pseudo</dt>
                        <dd><?php echo $user ['alias'] ?></dd>
                        <dt>Email</dt>
                        <dd><?php echo $user ['email'] ?></dd>
                        <dt>Nombre de message</dt>
                        <dd><?php echo $user ['totalpost'] ?></dd>
                        <dt>Nombre de "J'aime" donnés </dt>
                        <dd><?php echo $user ['totalgiven'] ?></dd>
                        <dt>Nombre de "J'aime" reçus</dt>
                        <dd><?php echo $user ['totalreceived'] ?></dd>
                    </dl>

                </article>
            </main>
        </div>
    </body>
</html>
