<?php
require 'vendor/autoload.php';
include_once ('config.php');
MyConfig::start();
use blog\classes\Routeur;

$request = $_GET['r'];//réecriture de l'url, r=contenu de la requête
$routeur = new Routeur($request);
$routeur->renderController();





