<?php $title = 'GTK Articles'; ?>
<h1 id="title_articles_container" class="reveal">Tous les articles</h1>
<div id="content_all_articles" class="reveal">
      <?php foreach ($articles as $article) : ?>
        <a href="<?php echo HOST; ?>article/id/<?php echo $article['id'] ?>">
          <div class="article_content_container">
            <h3 class="resume_title"><?php echo htmlspecialchars($article['title']); ?></h3>
            <div class='resume_content'><?php echo substr($article['content'], 0, 150); ?> ...</div>
            <img alt="<?php echo $article['title']; ?>" class="img_resume_article" src="<?php echo $article['imageUrl']; ?>" />
      </div>
        </a>
      <?php endforeach; ?>
    </div>
    <script src="<?php echo ASSETS; ?>js/IntersectionObserver.js"></script>