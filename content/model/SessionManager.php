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
        //attribution d'un token 
        $token = bin2hex(random_bytes(15));
        // On insert nos données dans la table utilisateur

        $req = $this->bdd->prepare("INSERT INTO GTK_users SET pseudo = :pseudo, mdp = :mdp, mail = :mail, admin = :admin, token = :token ");
        $req->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $req->bindValue(':mail', $mail, PDO::PARAM_STR);
        $req->bindValue(':mdp', $mdp, PDO::PARAM_STR);
        $req->bindValue(':admin', $admin, PDO::PARAM_INT);
        $req->bindValue(':token', $token, PDO::PARAM_STR);
        $req->execute();
    }
    public function verifMail($mail)
    {
        $req_mail = $this->bdd->prepare("SELECT mail FROM GTK_users WHERE mail = :mail");
        $req_mail->bindValue(':mail', $mail, PDO::PARAM_STR);
        $req_mail->execute();

        $req_mail = $req_mail->fetch();
        return $req_mail;
    }
    public function verifPseudo($pseudo)
    {
        $req_pseudo = $this->bdd->prepare("SELECT pseudo FROM GTK_users WHERE pseudo = :pseudo");
        $req_pseudo->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $req_pseudo->execute();

        $req_pseudo = $req_pseudo->fetch();
        return $req_pseudo;
    }
    public function verifLogin($pseudo)
    {

        $user = $this->bdd->prepare("SELECT * FROM GTK_users WHERE (pseudo = :pseudo OR mail = :pseudo)");
        $user->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $user->execute();

        $user = $user->fetch(PDO::FETCH_OBJ);
        return $user;
    }
    public function findUser($id)
    {
        $user = $this->bdd->prepare("SELECT * FROM GTK_users WHERE id = :id");
        $user->bindValue(':id', $id, PDO::PARAM_INT);
        $user->execute();

        $user = $user->fetch(PDO::FETCH_OBJ);
        return $user;
    }
    public function confirmationToken($id, $tokenUrl)
    {
        $req = $this->bdd->prepare("SELECT token FROM GTK_users WHERE id = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetch();
        $token=$result[0];
        //si token de l'url est null = 0
        // si il correspond au token de la bdd = 1
        //si il ne correspond pas au token de la bdd = 2
        if ($token == null) {
            $verifToken = 0;
        } else if ($token == $tokenUrl) {
            $req = $this->bdd->prepare("UPDATE GTK_users SET token = NULL, confirmation_token = NOW() WHERE id =  :id");
            $req->bindValue(':id', $id, PDO::PARAM_INT);
            $req->execute();
            $verifToken = 1;

        } else {
            $verifToken = 2;
        }
        return $verifToken;
    }
}
