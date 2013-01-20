<?php

namespace Blog\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class PostsTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    public function getInitialPosts($number = 10)
    {
        return $this->getPostsFromOffset(0, $number);
    }
    
    public function getPostsFromOffset($offset, $number = 10)
    {
        return $this->tableGateway->select(function (Select $select) use ($offset, $number)
        {
            $select->order('created DESC')->offset($offset)->limit($number);
        });
    }

}