<?php
while ($user = $lesInformations->fetch_assoc()) {
?>
    <article>
        <img src="img/user.jpg" alt="avatar" />
        <h3><a href="wall.php?user_id=<?php echo $user['id']; ?>"><?php echo $user['alias']; ?></a></h3>
        <p>id:<?php echo $user['id']; ?></p>
    </article>
<?php
}
?>