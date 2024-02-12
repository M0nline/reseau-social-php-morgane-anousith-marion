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
    <title>ReSoC - Connexion</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <header>
        <?php include_once('scripts/header.php'); ?>
    </header>

    <div id="wrapper">

        <aside>
            <h2>Présentation</h2>
            <p>Bienvenue sur notre réseau social.</p>
        </aside>
        <main>
            <article>
                <h2>Connexion</h2>
                <?php

                // on vérifie si on est en train d'afficher ou de traiter le formulaire
                // si on recoit un champs email rempli il y a une chance que ce soit un traitement
                $enCoursDeTraitement = isset($_POST['email']);
                if ($enCoursDeTraitement) {
                    //ligne de débug 
                    echo "<pre>" . print_r($_POST, 1) . "</pre>";
                    $emailAVerifier = $_POST['email'];
                    $passwdAVerifier = $_POST['motpasse'];
                    // pour éviter les injection sql : https://www.w3schools.com/sql/sql_injection.asp
                    $emailAVerifier = $mysqli->real_escape_string($emailAVerifier);
                    $passwdAVerifier = $mysqli->real_escape_string($passwdAVerifier);
                    // on crypte le mot de passe pour éviter d'exposer notre utilisatrice en cas d'intrusion dans nos systèmes
                    $passwdAVerifier = md5($passwdAVerifier);
                    // NB: md5 est pédagogique mais n'est pas recommandé pour une vraie sécurité
                    // construction de la requete
                    $lInstructionSql = "SELECT * "
                        . "FROM users "
                        . "WHERE "
                        . "email LIKE '" . $emailAVerifier . "'";
                    // Vérification de l'utilisateur
                    $res = $mysqli->query($lInstructionSql);
                    $user = $res->fetch_assoc();
                    if (!$user) {
                        echo "La connexion a échoué, il n'y a pas de compte avec l'identifiant " . $emailAVerifier . ".";
                    } else if ($user["password"] != $passwdAVerifier) {
                        echo "La connexion a échoué, le mot de passe n'est pas reconnu.";
                    } else {
                        echo "Votre connexion est un succès : " . $user['alias'] . ".";
                ?>
                        <p><a href='registration.php'>Inscrivez-vous.</a></p>
                <?php
                        // Se souvenir que l'utilisateur s'est connecté pour la suite
                        // documentation: https://www.php.net/manual/fr/session.examples.basic.php
                        $_SESSION['connected_id'] = $user['id'];
                        header("Location: wall.php?user_id=" . $_SESSION['connected_id']);
                    }
                    exit;
                }
                ?>
                <!--   Si utilisateur/trice est non identifié(e), on affiche le formulaire -->
                <?php if (!isset($_SESSION['connected_id'])) : ?>
                    <form action="login.php" method="post">
                        <dl>
                            <dt><label for='email'>Email</label></dt>
                            <dd><input type='email' name='email'></dd>
                            <dt><label for='motpasse'>Mot de passe</label></dt>
                            <dd><input type='password' name='motpasse'></dd>
                        </dl>
                        <button type='submit'>Envoyer</button>
                    </form>
                    <p>
                        Vous n'avez pas de compte ?
                        <a href='registration.php'>Inscrivez-vous.</a>
                    </p>
                    <!-- Si utilisatrice bien connectée on affiche un message de succès -->
                <?php else : ?>
                    <div class="alert alert-success" role="alert">
                        Bonjour identifiant <?php echo $_SESSION['connected_id']; ?> et bienvenue sur le site !
                    </div>
                <?php endif; ?>

            </article>
        </main>
    </div>
</body>

</html>