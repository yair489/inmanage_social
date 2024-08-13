<?php

require 'classes/Database.php';
require 'classes/Post.php';

$db = new Database();
$conn = $db->getConn();

if (isset($_GET['id'])) {
    $post = Post::getByID($conn, $_GET['id']);
} else {
    die("not found post");
}


if( $_SERVER["REQUEST_METHOD"] == "POST" ) {

    $post->title = $_POST['title'];
    $post->content = $_POST['content'];
    $post->create_at = $_POST['create_at'];

    if($post -> update($conn)) {

        header("Location: http://" . $_SERVER['HTTP_HOST'] . $path. "/inmanage_social/post.php?id={$post->post_id}");
        exit;
    }
}

?>

<?php require 'includes/header.php'; ?>

<h2> Edit Post </h2>
<?php require 'includes/post_form.php'; ?>

<?php require 'includes/footer.php'; ?>

