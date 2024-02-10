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
    <title>ReSoC - Post d'usurpateur</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <header>
        <?php include('scripts/header.php'); ?>
    </header>

    <div id="wrapper">

        <aside>
            <h2>Shadow post</h2>
            <p>Sur cette page on peut poster un message en se faisant
                passer pour quelqu'un d'autre</p>
        </aside>
        <main>
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
                    // et complétez le code ci dessous en remplaçant les ???
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
                <form action="usurpedpost.php" method="post">
                    <dl>
                        <dt><label for="auteur">Auteur</label></dt>
                        <dd>
                            <select id="auteur" name="auteur" required>
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
        </main>
    </div>
</body>

</html>