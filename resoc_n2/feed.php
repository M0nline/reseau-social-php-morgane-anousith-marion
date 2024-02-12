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
    <title>ReSoC - Flux</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <header>
        <?php include_once('scripts/header.php'); ?>
    </header>
    <div id="wrapper">
        <?php
        // $userId = intval($_GET['user_id']);
        $userId = $_SESSION['connected_id']
         ?>

        <aside>
            <?php
            $laQuestionEnSql = "SELECT * FROM `users` WHERE id= '$userId' ";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            $user = $lesInformations->fetch_assoc();
            // ligne de debug :
            // echo "<pre>" . print_r($user, 1) . "</pre>";
            ?>
            <img src="img/user.jpg" alt="Portrait de l'utilisatrice" />
            <section>
                <h3>Flux</h3>
                <p>Sur cette page, vous trouverez tous les messages des utilisatrices
                    auxquelles est abonnée l'utilisatrice <?php echo $user['alias'] ?>
                    (n° <?php echo $userId ?>).
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
                FROM    followers 
                        JOIN users ON users.id=followers.followed_user_id
                        JOIN posts ON posts.user_id=users.id
                        LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                        LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                        LEFT JOIN likes      ON likes.post_id  = posts.id 
                WHERE followers.following_user_id='$userId' 
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