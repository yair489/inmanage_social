<?php

require 'classes/Database.php';
require 'classes/Users.php';

$db = new Database();
$conn = $db->getConn();

if (isset($_GET['id'])) {
    $user = Users::getByID($conn, $_GET['id']);
} else {
    die("not found post");
}
if( $_SERVER["REQUEST_METHOD"] == "POST" ) {



    $user->user_name = $_POST['user_name'];
    $user->content = $_POST['content'];
    $user->email = $_POST['email'];
    $user->Active = ($_POST['active']);
    $user->birthday = $_POST['birthday'];

    if($user -> create($conn)) {

        header("Location: http://" . $_SERVER['HTTP_HOST'] . $path. "/inmanage_social/index.php");
        exit;
    }
}


?>

<?php require 'includes/header.php'; ?>

<h2> Edit Post </h2>
<?php require 'includes/user_form.php'; ?>

<?php require 'includes/footer.php'; ?>

