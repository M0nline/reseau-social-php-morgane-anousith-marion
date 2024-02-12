<?php
                // $test = $_SESSION['connected_id'];
                // echo "<pre>" . print_r($test, 1) . "</pre>";

                // on vérifie que le user est connecté ET que c'est son wall
                // POUR créer un formulaire de message associé à cet utilisateur. 
                if (isset($_SESSION['connected_id']) && $_GET['user_id'] == $_SESSION['connected_id']) 
                {
            ?>
                <article>
                <h2>Poster un message</h2>
            <?php
                // TRAITEMENT DU FORMULAIRE
                // on verifie si affichage ou traitement
                // si on recoit un champs auteur rempli il y a une chance que ce soit un traitement
                $enCoursDeTraitement = isset($_POST['message']);
                if ($enCoursDeTraitement) {
                    // ligne de débug 
                    // echo "<pre>" . print_r($_POST, 1) . "</pre>";
                    // associer l'auteur au currend uer id dans l'url. 
                    $authorId = $_GET['user_id'];
                    // récupérer ce qu'il y a dans le formulaire 
                    $postContent = $_POST['message'];
                    // pour éviter les injection sql : https://www.w3schools.com/sql/sql_injection.asp
                    $authorId = intval($mysqli->real_escape_string($authorId));
                    $postContent = $mysqli->real_escape_string($postContent);
                    // construction de la requête
                    $lInstructionSql = "INSERT INTO posts "
                        . "(id, user_id, content, created, parent_id) "
                        . "VALUES (NULL, "
                        . $authorId . ", "
                        . "'" . $postContent . "', "
                        . "NOW(), "
                        . "NULL);";
                    // echo $lInstructionSql;
                    // execution
                    $ok = $mysqli->query($lInstructionSql);
                    if (!$ok) {
                        echo "Impossible d'ajouter le message: " . $mysqli->error;
                    } else {
                        echo "<p>Message posté !</p>";
                    }
                }
            ?>
    <form method="post">
        <dl>
            <dd>
            <dt><label for="message">Message</label></dt>
            <dd><textarea id="message" name="message" required></textarea></dd>
        </dl>
        <input type="submit" value="Envoyer">
    </form>
</article>
        <?php
        // fin du if pour le message post
         }
         ?>