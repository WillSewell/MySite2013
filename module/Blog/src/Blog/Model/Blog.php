<?php

namespace Album\Blog;

class Blog
{
    public $id;
    public $content;
    public $content;

    public function exchangeArray($data)
    {
        $this->id      = isset($data['id']) ? $data['id'] : null;
        $this->title   = isset($data['title']) ? $data['title'] : null;
        $this->content = isset($data['content']) ? $data['content'] : null;
    }
}