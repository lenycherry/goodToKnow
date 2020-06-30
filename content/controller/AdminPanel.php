<?php

namespace content\controller;
use content\classes\View;
use content\model\articleManager;
use content\model\CommentManager;

class AdminPanel
{
    public function showAdminPanel()
    {
        //On récupère les données de article et comment dans la bdd en initialisant leur manager et en lançant leur func "findAll"
        // on stock le résultat de la fonction "findAll" dans un tableau $article et $comments
        //on renvoi tous les articles et tous les commentaires à la vue
        $articleManager = new ArticleManager();
        $commentManager = new CommentManager();
        $article = $articleManager->findAllArticle(); 
        $comments = $commentManager->findAllComment(); 
        $myView = new View('adminPanel');
        $myView->render(array('article' => $article, 'comments' => $comments));
    }
}