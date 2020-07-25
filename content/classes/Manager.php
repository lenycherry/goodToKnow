<?php

namespace content\classes;

use PDOException;
use PDO;

class Manager //gère la connection à la bdd
{
    protected $bdd;
    public function __construct()
    {
        try {
            $this->bdd = new PDO('mysql:host=celiagaufg67.mysql.db;dbname=celiagaufg67;charset=utf8', 'celiagaufg67', '5MV2haheegs');
        } catch (PDOException $e) {
            session_start();
            $_SESSION['flash']['fail'] = 'Une erreur de connexion à la base de donnée est survenue:' . $e->getMessage();
            $myView = new View('home');
        $myView->render(); 
        }
    }
}
