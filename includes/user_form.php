<?php 


//if (! empty ($post->errors)) : ?>
 <!--   <ul>
        <?php //foreach ($post->errors as $error) : ?>
            <li><?= $error ?></li>
        <?php // endforeach; ?> 
    </ul> -->
<?php// endif ; ?>

<form method = "post">

    <div>
        <label for="user_name"> user_name </label>
        <input name="user_name" id="user_name" placeholder="user_name" value="<?= htmlspecialchars($user->user_name); ?>">
    </div>

    <div>
        <label for="content"> Content </label>
        <textarea name="content" rows="4" cols="40" id="content" placeholder="content"><?= htmlspecialchars($user->content); ?></textarea>
    </div>

    <div>
        <label for="email"> email </label>
        <input name="email" id="email" placeholder="email" value="<?= htmlspecialchars($user->email); ?>">
    </div>

    <div>
        <label for="birthday"> date and time </label>
        <input type="datetime-local" name="birthday" id="birthday" value="<?= htmlspecialchars($user->birthday); ?>">
    </div>

    <!-- <div>
    <label for="active"> Active </label>
    <input type="checkbox" name="active" id="active" value="1" <?= $user->active ? 'checked' : ''; ?>>
    </div> -->
    <div>
        <label for="active"> active </label>
        <input type="number" name="active" id="active" placeholder="Enter a number 0 or 1" value="<?= htmlspecialchars($user->active); ?>">
    </div>

    <button>Save</button>

</form>