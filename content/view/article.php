<?php $title = "GTK " . $currentArticle->getTitle(); ?>
<div id="article_page_container">
    <div id="article_container">
        <h1> <?php echo $currentArticle->getTitle(); ?></h1>
        <div><?php echo $currentArticle->getContent(); ?></div>
        <p class="date">Crée le <?php echo $currentArticle->getCreateDate(); ?></p>
    </div>
    <div id="comments_container">
        <?php if (isset($_SESSION['id'])) : ?>
            <form id="form_add_comment_container" action="<?php echo HOST; ?>addComment/id/<?php echo $currentArticle->getId() ?>" method="post">
                <label for="area_add_comment_container">Ajouter un commentaire :</label>
                <textarea id="area_add_comment_container" name='values[content]' placeholder="Votre commentaire" maxlength="500" required></textarea>
                <button class='btn' type="submit" value="Valider">Valider</button>
            </form>
        <?php endif; ?>
    </div>
    <div id="comments_container_json"></div>
</div>

<div id="url_host" hidden><?php echo HOST; ?></div>
<div id="json_url" hidden><?php echo HOST; ?>jsonComment/id/<?php echo $currentArticle->getId() ?></div>
<div id="json_pseudo" hidden><?php if (isset($_SESSION['id'])) {
                                    echo $_SESSION["pseudo"];
                                }; ?></div>
<script src="<?php echo ASSETS; ?>js/Alert.js"></script>
<script src="<?php echo ASSETS; ?>js/CommentDisplay.js"></script>