<?php

namespace Blog\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class Tag
 *
 * @package Blog\Entity
 *
 * @author Julien Guittard <julien.g@zend.com>
 * @version 1.0
 *
 * @ORM\Entity
 * @ORM\Table(name="tag")
 */
class Tag extends AbstractTaxonomy
{
    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Blog\Entity\Post", inversedBy="tags")
     */
    protected $posts;

    /**
     * Tag constructor.
     */
    public function __construct()
    {
        $this->posts = new ArrayCollection();
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
}