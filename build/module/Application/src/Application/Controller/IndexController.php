<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function homeAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true); // disable layout
        $viewModel->setTemplate('application/index/index');
        return $viewModel;
    }
}
