<?php

namespace content\classes;

use Exception;
use PDO;

class Manager //gère la connection à la bdd
{
    protected $bdd;
    public function __construct()
    {
        try {
            $this->bdd = new PDO('mysql:host=celiagaufg67.mysql.db;dbname=celiagaufg67;charset=utf8', 'celiagaufg67', '5MV2haheegs');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
