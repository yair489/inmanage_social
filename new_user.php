<?php


require 'classes/Database.php';
require 'classes/Users.php';


$user = new Users();


if( $_SERVER["REQUEST_METHOD"] == "POST" ) {

    $db = new Database();
    $conn = $db->getConn();

    $user->user_name = $_POST['user_name'];
    $user->content = $_POST['content'];
    $user->email = $_POST['email'];
    $user->Active = isset($_POST['active']) ? 1 : 0;
    $user->birthday = $_POST['birthday'];

    if($user -> create($conn)) {

        header("Location: http://" . $_SERVER['HTTP_HOST'] . $path. "/inmanage_social/index.php");
        exit;
    }
}

?>
<?php require 'includes/header.php'; ?>

<h2>New article</h2>

<?php require 'includes/user_form.php'; ?>

<?php require 'includes/footer.php'; ?>







