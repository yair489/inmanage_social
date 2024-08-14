<?php

require 'classes/Database.php';
require 'classes/Post.php';
require 'classes/Users.php';

$db = new Database();
$conn = $db->getConn();

if (isset($_GET['id'])) {
    $user  = Users::getByID($conn, $_GET['id']);

    if ( ! $user){
        die("not found user"); 
    }
} else {
    die("not found user");
}


if( $_SERVER["REQUEST_METHOD"] == "POST" ) {



    if($user -> delete($conn)) {

        header("Location: http://" . $_SERVER['HTTP_HOST'] . $path. "/inmanage_social/index.php");
        exit;
    }
}

?>

<?php require 'includes/header.php'; ?>

<h2> Delete  user </h2>
    <form method ="post">
        <p> Are you sure you want to delete the the user and all his posts? </p>
        <button> Delete </button>
        <a href="user.php?id=<?=$user->user_id; ?>">Cancel </a>
    </form>

<?php require 'includes/footer.php'; ?>
