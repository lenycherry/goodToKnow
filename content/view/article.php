<?php $title = "GTK " . $currentArticle->getTitle(); ?>
<div id="article_page_container">
    <div id="article_container">
        <h1> <?php echo $currentArticle->getTitle(); ?></h1>
        <div><?php echo $currentArticle->getContent(); ?></div>
        <p class="date">Crée le <?php echo $currentArticle->getCreateDate(); ?></p>
    </div>

    <div id="comments_container_json"></div>

    <div id="comments_container">
        <?php if (isset($_SESSION['id'])) : ?>
            <form id="form_add_comment_container" action="<?php echo HOST; ?>addComment/id/<?php echo $currentArticle->getId() ?>" method="post">
                <label for="area_add_comment_container">Ajouter un commentaire :</label>
                <textarea id="area_add_comment_container" name='values[content]' placeholder="Votre commentaire" maxlength="500" required></textarea>
                <button class='btn' type="submit" value="Valider">Valider</button>
            </form>
        <?php endif; ?>
       <?php if (isset($comments)) : ?>
            <?php foreach ($comments as $comment) : ?>
                <div class="article_comment_container">
                    <h3><?php echo htmlspecialchars($comment['pseudo']) ?></h3>
                    <p><?php echo htmlspecialchars($comment['content']) ?></p>
                    <div class="date_time_comment">
                        <p class="date">Crée le <?php echo $comment['create_date'] ?></p>
                        <?php if (isset($comment['edit_date'])) : ?>
                            <p class="date">Edité le <?php echo $comment['edit_date'] ?></p>
                        <?php endif; ?>
                    </div>
                    <span class='comment_btn_container'>
                        <?php if (isset($_SESSION['id'])) : ?>
                            <?php if ($_SESSION['pseudo'] === $comment['pseudo']) : ?>
                                <a href="<?php echo HOST; ?>editComment/id/<?php echo $comment['id'] ?>" class="edit_com_btn btn">Editer</a>
                                <a href="<?php echo HOST; ?>deleteComment/id/<?php echo $comment['id'] ?>" class="jf_alert erase_com_btn btn">Effacer</a>
                            <?php else : ?>
                                <a href="<?php echo HOST; ?>reportComment/id/<?php echo $comment['id'] ?>" class="jf_alert report_com_btn btn">Signaler</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </span> 
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<div id="report_url" hidden><?php echo HOST; ?>reportComment/id/</div>
<div id="json_url" hidden><?php echo HOST; ?>jsonComment/id/<?php echo $currentArticle->getId() ?></div>
<script src="<?php echo ASSETS; ?>js/Alert.js"></script>
<script src="<?php echo ASSETS; ?>js/CommentDisplay.js"></script>
