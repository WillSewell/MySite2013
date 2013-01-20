<?php

namespace Contact\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class ContactController extends AbstractActionController
{
    public function indexAction()
    {      
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true); // disable layout
        
        return $viewModel;
    }
    
    public function processFormAction()
    {
        $msg = 'From: ' . $_POST['from_name'] . PHP_EOL . $_POST['msg'];
        $success = mail(
            'me@willsewell.name', 
            'Website Contact Form', 
            $msg,
            'From: ' . $_POST['from_email']
        );
        
        $result = new JsonModel(array(
            'success' => $success,
        ));
 
        return $result;
    }
}