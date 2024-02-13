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
    <title>ReSoC - Mur</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <header>
        <?php include_once('scripts/header.php'); ?>
    </header>
    <div id="wrapper">
        <?php
        $userId = intval($_GET['user_id']);
        ?>
        <!-- fiche profil -->
        <aside>
            <?php
            // on récupère les informations sur la propriétaire du mur          
            $laQuestionEnSql = "SELECT * FROM users WHERE id= '$userId' ";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            $user = $lesInformations->fetch_assoc();
            ?>
            <img src="img/user.jpg" alt="Portrait de l'utilisatrice" />
            <section>
                <h3>Mur</h3>
                <p>Sur cette page, vous trouverez tous les messages de l'utilisatrice (n° <?php echo $userId ?>) <?php echo $user['alias'] ?>.</p>
                <?php
                // Vérifier si l'utilisateur est connecté
                if (isset($_SESSION['connected_id'])) {
                    // Vérifier si l'utilisateur consulte son propre mur
                    $isOwnWall = ($_GET['user_id'] == $_SESSION['connected_id']);
                    if (!$isOwnWall) {
                        // récupérer l'id du user connecté
                        $connected_user_id = $_SESSION['connected_id'];
                        //vérifier s'il est dans la db followers
                        $query_check_follow = "SELECT * FROM followers WHERE following_user_id = '$connected_user_id' AND followed_user_id = '$userId'";
                        $result_check_follow = $mysqli->query($query_check_follow);
                        // Si ce n'est pas son propre mur, afficher le bouton d'abonnement
                        if ($result_check_follow->num_rows == 0) {

                ?>
                            <form action='scripts/follow.php' method="post">
                                <!-- on récupère les données nécessaires pour le script d'abonnement -->
                                <input type="hidden" name="user_id_to_follow" value="<?php echo $userId; ?>">
                                <button type="submit" class="btn-submit">Je m'abonne aux publications de <?php echo $user['alias'] ?></button>
                            </form>
                        <?php
                        } else {
                        ?>
                            <!-- //afficher le bouton de désabonnement -->
                            <form action='scripts/unfollow.php' method="post">
                                <input type="hidden" name="user_id_to_unfollow" value="<?php echo $userId; ?>">
                                <button type="submit" class="btn-submit">Je me désabonne des publications de <?php echo $user['alias'] ?></button>
                            </form>
                <?php }
                    } else {
                        // Sinon, afficher le bouton de post de message
                        include_once('scripts/post.php');
                    }
                }
                ?>
            </section>
        </aside>
        <!-- liste de posts -->
        <main>
            <?php

            $laQuestionEnSql = "
                    SELECT  posts.content,
                            posts.id as post_id, 
                            posts.created, 
                            posts.user_id as author_id,  
                            users.alias as author_name, 
                            COUNT(likes.id) as like_number, 
                            GROUP_CONCAT(DISTINCT tags.label) as taglist,
                            GROUP_CONCAT(DISTINCT tags.id) as tag_ids
                    FROM posts
                            JOIN users ON  users.id=posts.user_id
                            LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                            LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                            LEFT JOIN likes      ON likes.post_id  = posts.id 
                    WHERE posts.user_id='$userId' 
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