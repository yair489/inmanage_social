<?php

require 'classes/Database.php';
require 'classes/Post.php';

$db = new Database();
$conn = $db->getConn();

if (isset($_GET['id'])) {
    $post = Post::getByID($conn, $_GET['id']);

    if ( ! $post){
        die("not found post"); 
    }
} else {
    die("not found post");
}


if( $_SERVER["REQUEST_METHOD"] == "POST" ) {



    if($post -> delete($conn)) {

        header("Location: http://" . $_SERVER['HTTP_HOST'] . $path. "/inmanage_social/index.php");
        exit;
    }
}

?>

<?php require 'includes/header.php'; ?>

<h2> Delete  Post </h2>
    <form method ="post">
        <p> Are you sure you want to delete the post? </p>
        <button> Delete </button>
        <a href="post.php?id=<?=$post->post_id; ?>">Cancel </a>
    </form>

<?php require 'includes/footer.php'; ?>
