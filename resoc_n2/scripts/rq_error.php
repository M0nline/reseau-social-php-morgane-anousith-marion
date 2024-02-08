<?php if (!$lesInformations) {
    echo ("Échec de la requete : " . $mysqli->error);
    echo ("<p>Indice: Vérifiez la requete  SQL suivante dans phpmyadmin<code>$laQuestionEnSql</code></p>");
    exit();
}