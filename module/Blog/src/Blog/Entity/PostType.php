<?php

namespace Blog\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class PostType
 *
 * @package Blog\Entity
 *
 * @author Julien Guittard <julien.g@zend.com>
 * @version 1.0
 *
 * @ORM\Entity
 * @ORM\Table(name="posttype")
 */
class PostType extends AbstractTaxonomy
{
    /**
     * Entity icon
     *
     * @var string
     * @ORM\Column(name="icon", type="string", length=255, nullable=true)
     */
    protected $icon;

    /**
     * Related posts
     *
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Blog\Entity\Post", mappedBy="type")
     */
    protected $posts;

    /**
     * PostType constructor.
     */
    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * Get the type icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set the type icon
     *
     * @param string $icon
     * @return PostType
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
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
     * @return PostType
     */
    public function addPosts(Collection $posts)
    {
        /** @var Post $post */
        foreach ($posts as $post) {
            $post->setType($this);
            $this->posts->add($post);
        }
        return $this;
    }

    /**
     * Remove related posts
     *
     * @param Collection $posts
     * @return PostType
     */
    public function removePosts(Collection $posts)
    {
        /** @var Post $post */
        foreach ($posts as $post) {
            $post->setType(null);
            $this->posts->removeElement($post);
        }
        return $this;
    }
}