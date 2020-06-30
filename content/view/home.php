<?php $title = 'GTK ACCUEIL'; ?>
<div id="title_container" class ="reveal">
    <h1>TITRE</h1>
    <h3>Sous-titre</h3>
</div>
<div id='main_home_content'>
    <div id="articles_container">
        <section id="summary_container" class ="reveal">
            <h2>Element 1</h2>    
        </section>
        <section id="presentation_container" class ="reveal">
            <div class="presentation_p">
                <h2>Element 2</h2>
            </div>
        </section>
    </div>
    <div id="new_article_container" class ="reveal">
        <?php $lastArticle = end($articles); ?>
        <h2><a href="<?php echo HOST; ?>article/id/<?php echo $lastArticle['id'] ?>">Dernier article publié</a></h2>
        <article class="new_article_content">
            <h3><?php echo $lastArticle['title']; ?></h3>
            <p><?php echo substr($lastArticle['content'], 0, 500); ?> <p>...</p>
            <a class="btn" href="<?php echo HOST; ?>article/id/<?php echo $lastArticle['id'] ?>">L'article'</a>
        </article>
    </div>
</div>
<script src="<?php echo ASSETS; ?>js/IntersectionObserver.js"></script>