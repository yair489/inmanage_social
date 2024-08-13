<?php


require 'classes/Database.php';
require 'classes/Post.php';
// require 'includes/post_form.php';


$post = new Post();


if( $_SERVER["REQUEST_METHOD"] == "POST" ) {

    $db = new Database();
    $conn = $db->getConn();

    $post->user_id = $_POST['user_id'];
    $post->title = $_POST['title'];
    $post->content = $_POST['content'];
    $post->create_at = $_POST['create_at'];

    if($post -> create($conn)) {

        header("Location: http://" . $_SERVER['HTTP_HOST'] . $path. "/inmanage_social/post.php?id={$post->post_id}");
        exit;
    }
}

?>
<?php require 'includes/header.php'; ?>

<h2>New article</h2>

<?php require 'includes/post_form.php'; ?>

<?php require 'includes/footer.php'; ?>







