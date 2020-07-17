<?php $title = 'GTK ACCUEIL'; ?>
<div id="title_container" class="reveal">
  <h1 class="reveal">GOOD TO KNOW</h1>
  <h3 class="reveal">Apprendre pour mieux comprendre notre environnement.</h3>
</div>
<div id='main_home_content' class="reveal">
  <?php $lastArticle = end($articles); ?>
  <h2><a href="<?php echo HOST; ?>article/id/<?php echo $lastArticle['id'] ?>"><?php echo $lastArticle['title']; ?></a></h2>
  <a class= "last_article_url" href="<?php echo HOST; ?>article/id/<?php echo $lastArticle['id'] ?>">
    <div id="new_article_container">
      <article class="new_article_content">
        <p><?php echo substr($lastArticle['content'], 0, 300); ?> <p>...</p>
      </article>
      <img alt="<?php echo $lastArticle['title']; ?>" class="img_article" src="<?php echo $lastArticle['imageUrl']; ?>" />
    </div>
  </a>
<hr class="home_hr">
  <div id="home_articles" class="reveal">
    <h3>A lire également :</h3>
    <div class="list_content_articles">
      <?php foreach ($articles as $article) : ?>
        <a href="<?php echo HOST; ?>article/id/<?php echo $article['id'] ?>">
          <article class="article_content_container invisible">
            <h3 class="resume_title"><?php echo $article['title']; ?></h3>
            <p class='resume_content'><?php echo substr($article['content'], 0, 150); ?> ...</p>
            <img alt="<?php echo $article['title']; ?>" class="img_resume_article" src="<?php echo $article['imageUrl']; ?>" />
          </article>
        </a>
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