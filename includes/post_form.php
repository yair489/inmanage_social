<?php 


if (! empty ($post->errors)) : ?>
    <ul>
        <?php foreach ($post->errors as $error) : ?>
            <li><?= $error ?></li>
        <?php  endforeach; ?> 
    </ul>
<?php endif ; ?>

<form method = "post">

    <div>
        <label for="user_id"> user_id </label>
        <input type="number" name="user_id" id="user_id" placeholder="Enter a number" value="<?= htmlspecialchars($post->user_id); ?>">
    </div>


    <div>
        <label for="title"> Title </label>
        <input name="title" id="title" placeholder="Post title" value="<?= htmlspecialchars($post->title); ?>">
    </div>

    <div>
        <label for="content"> Content </label>
        <textarea name="content" rows="4" cols="40" id="title" placeholder="Post title"><?= htmlspecialchars($post->content); ?></textarea>
    </div>

    <div>
        <label for="create_at"> date and time </label>
        <input type="datetime-local" name="create_at" id="create_at" value="<?= htmlspecialchars($post->published_at); ?>">
    </div>
    <button>Save</button>

</form>