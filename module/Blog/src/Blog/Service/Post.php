<?php

namespace Blog\Service;

use Doctrine\ORM\QueryBuilder;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;


/**
 * Class Post
 *
 * @package Blog\Service
 *
 * @author Julien Guittard <julien.g@zend.com>
 * @version 1.0
 */
class Post extends AbstractResourceService
{
    /**
     * Retrieves a paginated collection of posts
     *
     * @param int $count
     * @param int $page
     * @return Paginator
     */
    public function listPosts($count = 10, $page = 1)
    {
        return $this->getPaginator($this->mapper->getEntityRepository()->createQueryBuilder('post'), $count, $page);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getPostById($id)
    {
        return $this->mapper->fetchOne($id);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getPostBySlug($slug)
    {
        return $this->mapper->fetchBy('slug', $slug);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function createPost($data)
    {
        return parent::create($data);
    }


    public function updatePost($id, $data)
    {

    }

    /**
     * @param $id
     * @return mixed
     */
    public function deletePost($id)
    {
        return parent::delete($id);
    }

    /**
     * @param QueryBuilder $qb
     * @param int $count
     * @param int $page
     * @return Paginator
     */
    protected function getPaginator($qb, $count, $page)
    {
        $adapter = new DoctrineAdapter(new ORMPaginator($qb));
        $paginator = new Paginator($adapter);
        $paginator->setItemCountPerPage($count)
                  ->setCurrentPageNumber($page);
        return $paginator;
    }
}