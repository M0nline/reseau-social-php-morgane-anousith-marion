<?php
    require('db_connect.php');
?>

<article>
    <h2>Poster un message</h2>
    <?php
    // récupération auteurs
    $listAuteurs = [];
    $laQuestionEnSql = "SELECT * FROM users";
    $lesInformations = $mysqli->query($laQuestionEnSql);
    while ($user = $lesInformations->fetch_assoc()) {
        $listAuteurs[$user['id']] = $user['alias'];
    }
    // TRAITEMENT DU FORMULAIRE
    // on verifie si affichage ou traitement
    // si on recoit un champs auteur rempli il y a une chance que ce soit un traitement
    $enCoursDeTraitement = isset($_POST['auteur']);
    if ($enCoursDeTraitement) {
        // récupérer ce qu'il y a dans le formulaire 
        // ligne de débug 
        echo "<pre>" . print_r($_POST, 1) . "</pre>";
        $authorId = $_POST['auteur'];
        $postContent = $_POST['message'];
        // pour éviter les injection sql : https://www.w3schools.com/sql/sql_injection.asp
        $authorId = intval($mysqli->real_escape_string($authorId));
        $postContent = $mysqli->real_escape_string($postContent);
        // construction de la requete
        $lInstructionSql = "INSERT INTO posts "
            . "(id, user_id, content, created, parent_id) "
            . "VALUES (NULL, "
            . $authorId . ", "
            . "'" . $postContent . "', "
            . "NOW(), "
            . "NULL);";
        echo $lInstructionSql;
        // execution
        $ok = $mysqli->query($lInstructionSql);
        if (!$ok) {
            echo "Impossible d'ajouter le message: " . $mysqli->error;
        } else {
            echo "<p>Message posté en tant que : " . $listAuteurs[$authorId] . "</p>";
        }
    }
    ?>
    <form method="post">
        <dl>
            <dt><label for="auteur">Auteur</label></dt>
            <dd>
                <select id="auteur" name="auteur" required>
                    <!-- à modifier pour sélectionner l'alias de l'id de session -->
                    <?php
                    foreach ($listAuteurs as $id => $alias)
                        echo "<option value='$id'>$alias</option>";
                    ?>
                </select>
            </dd>
            <dt><label for="message">Message</label></dt>
            <dd><textarea id="message" name="message" required></textarea></dd>
        </dl>
        <input type="submit" value="Envoyer">
    </form>
</article>