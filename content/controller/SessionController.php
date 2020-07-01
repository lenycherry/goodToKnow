<?php

namespace content\controller;

use content\classes\View;
use content\model\SessionManager;
use content\model\ArticleManager;


class SessionController
{
    public function userRegister($params)
    {
        $manager = new SessionManager();
        $erForm  = array();

        // Si la variable "$params" contient des informations alors on les extrait
        if (!empty($params)) {
            extract($params);
            $valid = true;
        }
        // On récupère les informations
        if (isset($params)) {
            $pseudo = htmlentities(trim($pseudo));
            $mail = htmlentities(strtolower(trim($mail)));
            $mdp = trim($mdp);
            $confmdp = trim($confmdp);
            //  Vérification du champ pseudo
            if (empty($pseudo)) {
                $valid = false;
                $erForm["pseudo"] = "Veuillez rentrer votre pseudo.";
                //Vérif que le pseudo existe déja
            } else {
                $req_pseudo = $manager->verifPseudo($pseudo);
                if ($req_pseudo['pseudo'] <> "") {
                    $valid = false;
                    $erForm["pseudo"] = "Ce pseudo existe déjà.";
                }
            }
            // Vérification du champ mail
            if (empty($mail)) {
                $valid = false;
                $erForm["mail"] = "Veuillez rentrer un mail.";
                // Regex de mail classique
            } elseif (!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $mail)) {
                $valid = false;
                $erForm["mail"] = "Le mail n'est pas valide.";
            } else {
                //Vérif que le mail existe déjà
                $req_mail = $manager->verifMail($mail);
                if ($req_mail['mail'] <> "") {
                    $valid = false;
                    $erForm["mail"] = "Ce mail existe déjà.";
                }
            }
        }
        // Vérification du champ mot de passe et confirmation valide
        if (empty($mdp)) {
            $valid = false;
            $erForm["mdp"] = "Veuillez entrer un mot de passe.";
        } elseif ($mdp != $confmdp) {
            $valid = false;
            $erForm["mdp"] = "La confirmation du mot de passe ne correspond pas.";
        }
        elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $mdp)){
            $valid = false;
            $erForm["mdp"] = "Veuillez entrer un mot de passe valide. 8 caractères minimum, au moins une lettre, au moins un chiffre.";
        }
        // Si toutes les conditions sont remplies alors on fait le traitement vers la bdd via la fonction du model "formRegister"
        if ($valid) {
            $manager->formRegister($params);
            $user = $manager->verifLogin($pseudo);
            session_start();
            //$this->initSession($user);
            $this->sendMail($user);
            $_SESSION['flash']['success'] = 'Un e-mail vous a été envoyé. Veuillez confirmer votre inscription';
            $myView = new View();
            $myView->redirect('home');
        } else {

            $manager = new ArticleManager();
            $articles = $manager->findAllArticle();
            $myView = new View('login');
            $myView->render(array('Articles' => $articles, 'erForm' => $erForm));
        }
    }
    public function showUserLogin()
    {
        if (isset($_SESSION['id'])) {
            $myView = new View();
            $myView->redirect('home');
            exit;
        } else {
            $manager = new ArticleManager();
            $articles = $manager->findAllArticle();
            $myView = new View('login');
            $myView->render(array('Articles' => $articles));
        }
    }
    public function userLogin($params)
    {
        session_start();
        $manager = new SessionManager();
        $erForm  = array();
        // Si la variable "$params" contient des informations alors on les extrait
        if (!empty($params)) {
            extract($params);
        }
        // On récupère les informations extraites
        if (isset($params)) {
            $pseudo = htmlentities(trim($pseudo));
            $mdp = trim($mdp);
        }
        //  Vérification du champ pseudo
        if (empty($pseudo)) {
            $erForm["empty_pseudo"] = "Veuillez rentrer votre pseudo.";
        }
        // Vérification du champ mot de passe 
        if (empty($mdp)) {
            $erForm["empty_mdp"] = "Veuillez entrer un mot de passe.";
        }
        //On vérifie la concordance pseudo mdp 
        $user = $manager->verifLogin($pseudo);
        if ($user && password_verify($mdp, $user->mdp)) { //si ils correspondent on récupère ses infos dans la session
            $this->initSession($user);
            $myView = new View();
            $myView->redirect('home');
        } else if (!empty($mdp) && !empty($pseudo)) {
            $erForm["wrong_login"] = "Pseudo ou mot de passe incorrect.";
        }
        $manager = new ArticleManager();
        $articles = $manager->findAllArticle();
        $myView = new View('login');
        $myView->render(array('Articles' => $articles, 'erForm' => $erForm));
    }
    public function logout()
    {
        session_start();
        session_destroy();
        $myView = new View();
        $myView->redirect('home');
    }
    public function initSession($user)
    {
        $_SESSION['id'] = $user->id;
        $_SESSION['pseudo'] = $user->pseudo;
        $_SESSION['mail'] = $user->mail;
        $_SESSION['mdp'] = $user->mdp;
        $_SESSION['admin'] = $user->admin;
        $_SESSION['token'] = $user->token;
    }
    public function sendMail($user)
    {
        $mail_to = $user->mail; 
        
 
        //=====Création du header de l'e-mail.
        $header = "From: no-reply@gmail.com\n";
        $header .= "MIME-version: 1.0\n";
        $header .= "Content-type: text/html; charset=utf-8\n";
        $header .= "Content-Transfer-ncoding: 8bit";
        //=======
         
        //=====Ajout du message au format HTML          
        $contenu = 'Bonjour ' . $user->pseudo . ',
    Veuillez confirmer votre compte http://localhost/celiagaudin.fr/goodToKnow/confirmation/id/' . $user->id . "/token/" . $user->token ;
        mail($mail_to, 'Confirmation de votre compte', $contenu);   
    }
public function confirmationMail($params)
{
   
}
}

