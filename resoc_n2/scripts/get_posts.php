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
            <small>♥ <?php echo $post['like_number']; ?> </small>
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