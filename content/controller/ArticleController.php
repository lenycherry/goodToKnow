<?php

namespace content\controller;

use content\model\ArticleManager;
use content\model\CommentManager;
use content\classes\View;

class ArticleController
{
    public function showArticle($params)
    {
        extract($params);
        $articleManager = new ArticleManager();
        $commentManager = new CommentManager();
        $currentArticle = $articleManager->findArticle($id);
        $articles = $articleManager->findAllArticle(); //stock le résultat de la fonction findAllArticle
        $comments = $commentManager->findAllCommentPerArticle($id); //stock le résultat de la fonction findAllComment
        $myView = new View('article');
        $myView->render(array('articles' => $articles, 'currentArticle' => $currentArticle, 'comments' => $comments)); //execute render (mise en mémoire tampon du contenu désiré)

    }
    public function showCreateArticle() // affiche la page de création det article tinyMCE
    {
        $manager = new ArticleManager();
        $articles = $manager->findAllArticle();
        $myView = new View('createArticle');
        $myView->render(array('articles' => $articles));
    }
    public function showEditArticle($params)
    {
        extract($params);
        if (isset($id)) {
            $manager = new ArticleManager();
            $currentArticle = $manager->findArticle($id);
        } else {
            $myView = new View();
            $myView->redirect('createArticle');
        }
        $articles = $manager->findAllArticle();
        $myView = new View('editArticle');
        $myView->render(array('articles' => $articles, 'currentArticle' => $currentArticle));
    }

    public function addArticle($params)
    {
        extract($params);
        $contentArticle = trim($values['content']);
        $titleArticle = trim($values['title']);
        if (empty($contentArticle) || empty($titleArticle)) {
            session_start();
            $_SESSION['flash']['fail'] = 'Un champ vide ne peut être créé';
        } else {
            $manager = new ArticleManager();
            $manager->addArticle($values);
            session_start();
            $_SESSION['flash']['success'] = 'Cet article a bien été ajouté';
        }
        $myView = new View();
        $myView->redirect('adminPanel');
    }
    public function updateArticle($params)
    {
        extract($params);
        $contentArticle = trim($values['content']);
        $titleArticle = trim($values['title']);
        if (empty($contentArticle) || empty($titleArticle)) {
            session_start();
            $_SESSION['flash']['fail'] = 'Un champ vide ne peut être édité';
        } else {
            $dataArticle = $_POST['values'];
            $manager = new ArticleManager();
            $manager->updateArticle($dataArticle);
            session_start();
            $_SESSION['flash']['success'] = 'Cet article a bien été édité';
        }
        $myView = new View();
        $myView->redirect('adminPanel');
    }
    public function deleteArticle($params)
    {
        extract($params);
        $manager = new ArticleManager();
        $manager->deleteArticle($id);
        session_start();
        $_SESSION['flash']['success'] = 'Cet article a bien été supprimé';
        $myView = new View();
        $myView->redirect('adminPanel');
    }
}
