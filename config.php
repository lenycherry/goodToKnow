<?php
class MyConfig
{
    public static function start()
    {
//Liens absolus
$root = $_SERVER['DOCUMENT_ROOT'];//obtenir la racine du serveur
$host = $_SERVER['HTTP_HOST'];//obtenir l'url demandé

//création de constante des dossiers en lien absolu
define('HOST',$host.'/celiagaudin.fr/goodToKnow/');
define('ROOT', $root.'/celiagaudin.fr/goodToKnow/');

define('CONTROLLER', ROOT.'content/controller/');
define('VIEW', ROOT.'content/view/');
define('MODEL', ROOT.'content/model/');
define('ASSETS', HOST.'content/assets/');
    }
}
