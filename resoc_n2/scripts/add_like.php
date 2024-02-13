<?php
require('db_connect.php');

// Vérifie que le fom 'likeButton" a bien été soumit 
if (isset($_POST['likeButton'])) {
    $postId = $_POST['post_id'];
    $userId = $_POST['user_id'];
    
    // Insert ces deux variables dans la DB table likes 
    $query = "INSERT INTO likes (post_id, user_id) VALUES ($postId, $userId)";
    
    // Execute la requête
    $result = $mysqli->query($query);
    if ($result) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $mysqli->error;
    }
    header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>
