<?php
session_start();
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
        <?php include('scripts/header.php'); ?>

    </header>
    <div id="wrapper">
        <?php
        $userId = intval($_GET['user_id']);
        require('scripts/db_connect.php');
        ?>
        <!-- fiche profil -->
        <aside>
            <?php
            // on récupère le nom                
            $laQuestionEnSql = "SELECT * FROM users WHERE id= '$userId' ";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            $user = $lesInformations->fetch_assoc();
            ?>
            <img src="img/user.jpg" alt="Portrait de l'utilisatrice" />
            <section>
                <h3>Mur</h3>
                <p>Sur cette page, vous trouverez tous les messages de l'utilisatrice (n° <?php echo $userId ?>) <?php echo $user['alias'] ?>.</p>
            </section>
        </aside>

        <!-- liste de posts -->
        <main>
            <?php
            // on vérifie que le user est connecté ET que c'est son wall
            if (isset($_SESSION['connected_id']) && isset($_GET['user_id']) && $_GET['user_id'] == $_SESSION['connected_id']) {
                include('scripts/post.php');
            }
            $laQuestionEnSql = "
                    SELECT  posts.content, 
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
            include('rq_error.php');
            include('scripts/get_posts.php');
            ?>
        </main>
    </div>
</body>

</html>