<?php

namespace Blog\Model;

class Blog
{
    public $id;
    public $title;
    public $content;
    public $created;
    public $modified;

    public function exchangeArray($data)
    {
        $this->id = isset($data['id']) ? $data['id'] : null;
        $this->title = isset($data['title']) ? $data['title'] : null;
        $this->content = isset($data['content']) ? $data['content'] : null;
        $this->created  = isset($data['created']) ? $data['created'] : null;
        $this->modified = isset($data['modified']) ? $data['modified'] : null;
    }
}