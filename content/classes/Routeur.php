<?php

namespace content\classes;

class Routeur
{
    private $request;

    private $routes = [

        'login'        => ['controller' => 'SessionController', 'method' => 'showUserlogin'],
        'userLogin'    => ['controller' => 'SessionController', 'method' => 'userLogin'],
        'register'     => ['controller' => 'SessionController', 'method' => 'showUserRegister'],
        'userRegister' => ['controller' => 'SessionController', 'method' => 'userRegister'],
        'logout'       => ['controller' => 'SessionController', 'method' => 'logout'],
        'confirmation' => ['controller' => 'SessionController', 'method' => 'confirmationMail'],
        

        'createArticle' => ['controller' => 'ArticleController', 'method' => 'showCreateArticle'],
        'editArticle'   => ['controller' => 'ArticleController', 'method' => 'showEditArticle'],
        'updateArticle' => ['controller' => 'ArticleController', 'method' => 'updateArticle'],
        'addArticle'    => ['controller' => 'ArticleController', 'method' => 'addArticle'],
        'deleteArticle' => ['controller' => 'ArticleController', 'method' => 'deleteArticle'],               

        'createComment' => ['controller' => 'CommentController', 'method' => 'showCreateComment'],
        'editComment'   => ['controller' => 'CommentController', 'method' => 'showEditComment'],
        'updateComment' => ['controller' => 'CommentController', 'method' => 'updateComment'],
        'addComment'    => ['controller' => 'CommentController', 'method' => 'addComment'],
        'deleteComment' => ['controller' => 'CommentController', 'method' => 'deleteComment'],
        'reportComment' => ['controller' => 'CommentController', 'method' => 'reportComment'],
        'acquitComment' => ['controller' => 'CommentController', 'method' => 'acquitComment'],
        'jsonComment' => ['controller' => 'CommentController', 'method' => 'findJsonComment'],

        'adminPanel'    => ['controller' => 'AdminPanel',        'method' => 'showAdminPanel'],
        'home'          => ['controller' => 'Home',              'method' => 'showHome'],
        'article'       => ['controller' => 'articleController', 'method' => 'showArticle'],
    ];

    public function __construct($request)
    {
        $this->request = $request;
        
    }

    //func getRoute = récupère la route
    //explose l'url pour récup dans un tableau les strings après les /, retourne l'élement 0 qui est = à la route
    public function getRoute()
    {
        $elements = explode("/", $this->request);
        return $elements[0];
    }
    //func getParams = retourne les paramètres en parcourant les elements de l'url explosée et en les incluant dans un tableau $Params (sauf la route)
    //si il s'agit d'elements Post, on les stocks en tant que valeur dans le tableau $Params avec un alias key-val
    public function getParams()
    {
        $params = null;
        $elements = explode("/", $this->request);
        unset($elements[0]);
        for ($i = 1; $i < count($elements); $i++) {
            $params[$elements[$i]] = $elements[$i + 1];
            $i++;
        }
        if ($_POST) {
            foreach ($_POST as $key => $val) {
                $params[$key] = $val;
            }
        }
        return $params;
    }
    public function  renderController()
    {
        $route = $this->getRoute();
        $params = $this->getParams();
        if (key_exists($route, $this->routes)) {
            $controller = "content\\controller\\" . $this->routes[$route]["controller"];
            $method = $this->routes[$route]['method'];
            $currentController = new $controller(); // instancie le controller demandé
            $currentController->$method($params); // appelle la méthode concernée
        } else if (!isset($_GET['r'])) {
            header("Location: home");
        } else {
            session_start();
            $_SESSION['flash']['fail'] = 'erreur 404, la page suivante n\'existe pas : ' . $route;
            header("Location: home");
        }
    }
}
