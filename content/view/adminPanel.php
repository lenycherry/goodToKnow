<?php $title = 'GTK - Panneau d\'administration' ?>
<?php if (isset($_SESSION['admin']) && ($_SESSION['admin'] == 1)) : ?>
    <div id="admin_main_container">
        <h1 id="home_admin_title"> Bienvenue sur l'espace d'administration <?php echo htmlspecialchars($_SESSION['pseudo']); ?></h1>
        <div id="menu_admin">
            <div id="admin_articles_btn" class="btn">Gérer les Articles</div>
            <div id="admin_comments_btn" class="btn">Gérer les commentaires</div>
            <div id="admin_reported_btn" class="btn">Gérer les commentaires signalés</div>
        </div>

        <div id='admin_article' class="menu_visible">
            <a href="createArticle" class="create_article_btn btn">Créer un nouvel article</a>
            <div id="list_articles_container" class="list_content_admin">
                <?php foreach ($articles as $article) : ?>
                    <article class="article_content_container invisible">
                        <h3><?php echo htmlspecialchars($article['title']); ?></h3>
                        <img alt="<?php echo $article['title']; ?>" class="img_resume_article " src="<?php echo $article['imageUrl']; ?>" />
                        <div class="resume">
                            <p><?php echo $article['content']; ?></p>
                        </div>
                        <p>...</p>
                        <div class="date_time">
                            <p class="date">Créé le <?php echo $article['create_date']; ?></p>
                            <?php if (isset($article['edit_date'])) : ?>
                                <p class="date">Edité le <?php echo $article['edit_date']; ?></p>
                            <?php endif; ?>
                        </div>
                        <span class="bloc_btn"><a href="<?php echo HOST; ?>editArticle/id/<?php echo $article['id']; ?>" class="edit_com_btn btn">Editer</a>
                            <a href="<?php echo HOST; ?>deleteArticle/id/<?php echo $article['id']; ?>" class="jf_alert erase_com_btn btn">Effacer</a>
                        </span>
                    </article>
                <?php endforeach; ?>
            </div>
            <div class="pagination_buttons">
                <button class="first_page_btn btn">|<</button> <button class="previous_page_btn btn">
                        <</button> <span id="pageInfo"></span>
                            <button class="next_page_btn btn">></button>
                            <button class="last_page_btn btn">>|</button>
            </div>
        </div>

        <div id="admin_comment" class="menu_invisible">
            <?php $totalComments = 0; ?>
            <?php foreach ($comments as $comment) : ?>
                <?php $totalComments++ ?>
            <?php endforeach; ?>
            <?php if ($totalComments <= 1) : ?>
                <h2><?php echo $totalComments; ?> commentaire</h2>
            <?php else : ?>
                <h2><?php echo $totalComments; ?> commentaires</h2>
            <?php endif; ?>
            <div id="admin_comment_container">
                <?php foreach ($articles as $article) : ?>
                    <?php if (isset($comments)) : ?>
                        <div class="comment_list_container">
                            <div class="total_comment">
                                <?php $commentsArticle = 0; ?>
                                <?php foreach ($comments as $comment) : ?>
                                    <?php if ($comment['article_id'] === $article['id']) : ?>
                                        <?php $commentsArticle++; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <div class="title_article_comment">
                                    <div class="btn"><?php echo $article['title']; ?></div>
                                    <?php if ($commentsArticle <= 1) : ?>
                                        <p>(<?php echo $commentsArticle; ?> commentaire)</p>
                                    <?php else : ?>
                                        <p>(<?php echo $commentsArticle; ?> commentaires)</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class=" admin_comments_content com_invisible">
                                <?php foreach ($comments as $comment) : ?>
                                    <?php if ($comment['article_id'] === $article['id']) : ?>
                                        <div class="admin_content_container">
                                            <h3><?php echo htmlspecialchars($comment['pseudo']); ?></h3>
                                            <p><?php echo htmlspecialchars($comment['content']); ?></p>
                                            <div class="date_time">
                                                <p class="date">Crée le <?php echo $comment['create_date']; ?></p>
                                                <?php if (isset($comment['edit_date'])) : ?>
                                                    <p class="date">Edité le <?php echo $comment['edit_date']; ?></p>
                                                <?php endif; ?>
                                            </div>
                                            <span>
                                                <a href="<?php echo HOST; ?>deleteComment/id/<?php echo $comment['id']; ?>/admin/1" class="jf_alert erase_com_btn btn">Effacer</a>
                                            </span>
                                        </div>
                                    <?php endif; ?>

                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
            </div>
        </div>
        
        <div id="admin_comment_reported" class="menu_invisible">
            <h2>Commentaires signalés</h2>
            <?php if (isset($comments)) : ?>
                <div id="report_comments_container" class="list_content_admin">
                    <?php foreach ($comments as $comment) : ?>
                        <?php if ($comment['reported'] > 0) : ?>
                            <div class="admin_content_container">
                                <h3><?php echo htmlspecialchars($comment['pseudo']); ?></h3>
                                <p class="message_report_content">Ce commentaire a été signalé</p>
                                <p><?php echo htmlspecialchars($comment['content']); ?></p>
                                <div class="date_time">
                                    <p class="date">Crée le <?php echo $comment['create_date']; ?></p>
                                    <?php if (isset($comment['edit_date'])) : ?>
                                        <p class="date">Edité le <?php echo $comment['edit_date']; ?></p>
                                    <?php endif; ?>
                                </div>
                                <span class="bloc_btn">
                                    <a href="<?php echo HOST; ?>deleteComment/id/<?php echo $comment['id']; ?>/admin/1" class="jf_alert erase_com_btn btn">Effacer</a>
                                    <a href="<?php echo HOST; ?>acquitComment/id/<?php echo $comment['id']; ?>" class="acquit_com_btn btn">Acquitter</a>
                                </span>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
                </div>
            <?php else : ?>
                <?php $location = HOST; ?>
                <?php header("Location: $location"); ?>
            <?php endif; ?>
        </div>
    </div>
    <script src="<?php echo ASSETS; ?>js/Alert.js"></script>
    <script src="<?php echo ASSETS; ?>js/MenuAdmin.js"></script>
    <script src="<?php echo ASSETS; ?>js/Pagination.js"></script>
    <script src="<?php echo ASSETS; ?>js/CommentAdmin.js"></script>