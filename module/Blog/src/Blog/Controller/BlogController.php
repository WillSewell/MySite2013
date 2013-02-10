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
            'posts' => $this->getPostsTable()->getInitialPosts(10),
        ));
        $viewModel->setTerminal(true); // disable layout
        return $viewModel;
    }
    
    public function getMorePostsAction()
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
        $feed->setLink($domain . 'blog');
        $feed->setFeedLink($domain . 'blog/atom', 'atom');
        $feed->addAuthor($author);
        $feed->setDateModified(time());
        
        $posts = $this->getPostsTable()->getInitialPosts(10);
        foreach ($posts as $post) {
            $entry = $feed->createEntry();
            $entry->setTitle($post->title);
            $entry->setLink($domain . 'blog/post/' . $post->id);
            $entry->addAuthor($author);
            $entry->setDateModified(date_create($post->modified));
            $entry->setDateCreated(date_create($post->created));
            $entry->setContent($post->content);
            $feed->addEntry($entry);
        }
        $feedModel = new FeedModel(); PROBLEM HERE - NEED TO SET RENDER TO FEED
        $feedModel->setFeed($feed);
        return $feedModel;
    }
}