<?php

while ($post = $lesInformations->fetch_assoc()) {
    // test réponse
    // echo "<pre>" . print_r($post, 1) . "</pre>";
?>

    <article>
        <h3>
            <?php include_once('scripts/timestamp.php') ?>
        </h3>

        <address>par <a href="wall.php?user_id=<?php echo $post['author_id']; ?>"><?php echo $post['author_name'] ?></a></address>
        <div>
            <p><?php echo $post['content']; ?></p>
        </div>
        <footer>
        <form id="likeForm" action="scripts/add_like.php" method="POST">
            <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION["connected_id"]; ?>">
            <small><button type="submit" name="likeButton">♥ <?php echo $post['like_number']; ?></button></small>
        </form>
            <!-- gestion des tags  -->
            <?php
            // Séparation des tags en utilisant la virgule comme délimiteur
            if (!empty($post['taglist'])) {
            $tags = explode(',', $post['taglist']);
                // Initialisation de la variable pour stocker les tags avec virgules
                $tagString = '';
                // Parcours de chaque tag et ajout à la chaîne de tags avec une virgule
                foreach ($tags as $tag) {
                        // only proceed if tag is not empty
                        if ($tagString !== '') {
                            $tagString .= ', ';
                        }
                        $tagString .= '<a href="tags.php?tag_id=' . urlencode(trim($post['tag_ids'])) . '">#' . trim($tag) . '</a>';
                    // Ajout du tag avec une virgule (sauf pour le premier tag)
                    // Affichage de la chaîne de tags complète
                    echo $tagString;
                }
            }
            ?>
        </footer>
    </article>

<?php
} 
?>