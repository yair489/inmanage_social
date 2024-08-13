<?php

require 'classes/Database.php';
require 'classes/Post.php';

$db = new Database();
$conn = $db->getConn();

if (isset($_GET['id'])) {
    $post = Post::getByID($conn, $_GET['id']);
} else {
    $post = null;
}
?>

<?php require 'includes/header.php'; ?>
<?php var_dump($post);?>
<?php if ($post) :?>

    <article>
        <h2><?= htmlspecialchars($post->title); ?></h2>
        <p><?= htmlspecialchars($post->content); ?></p>
    </article>

    <a href="edit_article.php?id=<?= $post->post_id; ?>">Edit</a>
    <a href="delete_article.php?id=<?= $post->post_id; ?>">Delete</a>

<?php else : ?>
    <p> not found post </p>
<?php endif; ?>


<?php require 'includes/footer.php'; ?>


