<?php

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class BlogController extends AbstractActionController
{
    /**
     * Get the initial list of blog entries to send to the view
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction()
    {      
        
        
        
        $viewModel = new ViewModel(array(
            'posts' => $model->get_initial_posts(10),
        ));
        $viewModel->setTerminal(true); // disable layout
        return $viewModel;
    }
    
    public function getMorePosts()
    {
        // send JSON list of more results so feed can keep refreshing with ajax
    }
}