<?php

namespace Blog\Entity;

use \DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class Post
 *
 * @package Blog\Entity
 *
 * @author Julien Guittard <julien.g@zend.com>
 * @version 1.0
 *
 * @ORM\Entity
 * @ORM\Table(name="post", indexes={@ORM\Index(name="slug_idx", columns={"slug"})})
 */
class Post implements EntityInterface
{
    use EntityTrait;

    /**
     * Post title
     *
     * @var string
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    protected $title;

    /**
     * Post slug
     *
     * @var string
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(name="slug", length=255, unique=true)
     */
    protected $slug;

    /**
     * Post excerpt
     *
     * @var string
     * @ORM\Column(name="excerpt", type="text", nullable=true)
     */
    protected $excerpt;

    /**
     * Post content
     *
     * @var string
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    protected $content;

    /**
     * Post type
     *
     * @var PostType
     * @ORM\ManyToOne(targetEntity="Blog\Entity\PostType", inversedBy="posts", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    protected $type;

    /**
     * Post status
     *
     * @var int
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    protected $status;

    /**
     * Number of likes for the post
     *
     * @var int
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    protected $likes;

    /**
     * Date and time when the post was published
     *
     * @var DateTime
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    protected $publishedAt;

    /**
     * Post banner
     *
     * @var string
     * @ORM\Column(name="banner", type="string", length=255, nullable=true)
     */
    protected $banner;

    /**
     * Post author
     *
     * @var User
     * @ORM\ManyToOne(targetEntity="Blog\Entity\User", inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $author;

    /**
     * Post category
     *
     * @var Category
     * @ORM\ManyToOne(targetEntity="Blog\Entity\Category", inversedBy="posts", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    protected $category;

    /**
     * Post tags
     *
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Blog\Entity\Tag", mappedBy="posts")
     * @ORM\JoinTable(name="post_tag")
     */
    protected $tags;

    /**
     * Post Comments
     *
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Blog\Entity\Comment", mappedBy="post")
     */
    protected $comments;

    /**
     * Post constructor.
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    /**
     * Get the title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get the slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the slug
     *
     * @param string $slug
     * @return Post
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Get the excerpt
     *
     * @return mixed
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * Set the excerpt
     *
     * @param mixed $excerpt
     * @return Post
     */
    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;
        return $this;
    }

    /**
     * Get the content
     *
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the content
     *
     * @param mixed $content
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get the category
     *
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the category
     *
     * @param Category $category
     * @return Post
     */
    public function setCategory(Category $category = null)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Get the type
     *
     * @return PostType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the type
     *
     * @param PostType $type
     * @return Post
     */
    public function setType(PostType $type = null)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get the status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the status
     *
     * @param int $status
     * @return Post
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get the likes
     *
     * @return int
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * Set the likes
     *
     * @param int $likes
     * @return Post
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;
        return $this;
    }

    /**
     * Get the publishedAt
     *
     * @return DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Set the publishedAt
     *
     * @param DateTime $publishedAt
     * @return Post
     */
    public function setPublishedAt(DateTime $publishedAt = null)
    {
        $this->publishedAt = $publishedAt;
        return $this;
    }

    /**
     * Get the banner
     *
     * @return string
     */
    public function getBanner()
    {
        return $this->banner;
    }

    /**
     * Set the banner
     *
     * @param string $banner
     * @return Post
     */
    public function setBanner($banner)
    {
        $this->banner = $banner;
        return $this;
    }

    /**
     * Get the author
     *
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set the author
     *
     * @param User $author
     * @return Post
     */
    public function setAuthor(User $author = null)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * Get the tags
     *
     * @return ArrayCollection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add comments to the post
     *
     * @param Collection $comments
     * @return Post
     */
    public function addComments(Collection $comments)
    {
        /** @var Comment $comment */
        foreach ($comments as $comment) {
            $comment->setPost($this);
            $this->comments->add($comment);
        }
        return $this;
    }

    /**
     * Remove comments from the post
     *
     * @param Collection $comments
     * @return Post
     */
    public function removeComments(Collection $comments)
    {
        /** @var Comment $comment */
        foreach ($comments as $comment) {
            $comment->setPost(null);
            $this->comments->removeElement($comment);
        }
        return $this;
    }
}