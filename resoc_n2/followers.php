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
    <title>ReSoC - Mes abonnés </title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <header>
        <?php include_once('scripts/header.php'); ?>

    </header>
    <div id="wrapper">
        <aside>
            <img src="img/user.jpg" alt="Portrait de l'utilisatrice" />
            <section>
                <h3>Suiveuses</h3>
                <p>Sur cette page vous trouverez la liste des personnes qui
                    suivent les messages de l'utilisatrice
                    n° <?php echo intval($_GET['user_id']) ?></p>

            </section>
        </aside>
        <main class='contacts'>
            <?php
            $userId = intval($_GET['user_id']);
            $laQuestionEnSql = "
                    SELECT users.*
                    FROM followers
                    LEFT JOIN users ON users.id=followers.following_user_id
                    WHERE followers.followed_user_id='$userId'
                    GROUP BY users.id
                    ";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            include_once('scripts/get_users.php'); 
            ?>        
        </main>
    </div>
</body>

</html>