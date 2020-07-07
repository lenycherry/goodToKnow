<?php $title = 'GTK ACCUEIL'; ?>
<div id="title_container" class="reveal">
    <h1>TITRE</h1>
    <h3>Sous-titre</h3>
</div>
<div id='main_home_content'>

    <div id="new_article_container" class="reveal">
        <?php $lastArticle = end($articles); ?>
        <h2><a href="<?php echo HOST; ?>article/id/<?php echo $lastArticle['id'] ?>">Dernier article publié</a></h2>
        <article class="new_article_content">
            <h3><?php echo $lastArticle['title']; ?></h3>
            <p><?php echo substr($lastArticle['content'], 0, 500); ?> <p>...</p>
                <a class="btn" href="<?php echo HOST; ?>article/id/<?php echo $lastArticle['id'] ?>">Voir l'article</a>
        </article>
    </div>

    <div class="home_articles_container">
    <table class="table">
      <thead>
        <tr>
          <th>Derniers articles</th>
        </tr>
      </thead>
      <tbody id="comment_list">
      </tbody>
    </table>
    <div>
      <button class="btn" onclick="firstPage()">|<</button>
          <button class="btn" onclick="previous()">
            <</button>
              <span id="pageInfo"></span>
              <button class="btn" onclick="nextPage()">></button>
              <button class="btn" onclick="lastPage()">>|</button>
    </div>
  </div>            
            
    
</div>

    <script src="<?php echo ASSETS; ?>js/Pagination.js"></script>
    <script src="<?php echo ASSETS; ?>js/IntersectionObserver.js"></script>