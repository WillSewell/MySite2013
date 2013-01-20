<?php

namespace Album\Model;

use Zend\Db\TableGateway\TableGateway;

class PostsTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    public function getInitialPosts($number = 10)
    {
        $this->getPostsFromOffset(0, $number);
    }
    
    public function getPostsFromOffset($offset, $number = 10)
    {
        $this->tableGateway->select(function (Select $select) use ($offset, $number)
        {
            $select->order('DESC')->offset($offset)->limit($number);
        });
    }

}