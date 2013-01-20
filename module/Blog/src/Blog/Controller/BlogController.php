<?php

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class BlogController extends AbstractActionController
{
    protected $postsTable;
    
    /**
     * Get the initial list of blog entries to send to the view
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        $viewModel = new ViewModel(array(
            'posts' => $this->getPostsTable()->getInitialPosts(10),
        ));
        $viewModel->setTerminal(true); // disable layout
        return $viewModel;
    }
    
    public function getMorePosts()
    {
        // send JSON list of more results so feed can keep refreshing with ajax
    }
    
    public function getPostsTable()
    {
        if (!$this->postsTable) {
            $sm = $this->getServiceLocator();
            $this->postsTable = $sm->get('Blog\Model\PostsTable');
        }
        return $this->postsTable;
    }
}