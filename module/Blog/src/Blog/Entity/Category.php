<?php

namespace Blog\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class Category
 *
 * @package Blog\Entity
 *
 * @author Julien Guittard <julien.g@zend.com>
 * @version 1.0
 *
 * @ORM\Entity
 * @ORM\Table(name="category")
 */
class Category extends AbstractTaxonomy
{
    /**
     *
     * @var Category
     * @ORM\OneToOne(targetEntity="Blog\Entity\Category")
     */
    protected $parent;

    /**
     * Related posts
     *
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Blog\Entity\Post", mappedBy="category")
     */
    protected $posts;

    /**
     * Category constructor.
     */
    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * @return \Blog\Entity\Category
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param Category $parent
     * @return Category
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get the posts
     *
     * @return ArrayCollection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Add related posts
     *
     * @param Collection $posts
     * @return Category
     */
    public function addPosts(Collection $posts)
    {
        /** @var Post $post */
        foreach ($posts as $post) {
            $post->setCategory($this);
            $this->posts->add($post);
        }
        return $this;
    }

    /**
     * Remove related posts
     *
     * @param Collection $posts
     * @return Category
     */
    public function removePosts(Collection $posts)
    {
        /** @var Post $post */
        foreach ($posts as $post) {
            $post->setCategory(null);
            $this->posts->removeElement($post);
        }
        return $this;
    }
}