<?php

namespace content\model;

use content\classes\Manager;
use content\classes\Comment;
use PDO;

class CommentManager extends Manager
{
    public function findComment($id)
    {
        $req = $this->bdd->prepare("SELECT * , DATE_FORMAT(create_date, '%d/%m/%Y %Hh%imin%ss') AS create_date, DATE_FORMAT(edit_date, '%d/%m/%Y %Hh%imin%ss') AS edit_date FROM GTK_comments WHERE id = :id ");
        //$req = $this->bdd->prepare("SELECT DATE_FORMAT(create_date, '%d/%m/%Y %Hh%imin%ss') AS create_date FROM comments WHERE id = :id ");
        $req->bindValue(':id', $id, PDO::PARAM_INT); // définition de la valeur de :id soit le param $id de la fonction en var int
        $req->execute();
        $result = $req->fetch(PDO::FETCH_ASSOC); //stock le résultat de la requête dans la var result
        $currentComment = new Comment();
        // hydratation du commentaire demandé
        $currentComment->setId($result['id']);
        $currentComment->setPseudo($result['pseudo']);
        $currentComment->setContent($result['content']);
        $currentComment->setCreateDate($result['create_date']);
        $currentComment->setEditDate($result['edit_date']);
        $currentComment->setReported($result['reported']);
        $currentComment->setAcquit($result['acquit']);
        $currentComment->setArticleId($result['article_id']);
        return $currentComment;
    }
    public function findAllComment()
    {
        $req = $this->bdd->prepare("SELECT *,DATE_FORMAT(create_date, 'Le %d/%m/%Y à %Hh%i') AS create_date,DATE_FORMAT(edit_date, 'Le %d/%m/%Y à %Hh%i') AS edit_date FROM GTK_comments ORDER BY id DESC");
        $req->execute();
        $comments = $req->fetchAll();
        return $comments;
    }
    public function findAllCommentPerArticle($id)
    {
        $req = $this->bdd->prepare("SELECT *, DATE_FORMAT(create_date, 'Le %d/%m/%Y à %Hh%i') AS create_date, DATE_FORMAT(edit_date, 'Le %d/%m/%Y à %Hh%i') AS edit_date FROM GTK_comments WHERE article_id = :article_id ORDER BY id DESC");
        $req->bindValue(':article_id', $id, PDO::PARAM_STR);
        $req->execute();
        $comments = $req->fetchAll();
        return $comments;
    }
    public function addComment($dataComment)
    {
        $pseudo = $dataComment['pseudo'];
        $content = $dataComment['values']['content'];
        $articleId = $dataComment['id'];
        $req = $this->bdd->prepare('INSERT INTO GTK_comments (pseudo, content, article_id) VALUES(:pseudo, :content, :article_id)');
        $req->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $req->bindValue(':content', $content, PDO::PARAM_STR);
        $req->bindValue(':article_id', $articleId, PDO::PARAM_INT);
        $req->execute();
    }
    public function updateComment($dataComment)
    {
        $content = $dataComment['content'];
        $id = $dataComment['id'];
        $req = $this->bdd->prepare('UPDATE GTK_comments SET  content = :content, edit_date = NOW() WHERE id = :id');
        $req->bindValue(':content', $content, PDO::PARAM_STR);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }
    public function verifUser($id)
    {
        $req = $this->bdd->prepare('SELECT pseudo FROM GTK_comments WHERE id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $authPseudo = $req->fetch();
        return $authPseudo;
    }
    public function deleteComment($id)
    {
        $req = $this->bdd->prepare('DELETE FROM GTK_comments WHERE id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }
    public function reportComment($currentComment)
    {
        $reported = 1;
        $id = $currentComment->getId();
        $req = $this->bdd->prepare('UPDATE GTK_comments SET reported = :reported WHERE id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->bindValue(':reported', $reported, PDO::PARAM_INT);
        $req->execute();
    }
    public function acquitComment($currentComment)
    {
        $acquit = 1;
        $reported = 0;
        $id = $currentComment->getId();
        $req = $this->bdd->prepare('UPDATE GTK_comments SET acquit = :acquit, reported = :reported WHERE id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->bindValue(':acquit', $acquit, PDO::PARAM_INT);
        $req->bindValue(':reported', $reported, PDO::PARAM_INT);
        $req->execute();
    }
    public function findAllJson($id)
    {
        $req = $this->bdd->prepare("SELECT *, DATE_FORMAT(create_date, 'Crée le %d/%m/%Y à %Hh%i') AS create_date, DATE_FORMAT(edit_date, 'Edité le %d/%m/%Y à %Hh%i') AS edit_date FROM GTK_comments WHERE article_id = :article_id ORDER BY id DESC"); 
        $req->bindValue(':article_id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}
