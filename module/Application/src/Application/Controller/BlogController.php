<?php

namespace Application\Controller;

use Blog\Service\Post as PostService;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class BlogController
 *
 * @package Application\Controller
 */
class BlogController extends AbstractActionController
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

    public function postAction()
    {
        $slug = $this->params()->fromRoute('slug');
        $post = $this->postService->getPostBySlug($slug);
        return compact('post');
    }
}