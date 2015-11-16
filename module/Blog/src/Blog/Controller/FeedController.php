<?php

namespace Blog\Controller;

use Blog\Service\Post as PostService;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class FeedController
 *
 * @package Blog\Controller
 */
class FeedController extends AbstractActionController
{
    /**
     * @var PostService
     */
    protected $postService;

    /**
     * BlogController constructor.
     *
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function rssAction()
    {

    }

    public function atomAction()
    {

    }
}