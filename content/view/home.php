<?php $title = 'GTK ACCUEIL'; ?>
<div id="title_container" class="reveal">
  <h1 class="ml9">
    <span class="text-wrapper">
      <span class="letters">GOOD to know</span>
    </span>
  </h1>
  <h3 class="reveal">Apprendre pour mieux comprendre et préserver notre environnement.</h3>
</div>
<div id='main_home_content' class="reveal">
  <?php $lastArticle = $articles[0]; ?>
  <h2><a href="<?php echo HOST; ?>article/id/<?php echo $lastArticle['id'] ?>"><?php echo $lastArticle['title']; ?></a></h2>
  <a class= "last_article_url" href="<?php echo HOST; ?>article/id/<?php echo $lastArticle['id'] ?>">
    <div id="new_article_container">
      <div class="new_article_content">
        <p><?php echo substr($lastArticle['content'], 0, 300); ?>...</p>
</div>
      <img alt="<?php echo $lastArticle['title']; ?>" class="img_article" src="<?php echo $lastArticle['imageUrl']; ?>" />
    </div>
  </a>
<hr class="home_hr">
  <div id="home_articles" class="reveal">
    <h3>À lire également :</h3>
    <div class="list_content_articles">
      <?php foreach ($articles as $article) : ?>
        <a href="<?php echo HOST; ?>article/id/<?php echo $article['id'] ?>">
          <div class="article_content_container invisible">
            <h3 class="resume_title"><?php echo $article['title']; ?></h3>
            <div class='resume_content'><?php echo substr($article['content'], 0, 200); ?> ...</div>
            <img alt="<?php echo $article['title']; ?>" class="img_resume_article lazy" data-src="<?php echo $article['imageUrl']; ?>" />
      </div>
        </a>
      <?php endforeach; ?>
    </div>
    <div>
      <button class="first_page_btn btn">|&lt;</button> <button class="previous_page_btn btn">&lt;</button> <span id="pageInfo"></span>
            <button class="next_page_btn btn">></button>
            <button class="last_page_btn btn">>|</button>
    </div>
  </div>


</div>

<script src="<?php echo ASSETS; ?>js/LazyLoading.js"></script>
<script src="<?php echo ASSETS; ?>js/Pagination.js"></script>
<script src="<?php echo ASSETS; ?>js/IntersectionObserver.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<script src="<?php echo ASSETS; ?>js/LetterWrapper.js"></script>