<?php
class MyConfig
{
    public static function start()
    {
//Liens absolus
$root = $_SERVER['DOCUMENT_ROOT'];//obtenir la racine du serveur
$host = $_SERVER['HTTP_HOST'];//obtenir l'url demandé

//création de constante des dossiers en lien absolu

define('HOST',"https://".$host.'/goodToKnow/');
define('ROOT', $root.'/goodToKnow/');

define('CONTROLLER', ROOT.'content/controller/');
define('VIEW', ROOT.'content/view/');
define('MODEL', ROOT.'content/model/');
define('UPLOAD', ROOT.'content/upload/');
define('ASSETS', HOST.'content/assets/');

    }
}
