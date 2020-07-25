<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <meta name="description" content="Découvrez GOOD to know, le petit journal de l'écologie. Préserver l'environnement, ça s'apprend! Blog Fictif PHP MySQL JS réalisé par Célia Gaudin dans le cadre d'un projet d'étude OpenClassroom">
    <link rel="icon" type="image/png" href="<?php echo ASSETS; ?>images/fav.png"/>
    <link href="<?php echo ASSETS; ?>css/style.css" rel="stylesheet" />
    <link href="<?php echo ASSETS; ?>css/responsiv.css" rel="stylesheet" />
    <link href="<?php echo ASSETS; ?>css/animation.css" rel="stylesheet" />
    <link href="<?php echo ASSETS; ?>fontawesome/css/all.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;500&family=Oswald:wght@500&display=swap" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/rrssibdlmdub4vn15tirsynq98km88ytywl7uys8kx9v8lfy/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<body>
    <div class="notif">
        <?php if (isset($_SESSION['flash'])) : ?>
            <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
                <div class="alert alert-<?= $type; ?>">
                    <?= htmlSpecialChars($message); ?>
                </div>
            <?php endforeach; ?>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>
    </div>
    <aside id="main_template_container">
        <header>
            <div class="title_container">
                <img class="home_logo wobble-hor-bottom" src="<?php echo ASSETS; ?>images/logo.png" alt="Dessin de cerveau dont une feuille pousse sur le dessus">
                <h1><a href="<?php echo HOST; ?>home">GOOD to know</a></h1>
            </div>
            <h4>Le petit journal scientifique de notre planète.</h4>
        </header>
        <nav id="main_navbar" class="reveal">
            <ul>
                <li><a href="<?php echo HOST; ?>home"><i class="fas fa-home fa-2x"></i>Accueil</a></li>
                <li><a href="<?php echo HOST; ?>articles"><i class="far fa-newspaper fa-2x"></i>Articles</a></li>
                <?php if (isset($_SESSION['admin'])) : ?>
                    <?php if ($_SESSION['admin'] == 1) : ?>
                        <li class="admin_button" title="Panneau d'administration"><a href="<?php echo HOST; ?>adminPanel"><i class="fas fa-edit fa-2x"></i>Espace Admin</a></li>
                    <?php endif; ?>
                <?php endif; ?>
                <?php
                if (isset($_SESSION['id'])) {
                ?>
                    <li class="logout_button" title="Déconnexion"><a href="<?php echo HOST; ?>logout"><i class="fas fa-power-off fa-2x"></i>Déconnection </a></li>
                <?php
                } else {
                ?>
                    <li class="login_button" title="Se connecter"><a href="<?php echo HOST; ?>login"><i class="fas fa-user-circle fa-2x"></i>Connexion</a></li>
                <?php
                }
                ?>
            </ul>
        </nav>
        <footer>
            <p>Blog Fictif PHP créé par Célia Gaudin dans le cadre d'un projet d'étude OpenClassrooms.</p>
            <p>Crédits photos : <a href="https://unsplash.com/@renran ">Ren Ran</a></p>
        </footer>
    </aside>

    <!--header responsive-->
    <header id="header_responsive_container">
        <div class="title_container">
            <img class="home_logo" src="<?php echo ASSETS; ?>images/logo.png" alt="Dessin de cerveau dont une feuille pousse sur le dessus">
            <h1><a href="<?php echo HOST; ?>home">GOOD to know</a></h1>
        </div>
        <nav id="main_responsive_navbar">
            <ul>
                <li class="home_icon" title="Accueil"><a href="<?php echo HOST; ?>home"><i class="fas fa-home fa-2x"></i></a></li>
                <li class="article_icon" title="Voir les articles"><a href="<?php echo HOST; ?>articles"><i class="far fa-newspaper fa-2x"></i></a></li>
                <?php if (isset($_SESSION['admin'])) : ?>
                    <?php if ($_SESSION['admin'] == 1) : ?>

                        <li class="admin_button" title="Panneau d'administration"><a href="<?php echo HOST; ?>adminPanel"><i class="fas fa-edit fa-2x"></i></a></li>
                    <?php endif; ?>
                <?php endif; ?>
                <?php
                if (isset($_SESSION['id'])) {
                ?>
                    <li class="logout_button" title="Déconnexion"><a href="<?php echo HOST; ?>logout"><i class="fas fa-power-off fa-2x"></i></a></li>
                <?php
                } else {
                ?>
                    <li class="login_button" title="Se connecter"><a href="<?php echo HOST; ?>login"><i class="fas fa-user-circle fa-2x"></i></a></li>
                <?php
                }
                ?>
            </ul>
        </nav>
    </header>
    <!--end header responsive-->

    <main>
        <div class="fake_aside"></div>
        <div class="main_bloc"><?php echo $content; ?></div>
    </main>
    <a class='back_to_up_btn' href="#"><i class="fas fa-chevron-circle-up fa-2x"></i></a>

    <!--footer responsive-->
    <footer id="responsive_footer_container">
        <p>Blog Fictif PHP créé par Célia Gaudin dans le cadre d'un projet d'étude OpenClassrooms.</p>
        <p>Crédits photos : <a href="https://unsplash.com/@renran ">Ren Ran</a></p>
    </footer>
    <!--end footer responsive-->

</body>

</html>