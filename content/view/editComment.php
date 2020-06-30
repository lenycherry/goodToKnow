<?php $title = 'GTK - Editer le commentaire' ?>
<?php if (isset($_SESSION['id'])) : ?>
    <div id='edit_page_container'>
        <label for="form_comment_container">Editer votre commentaire</label>
        <form id="form_comment_container" action="<?php echo HOST; ?>updateComment/id/" method="post">
            <textarea id="area_comment_container" name='values[content]' maxlength="500" required>
    <?php echo $currentComment->getContent(); ?>
    </textarea>
            <input type='hidden' name="values[id]" value="<?php echo $currentComment->getId(); ?>" />
            <button class="btn" type="submit" value="Valider">Editer</button>
        </form>
    </div>
<?php else : ?>
    <?php $location = HOST; ?>
    <?php header("Location: $location"); ?>
<?php endif; ?>