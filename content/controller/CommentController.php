<?php

namespace content\controller;

use content\model\CommentManager;
use content\model\ArticleManager;
use content\classes\View;

class CommentController
{
    public function showComment($params)
    {
        extract($params);
        $manager = new CommentManager();
        $articleManager = new ArticleManager();
        $currentComment = $manager->findComment($id);
        $articles = $articleManager->findAllArticle();// Recherche de la liste des articles pour le menu déroulant
        $comments = $manager->findAllComment(); //stock le résultat de la fonction findAllArticle
        $myView = new View('comment');
        $myView->render(array(
            'comments' => $comments,
            'currentComment' => $currentComment,
            'articles' => $articles
        )); //execute render (mise en mémoire tampon du contenu désiré)
    }
    public function showEditComment($params)
    {
        extract($params);
        if (isset($id)) {
            $manager = new CommentManager();
            $currentComment = $manager->findComment($id);
        } else {
            $myView = new View();
            $myView->redirect('comment');
        }
        $articleManager = new ArticleManager();
        $comments = $manager->findAllComment();
        $articles = $articleManager->findAllArticle();
        $myView = new View('editComment');
        $myView->render(array(
            'comments' => $comments,
            'currentComment' => $currentComment,
            'articles' => $articles
        ));
    }
    public function addComment($params)
    {
        extract($params);
        $contentComment = trim($values['content']);
        if (empty($contentComment)) {
            session_start();
            $_SESSION['flash']['fail'] = 'Un commentaire vide ne peut être créé';
        } else {
            session_start();
            $params['pseudo'] = $_SESSION['pseudo'];
            $manager = new CommentManager();
            $manager->addComment($params);
            $_SESSION['flash']['success'] = 'Ce commentaire a bien été ajouté';
        }
        $myView = new View();
        $currentArticle = 'article/id/' . $id;
        $myView->redirect($currentArticle);
    }
    public function updateComment($params)
    {
        extract($params);
        $dataComment = $values;
        $manager = new CommentManager();
        $currentComment = $manager->findComment($dataComment['id']);
        $contentComment = trim($dataComment['content']);
        if (empty($contentComment)) {
            session_start();
            $_SESSION['flash']['fail'] = 'Un commentaire vide ne peut être édité';
            $articleId = $currentComment->getArticleId();
        } else {
            $manager->updateComment($dataComment);
            $articleId = $currentComment->getArticleId();
            session_start();
            $_SESSION['flash']['success'] = 'Ce commentaire a bien été édité';
        }
        $myView = new View();
        if (isset($admin)) {
            $myView->redirect('adminPanel');
        }
        $currentArticle = 'article/id/' . $articleId;
        $myView->redirect($currentArticle);
    }
    public function deleteComment($params)
    {
        extract($params);
        $manager = new CommentManager();
        $currentComment = $manager->findComment($id);
        $articleId = $currentComment->getArticleId();
        $manager->deleteComment($id);
        session_start();
        $_SESSION['flash']['success'] = 'Ce commentaire a bien été supprimé';
        $myView = new View();
        if (isset($admin)) {
            $myView->redirect('adminPanel');
        }
        $currentArticle = 'article/id/' . $articleId;
        $myView->redirect($currentArticle);
    }
    public function reportComment($params)
    {
        extract($params);
        $manager = new CommentManager();
        $currentComment = $manager->findComment($id);
        if ($currentComment->getAcquit() != 1) {
            $manager->reportComment($currentComment);
        }
        session_start();
        $_SESSION['flash']['success'] = 'Ce commentaire a bien été signalé';
        $myView = new View();
        $articleId = $currentComment->getArticleId();
        $currentArticle = 'article/id/' . $articleId;
        $myView->redirect($currentArticle);
    }
    public function acquitComment($params)
    {
        extract($params);
        $manager = new CommentManager();
        $currentComment = $manager->findComment($id);
        if ($currentComment->getReported() > 0) {

            $manager->acquitComment($currentComment);
        }
        $_SESSION['flash']['success'] = 'Ce commentaire a bien été acquitté';
        $myView = new View();
        $myView->redirect('adminPanel');
    }
}
