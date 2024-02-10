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
    <title>ReSoC - Les message par mot-clé</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <header>
        <?php include_once('scripts/header.php'); ?>

    </header>
    <div id="wrapper">
        <?php
        $tagId = intval($_GET['tag_id']);
        ?>

        <aside>
            <?php
            $laQuestionEnSql = "SELECT * FROM tags WHERE id= '$tagId' ";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            $tag = $lesInformations->fetch_assoc();
            // echo "<pre>" . print_r($tag, 1) . "</pre>";
            ?>
            <img src="img/user.jpg" alt="Portrait de l'utilisatrice" />
            <section>
                <h3>Mots-clés</h3>
                <p>Sur cette page, vous trouverez les derniers messages relevant du mot-clé <?php echo strtoupper($tag['label']) ?>
                    (n° <?php echo $tagId ?>).
                </p>
            </section>
        </aside>
        <main>
            <?php
            $laQuestionEnSql = "
                SELECT  posts.content,
                        posts.created,
                        posts.user_id as author_id,  
                        users.alias as author_name,  
                        count(likes.id) as like_number,  
                        GROUP_CONCAT(DISTINCT tags.label) as taglist,
                        GROUP_CONCAT(DISTINCT tags.id) as tag_ids
                FROM    posts_tags as filter 
                        JOIN posts ON posts.id=filter.post_id
                        JOIN users ON users.id=posts.user_id
                        LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                        LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                        LEFT JOIN likes      ON likes.post_id  = posts.id 
                WHERE   filter.tag_id = '$tagId' 
                GROUP BY posts.id
                ORDER BY posts.created DESC  
                ";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            include_once('scripts/rq_error.php');
            include_once('scripts/get_posts.php');
            ?>
        </main>
    </div>
</body>

</html>