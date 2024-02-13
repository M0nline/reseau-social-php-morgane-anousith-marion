<?php
// Démarrer la session
session_start();
require_once('db_connect.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si l'utilisateur est connecté
    if (isset($_SESSION['connected_id'])) {
        // Vérifier si toutes les données requises ont été envoyées depuis le formulaire
        if (isset($_POST['user_id_to_follow'])) {
            // Récupérer l'identifiant de l'utilisateur à suivre depuis les données du formulaire
            $user_id_to_follow = $_POST['user_id_to_follow'];

            // Préparer la requête SQL pour insérer l'abonnement
            $query = "INSERT INTO followers (following_user_id, followed_user_id) VALUES (?, ?)";

            // Préparer la déclaration SQL
            $statement = $mysqli->prepare($query);

            // Lier les paramètres à la déclaration SQL
            $statement->bind_param("ii", $_SESSION['connected_id'], $user_id_to_follow);

            // Exécuter la déclaration SQL
            if ($statement->execute()) {
                echo "Abonnement enregistré avec succès !";
            } else {
                echo "Erreur lors de l'enregistrement de l'abonnement : " . $mysqli->error;
            }

            // Fermer la déclaration et la connexion à la base de données
            $statement->close();
            $mysqli->close();
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            echo "Erreur : Toutes les données requises n'ont pas été envoyées.";
        }
    } else {
        echo "Erreur : Vous devez être connecté-e pour vous abonner.";
    }
} else {
    echo "Erreur : La demande n'a pas été soumise.";
}
