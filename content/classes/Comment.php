<?php

namespace content\classes;

class Comment
{
    private $id;
    private $pseudo;
    private $content;
    private $create_date;
    private $edit_date;
    private $reported;
    private $acquit;
    private $chapter_id;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getPseudo()
    {
        return $this->pseudo;
    }
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function setContent($content)
    {
        $this->content = $content;
    }
    public function getCreateDate()
    {
        return $this->create_date;
    }
    public function setCreateDate($create_date)
    {
        $this->create_date = $create_date;
    }
    public function getEditDate()
    {
        return $this->edit_date;
    }
    public function setEditDate($edit_date)
    {
        $this->edit_date = $edit_date;
    }
    public function getReported()
    {
        return $this->reported;
    }
    public function setReported($reported)
    {
        $this->reported = $reported;
    }
    public function getAcquit()
    {
        return $this->acquit;
    }
    public function setAcquit($acquit)
    {
        $this->acquit = $acquit;
    }
    public function getChapterId()
    {
        return $this->chapter_id;
    }
    public function setChapterId($chapter_id)
    {
        $this->chapter_id = $chapter_id;
    }
}
