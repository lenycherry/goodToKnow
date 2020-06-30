<?php

namespace content\classes;

class View
{
    private $template;
    public function __construct($template = null)
    {
        $this->template = $template;
    }
    public function render($params = array())
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        extract($params);
        $template = $this->template;
        //stock la vue dans une mémoire tampon. au moment ou le cache se vide, le contenu de la vue est stocké dans une var $content
        ob_start();
        include(VIEW . $template . '.php');
        $content = ob_get_clean();
        //affiche le templatePage + la variable $content déjà présente dans le fichier.
        include_once(VIEW . 'templatePage.php');
    }
    public function redirect($route)
    {
        header("Location:" . HOST . $route);
        exit;
    }
}
