<?php
// Démarrer la session
session_start();
require_once('db_connect.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si l'utilisateur est connecté
    if (isset($_SESSION['connected_id'])) {
        // Vérifier si toutes les données requises ont été envoyées depuis le formulaire
        if (isset($_POST['user_id_to_unfollow'])) {
            // Récupérer l'identifiant de l'utilisateur à ne plus suivre depuis les données du formulaire
            $user_id_to_unfollow = $_POST['user_id_to_unfollow'];

            // Préparer la requête SQL pour supprimer l'abonnement
            $query = "DELETE FROM followers WHERE following_user_id = ? AND followed_user_id = ?";

            // Préparer la déclaration SQL
            $statement = $mysqli->prepare($query);

            // Lier les paramètres à la déclaration SQL
            $statement->bind_param("ii", $_SESSION['connected_id'], $user_id_to_unfollow);

            // Exécuter la déclaration SQL
            if ($statement->execute()) {
                echo "Désabonnement effectué avec succès !";
            } else {
                echo "Erreur lors du désabonnement : " . $mysqli->error;
            }

            // Fermer la déclaration et la connexion à la base de données
            $statement->close();
            $mysqli->close();
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            echo "Erreur : Toutes les données requises n'ont pas été envoyées.";
        }
    } else {
        echo "Erreur : Vous devez être connecté-e pour vous désabonner.";
    }
} else {
    echo "Erreur : La demande n'a pas été soumise.";
}
?>