<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class Comment
 *
 * @package Blog\Entity
 *
 * @author Julien Guittard <julien.g@zend.com>
 * @version 1.0
 *
 * @ORM\Entity
 * @ORM\Table(name="comment")
 */
class Comment implements EntityInterface
{
    use EntityTrait;

    /**
     * @var string
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    protected $content;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    protected $validated = false;

    /**
     * Parent comment
     *
     * @var Comment
     * @ORM\OneToOne(targetEntity="Blog\Entity\Comment")
     */
    protected $parent;

    /**
     * Username of the user who wrote this comment
     *
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $username;

    /**
     * Email of the user who wrote this comment
     *
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $email;

    /**
     * Website of the user who wrote this comment
     *
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $website;

    /**
     * @var Post
     * @ORM\ManyToOne(targetEntity="Blog\Entity\Post", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $post;

    /**
     * Get the content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the content
     *
     * @param string $content
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get the validated
     *
     * @return boolean
     */
    public function isValidated()
    {
        return $this->validated;
    }

    /**
     * Set the validated
     *
     * @param boolean $validated
     * @return Comment
     */
    public function setValidated($validated)
    {
        $this->validated = $validated;
        return $this;
    }

    /**
     * Get the parent
     *
     * @return Comment
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set the parent
     *
     * @param Comment $parent
     * @return Comment
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get the username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the username
     *
     * @param string $username
     * @return Comment
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get the email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the email
     *
     * @param string $email
     * @return Comment
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get the website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set the website
     *
     * @param string $website
     * @return Comment
     */
    public function setWebsite($website)
    {
        $this->website = $website;
        return $this;
    }

    /**
     * Get the post
     *
     * @return Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set the post
     *
     * @param Post $post
     * @return Comment
     */
    public function setPost(Post $post = null)
    {
        $this->post = $post;
        return $this;
    }
}