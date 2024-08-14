<?php

require 'classes/Database.php';
require 'classes/Post.php';

$db = new Database();
$conn = $db->getConn();

$postid =  Post::getByBirthday($conn);
$post = Post::getByID($conn, $postid);
?>

<?php require 'includes/header.php'; ?>
<?php if ($post) :?>

    <article>
        <h2><?= htmlspecialchars($post->title); ?></h2>
        <p><?= htmlspecialchars($post->content); ?></p>
    </article>


    <a href="index.php">Home</a>

<?php else : ?>
    <p> not found post </p>
<?php endif; ?>


<?php require 'includes/footer.php'; ?>


