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
        session_start();
        if (empty($contentArticle) || empty($titleArticle)) {

            $_SESSION['flash']['fail'] = 'Un champ vide ne peut être créé';
        } else {
            if (isset($_FILES['uploaded_file']['name']) && $_FILES['uploaded_file']['name'] != NULL) {
                $maxSize = 5000000;
                $validExt = array('.jpg', '.gif', '.png', '.jpeg');
                if ($_FILES['uploaded_file']['error'] > 0) {
                    $_SESSION['flash']['fail'] = 'Une erreur est survenue lors du transfert';
                    $myView = new View();
                    $myView->redirect('adminPanel');
                }
                $fileSize = $_FILES['uploaded_file']['size'];
                if ($fileSize > $maxSize) {
                    $_SESSION['flash']['fail'] = 'Le fichier est trop volumineux';
                    $myView = new View();
                    $myView->redirect('adminPanel');
                }
                $fileName = $_FILES['uploaded_file']['name'];
                $fileExt = "." . strtolower(substr(strrchr($fileName, "."), 1));
                if (!in_array($fileExt, $validExt)) {
                    $_SESSION['flash']['fail'] = 'Le fichier n\'est pas une image';
                    $myView = new View();
                    $myView->redirect('adminPanel');
                }
                $tmpName = $_FILES['uploaded_file']['tmp_name'];
                $uniqueName = md5(uniqid(rand(), true));
                $fileName = UPLOAD . $uniqueName . $fileExt;
                $fileNameUrl = HOST . 'content/upload/' . $uniqueName . $fileExt;
                $resultat = move_uploaded_file($tmpName, $fileName);
                if ($resultat) {
                    $_SESSION['flash']['success'] = 'Transfert réussi';
                }
            } else {
                $_SESSION['flash']['fail'] = 'Veuillez ajouter une image';
                $myView = new View();
                $myView->redirect('adminPanel');
            }
            $manager = new ArticleManager();
            $manager->addArticle($values, $fileNameUrl);
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
        $currentImgUrl = $values['imgUrl'];

        if (empty($contentArticle) || empty($titleArticle)) {
            session_start();
            $_SESSION['flash']['fail'] = 'Un champ vide ne peut être édité';
        } else if ($_FILES['uploaded_file']['name'] == "") {
            $dataArticle = $_POST['values'];
            $manager = new ArticleManager();
            $manager->updateArticle($dataArticle,$currentImgUrl);
            session_start();
            $_SESSION['flash']['success'] = 'Cet article a bien été édité';
        } else if (isset($_FILES['uploaded_file']['name']) && $_FILES['uploaded_file']['name'] != NULL) {
            $currentImgPath = explode("/", $currentImgUrl);
            unset($currentImgPath[0],$currentImgPath[1],$currentImgPath[2],$currentImgPath[3],$currentImgPath[4]);
            $currentImgPath[6] = "/" . $currentImgPath[6] . '/';
            $currentImgPath = ROOT . implode($currentImgPath);
            if (file_exists($currentImgPath)) {
                unlink($currentImgPath);
            }
            $maxSize = 5000000;
            $validExt = array('.jpg', '.gif', '.png', '.jpeg');
            if ($_FILES['uploaded_file']['error'] > 0) {
                $_SESSION['flash']['fail'] = 'Une erreur est survenue lors du transfert';
                $myView = new View();
                $myView->redirect('adminPanel');
            }
            $fileSize = $_FILES['uploaded_file']['size'];
            if ($fileSize > $maxSize) {
                $_SESSION['flash']['fail'] = 'Le fichier est trop volumineux';
                $myView = new View();
                $myView->redirect('adminPanel');
            }
            $fileName = $_FILES['uploaded_file']['name'];
            $fileExt = "." . strtolower(substr(strrchr($fileName, "."), 1));
            if (!in_array($fileExt, $validExt)) {
                $_SESSION['flash']['fail'] = 'Le fichier n\'est pas une image';
                $myView = new View();
                $myView->redirect('adminPanel');
            }
            $tmpName = $_FILES['uploaded_file']['tmp_name'];
            $uniqueName = md5(uniqid(rand(), true));
            $fileName = UPLOAD . $uniqueName . $fileExt;
            $fileNameUrl = HOST . 'content/upload/' . $uniqueName . $fileExt;
            $resultat = move_uploaded_file($tmpName, $fileName);
            if ($resultat) {
                $dataArticle = $_POST['values'];
                $manager = new ArticleManager();
                $manager->updateArticle($dataArticle, $fileNameUrl);
                session_start();
                $_SESSION['flash']['success'] = 'Cet article a bien été édité';
            }
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
