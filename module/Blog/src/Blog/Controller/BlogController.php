<?php

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Feed\Writer\Feed;
use Zend\View\Model\FeedModel;

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
            'posts' => $this->getPostsTable()->getInitialPosts(5),
        ));
        $viewModel->setTerminal(true); // disable layout
        return $viewModel;
    }
    
    public function getMorePostsAction($offet)
    {
        $viewModel = new ViewModel(array(
            'posts' => $this->getPostsTable()->getPostsFromOffset($offet),
        ));
        $viewModel->setTerminal(true); // disable layout
        return $viewModel;
    }
    
    public function getPostsTable()
    {
        if (!$this->postsTable) {
            $sm = $this->getServiceLocator();
            $this->postsTable = $sm->get('Blog\Model\PostsTable');
        }
        return $this->postsTable;
    }
    
    public function atomAction()
    {
        //@todo should be in config
        $author = array(
            'name'  => 'Will Sewell',
            'email' => 'me@willsewell.name',
            'uri'   => 'http://willsewell.name',
        );
        $domain = 'http://willsewell.name/';
        
        $feed = new Feed;
        $feed->setTitle("Will Sewell's Blog");
        $feed->setDescription("Will Sewell's blog");
        $feed->setLink($domain . 'blog');
        $feed->setFeedLink($domain . 'blog/atom', 'atom');
        $feed->addAuthor($author);
        $feed->setDateModified(time());
        
        $posts = $this->getPostsTable()->getInitialPosts(5);
        foreach ($posts as $post) {
            $entry = $feed->createEntry();
            $entry->setTitle($post->title);
            $entry->setLink($domain . 'blog/post/' . $post->id);
            $entry->addAuthor($author);
            $entry->setDateModified(date_create($post->modified));
            $entry->setDateCreated(date_create($post->created));
            $entry->setDescription('A post by Will Sewell.');
            $entry->setContent($post->content);
            $feed->addEntry($entry);
        }
        $feed->export('atom');
        
        $feedModel = new FeedModel();
        $feedModel->setFeed($feed);
        return $feedModel;
    }
}