<?php
require 'classes/Database.php';
require 'classes/Users.php';
require 'classes/Post.php';


$db = new Database();
$conn = $db->getConn();

$users = Users::getAll($conn);

?>
<!DOCTYPE html>
<html>
<head>
    <title>My blog</title>
    <meta charset="utf-8">
</head>
<body>

    <header>
        <h1>My blog</h1>
    </header>

    <main>

<?php if (true)://(isLoggedIn()) : ?>
    
    <p>You are logged in. <a href="logout.php">Log out</a></p>
    <p><a href="new_post.php">New post</a></p>

<?php else : ?>
    
    <p>You are not logged in. <a href="login.php">Log in</a></p>

<?php endif; ?>

<?php if (empty($users)) : ?>
    <p>No users found.</p>
<?php else : ?>

    <ul>
        <?php foreach ($users as $user) : ?>
            <fieldset>
            <ul>
            
                <article>
                    <div style="display: inline-block; vertical-align: middle;">
                        <figure style="display: inline;">
                            <img src="image/icon.jpg" width="50" height="50" alt="User Icon">
                        </figure>
                    </div>
                    <div style="display: inline-block; vertical-align: middle;">
                        <h2><a href="article.php?id=<?= htmlspecialchars($user['user_id']); ?>"><?= htmlspecialchars($user['user_name']); ?></a></h2>
                        <p><?= htmlspecialchars($user['user_id']); ?></p>
                    </div>
                    <!--foe each user show the post -->
                    <?php $posts = Post::getByUserID($conn ,$user['user_id'] );// var_dump($posts);?>
                    <?php foreach ($posts as $post) : ?>
                        <li>
                            <article>
                                <h4><a href="post.php?id=<?= $post->post_id; ?>"><?= htmlspecialchars($post->title); ?></a></h4>
                                <p><?= htmlspecialchars($post->content); ?></p>
                            </article>
                        </li>
                    <?php endforeach; ?>
                    
                    <!-- -->
                </article>
                </ul>
            </fieldset>
            <br>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>

</main>
</body>
</html>

