<?php

require 'classes/Database.php';
require 'classes/Users.php';

$db = new Database();
$conn = $db->getConn();

if (isset($_GET['id'])) {
    $user = Users::getByID($conn, $_GET['id']);
} else {
    $user = null;
}
?>

<?php require 'includes/header.php'; ?>
<?php var_dump($user);?>
<?php if ($user) :?>
    <h2><?= htmlspecialchars($user->user_name); ?></h2>
    <article>
        <div style="display: inline-block; vertical-align: middle;">
            <figure style="display: inline;">
                <img src="image/icon.jpg" width="50" height="50" alt="User Icon">
            </figure>
        </div>
                    
        <div>
            <h3> about </h3>
            <p><?= htmlspecialchars($user->content); ?></p>
            <p><?= htmlspecialchars($user->user_id); ?></p>
        </div>

        <div>
            <h3> birthday </h3>
            <p><?= htmlspecialchars($user->birthday); ?></p>
        </div>

        <div>
            <h3> email </h3>
            <p><?= htmlspecialchars($user->email); ?></p>
        </div>

    </article>

    <a href="edit_user.php?id=<?= $user->user_id; ?>">Edit</a>
    <a href="delete_user.php?id=<?= $user->user_id; ?>">Delete</a>
    <a href="index.php">Home</a>

<?php else : ?>
    <p> not found user </p>
<?php endif; ?>


<?php require 'includes/footer.php'; ?>

