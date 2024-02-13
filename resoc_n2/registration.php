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
    <title>ReSoC - Inscription</title>
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
                <h2>Inscription</h2>
                <?php
                // Etape 1 : vérifier si on est en train d'afficher ou de traiter le formulaire
                // si on recoit un champs email rempli il y a une chance que ce soit un traitement
                $enCoursDeTraitement = isset($_POST['email']);
                if ($enCoursDeTraitement) {
                    //ligne debug
                    // echo "<pre>" . print_r($_POST, 1) . "</pre>";
                    $new_email = $_POST['email'];
                    $new_alias = $_POST['pseudo'];
                    $new_passwd = $_POST['motpasse'];
                    // pour éviter les injection sql : https://www.w3schools.com/sql/sql_injection.asp
                    $new_email = $mysqli->real_escape_string($new_email);
                    $new_alias = $mysqli->real_escape_string($new_alias);
                    $new_passwd = $mysqli->real_escape_string($new_passwd);
                    // on crypte le mot de passe pour éviter d'exposer notre utilisatrice en cas d'intrusion dans nos systèmes
                    $new_passwd = md5($new_passwd);
                    // NB: md5 est pédagogique mais n'est pas recommandé pour une vraie sécurité
                    // Vérifie si le nom d'utilisateur existe déjà dans la DB 
                    $aliasVerification = "SELECT COUNT(*) AS count FROM users WHERE alias = '$new_alias'";
                    $aliasVerificationResult = $mysqli->query($aliasVerification);
                    if (!$aliasVerificationResult) {
                        echo "Une erreur est survenue lors de la vérification de l'alias:" . $mysqli->error;
                    } else {
                        $row = $aliasVerificationResult->fetch_assoc();
                        if ($row["count"] > 0) {
                            echo "Le nom d'utilisateur '$new_alias' est déjà pris";
                        } else {
                            // Faire la registration : 
                            // construction de la requete
                            $lInstructionSql = "INSERT INTO users (id, email, password, alias) "
                                . "VALUES (NULL, "
                                . "'" . $new_email . "', "
                                . "'" . $new_passwd . "', "
                                . "'" . $new_alias . "'"
                                . ");";
                            // exécution de la requete
                            $ok = $mysqli->query($lInstructionSql);
                            if (!$ok) {
                                echo "L'inscription a échoué : " . $mysqli->error;
                            } else {
                                echo "Votre inscription est un succès : " . $new_alias . " !";
                                // ouvre directement une session après la registration
                                $_SESSION['connected_id'] = $user['id'];
                                // redirige l'utilisateur vers news.php
                                header("Location: http://localhost/reseau-social-php-morgane-anousith-marion/resoc_n2/news.php");
                            }
                            exit;
                        }
                    }
                }
                ?>

                <form action="registration.php" method="post">
                    <input type="hidden" name="action" value="registration">
                    <fieldset>
                        <legend>Informations d'inscription</legend>
                        <dl>
                            <dt><label for="pseudo">Pseudo <span class="required">*</span></label></dt>
                            <dd><input type="text" id="pseudo" name="pseudo" required></dd>
                            <dt><label for="email">E-Mail <span class="required">*</span></label></dt>
                            <dd><input type="email" id="email" name="email" required></dd>
                            <dt><label for="motpasse">Mot de passe <span class="required">*</span></label></dt>
                            <dd><input type="password" id="motpasse" name="motpasse" required></dd>
                        </dl>
                    </fieldset>
                    <input type="submit" value="S'inscrire">
                </form>
                <p>
                    Déjà inscrit-e ?
                    <a href='login.php'>Connectez-vous.</a>
                </p>
            </article>
        </main>
    </div>
</body>

</html>