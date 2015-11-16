<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Blog\Service\Post as PostService;

/**
 * Class HomeController
 *
 * @package Application\Controller
 *
 * @author Julien Guittard <julien.g@zend.com>
 * @version 1.0
 */
class HomeController extends AbstractActionController
{
    /**
     * @var PostService
     */
    protected $postService;

    /**
     * IndexController constructor.
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function indexAction()
    {
        return ['posts' => $this->postService->listPosts()];
    }
}
