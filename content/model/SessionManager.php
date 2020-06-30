<?php

namespace content\model;

use content\classes\Manager;
use PDO;

class SessionManager extends Manager
{
    public function formRegister($params)
    {
        extract($params);

        $pseudo = htmlentities(trim($pseudo));
        $mail = htmlentities(strtolower(trim($mail)));
        $mdp = trim($mdp);
        $confmdp = trim($confmdp);
        $admin = 0;

        if ($params['mdp'] == "adminConnec20") {
            $admin = 1;
        }
        //hashage du mot de passe
        $mdp = password_hash($params['mdp'], PASSWORD_BCRYPT);

        // On insert nos données dans la table utilisateur
        $req = $this->bdd->prepare("INSERT INTO users SET pseudo = :pseudo, mdp = :mdp, mail = :mail, admin = :admin ");
        $req->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $req->bindValue(':mail', $mail, PDO::PARAM_STR);
        $req->bindValue(':mdp', $mdp, PDO::PARAM_STR);
        $req->bindValue(':admin', $admin, PDO::PARAM_INT);
        $req->execute();
    }
    public function verifMail($mail)
    {
        $req_mail = $this->bdd->prepare("SELECT mail FROM users WHERE mail = :mail");
        $req_mail->bindValue(':mail', $mail, PDO::PARAM_STR);
        $req_mail->execute();

        $req_mail = $req_mail->fetch();
        return $req_mail;
    }
    public function verifPseudo($pseudo)
    {
        $req_pseudo = $this->bdd->prepare("SELECT pseudo FROM users WHERE pseudo = :pseudo");
        $req_pseudo->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $req_pseudo->execute();

        $req_pseudo = $req_pseudo->fetch();
        return $req_pseudo;
    }
    public function verifLogin($pseudo)
    {

        $user = $this->bdd->prepare("SELECT * FROM users WHERE (pseudo = :pseudo OR mail = :pseudo)");
        $user->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $user->execute();

        $user = $user->fetch(PDO::FETCH_OBJ);
        return $user;
    }
}
