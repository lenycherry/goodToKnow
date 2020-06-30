<?php

namespace Content\classes;

class Article
{
    private $id;
    private $title;
    private $content;
    private $create_date;
    private $edit_date;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($title)
    {
        $this->title = $title;
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
}
