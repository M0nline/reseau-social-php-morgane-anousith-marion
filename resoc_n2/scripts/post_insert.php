<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('db_connect.php');

// Assuming $authorId and $postContent are already defined

// Begin the transaction
$mysqli->begin_transaction();

try {
    // Insert the post
    $stmt = $mysqli->prepare("INSERT INTO posts (user_id, content, created, parent_id) VALUES (?, ?, NOW(), NULL)");
    $stmt->bind_param("is", $authorId, $postContent);
    $stmt->execute();
    $postId = $stmt->insert_id;

    // Extraction des tags du contenu du post
    preg_match_all('/#(\w+)/', $postContent, $matches);
    $tags = $matches[1];

    foreach ($tags as $tag) {
        // Check if the tag already exists
        $stmt = $mysqli->prepare("SELECT id FROM tags WHERE label = ?");
        $stmt->bind_param("s", $tag);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $tagId = $row['id'];
        } else {
            // If the tag doesn't exist, insert it
            $stmt = $mysqli->prepare("INSERT INTO tags (label) VALUES (?)");
            $stmt->bind_param("s", $tag);
            $stmt->execute();
            $tagId = $stmt->insert_id;
        }

        // Insert into the post_tags table
        $stmt = $mysqli->prepare("INSERT INTO posts_tags (post_id, tag_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $postId, $tagId);
        $stmt->execute();
    }

    // Commit the transaction
    $mysqli->commit();
} catch (Exception $e) {
    // Rollback the transaction in case of an error
    $mysqli->rollback();
    echo "Erreur lors de l'association des tags : " . $e->getMessage();
}
?>

