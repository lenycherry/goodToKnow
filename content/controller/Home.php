<?php

namespace content\controller;

use content\classes\View;
use content\model\ArticleManager;

class Home
{
    public function showHome()
{
        //On récupère les données de l'article dans la bdd en passant par un manager
        // on stock le résultat de la fonction findAllarticle dans un tableau $articles
        $manager = new ArticleManager();
        $articles = $manager->findAllArticle();

        $myView = new View('home');
        $myView->render(array('articles' => $articles)); // lance la fonction render( mise en mémoire du contenu dans une var $content) avec la clè articles et la valeur tableau $articles
    }
}
