<?php $title = 'GTK ACCUEIL'; ?>
<div id="title_container" class="reveal">
  <h1>TITRE</h1>
  <h3>Sous-titre</h3>
</div>
<div id='main_home_content'>

  <div id="new_article_container" class="reveal">
    <?php $lastArticle = end($articles); ?>

    <img class="img_last_article" src="<?php echo $lastArticle['imageUrl']; ?>" />

    <article class="new_article_content">
    <h2><a href="<?php echo HOST; ?>article/id/<?php echo $lastArticle['id'] ?>">Dernier article publié</a></h2>
      <h3><?php echo $lastArticle['title']; ?></h3>
      <p><?php echo substr($lastArticle['content'], 0, 500); ?> <p>...</p>
      <a class="btn" href="<?php echo HOST; ?>article/id/<?php echo $lastArticle['id'] ?>">Voir l'article</a>
    </article>
  </div>

  <div id="home_articles" class="reveal">
  <div class="list_content_articles">
    <?php foreach ($articles as $article) : ?>
      <article class="article_content_container invisible">
        <h3><?php echo $article['title']; ?></h3>
    </article>
    <?php endforeach; ?>
    </div>
    <div>
      <button class="first_page_btn btn">|<</button> <button class="previous_page_btn btn">
          <</button> <span id="pageInfo"></span>
            <button class="next_page_btn btn">></button>
            <button class="last_page_btn btn">>|</button>
    </div>
  </div>
  

</div>

<script src="<?php echo ASSETS; ?>js/Pagination.js"></script>
<script src="<?php echo ASSETS; ?>js/IntersectionObserver.js"></script>