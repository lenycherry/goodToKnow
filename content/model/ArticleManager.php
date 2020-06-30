<?php

namespace content\model;

use content\classes\Manager;
use content\classes\Article;
use PDO;

class ArticleManager extends Manager //gère la connection à la bdd par son parent et à la table Article
{
    public function findAllArticle()
    {
        $req = $this->bdd->prepare("SELECT *,DATE_FORMAT(create_date, '%d/%m/%Y à %Hh%i') AS create_date,DATE_FORMAT(edit_date, '%d/%m/%Y à %Hh%i') AS edit_date FROM Articles ORDER BY id");
        $req->execute();
        $articles = $req->fetchAll();
        return $articles;
    }
    public function findArticle($id)
    {
        $req = $this->bdd->prepare("SELECT *, DATE_FORMAT(create_date, '%d/%m/%Y à %Hh%i') AS create_date,DATE_FORMAT(edit_date, '%d/%m/%Y à %Hh%i') AS edit_date FROM Articles WHERE id = :id ");
        $req->bindValue(':id', $id, PDO::PARAM_INT); // définition de la valeur de :id soit le param $id de la fonction en var int
        $req->execute();
        $result = $req->fetch(PDO::FETCH_ASSOC); //stock le résultat de la requête dans la var result
        $currentArticle = new Article();
        // hydratation du chapitre demandé
        $currentArticle->setId($result['id']);
        $currentArticle->setTitle($result['title']);
        $currentArticle->setContent($result['content']);
        $currentArticle->setCreateDate($result['create_date']);
        $currentArticle->setEditDate($result['edit_date']);
        return $currentArticle;
    }
    public function addArticle($dataArticle)
    {
        $title = $dataArticle['title'];
        $content = $dataArticle['content'];
        $req = $this->bdd->prepare('INSERT INTO Articles (title, content) VALUES(:title, :content)');
        $req->bindValue(':title', $title, PDO::PARAM_STR);
        $req->bindValue(':content', $content, PDO::PARAM_STR);
        $req->execute();
    }
    public function updateArticle($dataArticle)
    {
        $title = $dataArticle['title'];
        $content = $dataArticle['content'];
        $id = $dataArticle['id'];
        $req = $this->bdd->prepare('UPDATE Articles SET title = :title, content = :content, edit_date = NOW() WHERE id = :id');
        $req->bindValue(':title', $title, PDO::PARAM_STR);
        $req->bindValue(':content', $content, PDO::PARAM_STR);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }
    public function deleteArticle($id)
    {
        $req = $this->bdd->prepare('DELETE FROM Articles WHERE id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }
}
