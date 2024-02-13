<?php
require('scripts/db_connect.php');
// Vérifiez si une session n'est pas déjà active avant de démarrer une nouvelle session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Actualités</title>
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
                <h3>Actualités</h3>
                <p>Sur cette page, vous trouverez les 5 derniers messages publiés sur le site.</p>
            </section>
        </aside>
        <main>
            <?php $laQuestionEnSql = "
                    SELECT  posts.content,
                            posts.id as post_id,
                            posts.created,
                            posts.user_id as author_id,  
                            users.alias as author_name,
                            count(likes.id) as like_number,  
                            GROUP_CONCAT(DISTINCT tags.label) as taglist,
                            GROUP_CONCAT(DISTINCT tags.id) as tag_ids
                    FROM posts
                            JOIN users           ON users.id = posts.user_id
                            LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                            LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                            LEFT JOIN likes      ON likes.post_id  = posts.id 
                    GROUP BY posts.id
                    ORDER BY posts.created DESC  
                    LIMIT 5
                    ";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            // Vérification
            if (!$lesInformations) {
                echo "<article>";
                echo ("Échec de la requete : " . $mysqli->error);
                echo ("<p>Indice: Vérifiez la requete  SQL suivante dans phpmyadmin<code>$laQuestionEnSql</code></p>");
                exit();
            }
            include_once('scripts/get_posts.php');
            ?>
        </main>
    </div>
</body>

</html>