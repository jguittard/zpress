<?php

namespace Blog\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class User
 *
 * @package Blog\Entity
 *
 * @author Julien Guittard <julien.g@zend.com>
 * @version 1.0
 *
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User implements EntityInterface
{
    use EntityTrait;

    /**
     * First name of the user.
     *
     * @var string
     * @ORM\Column(name="first_name", type="string", length=255, nullable=true)
     */
    protected $firstName;

    /**
     * Last name of the customer.
     *
     * @var string
     * @ORM\Column(name="last_name", type="string", length=255, nullable=true)
     */
    protected $lastName;

    /**
     * @var string
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    protected $username;

    /**
     * User's email
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false, options={"unique"=true})
     * @var string
     */
    protected $email;

    /**
     * User's password
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     * @var string
     */
    protected $password;

    /**
     * User's role
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     * @var string
     */
    protected $role;

    /**
     * User's avatar
     *
     * @ORM\Column(name="avatar", type="string", length=255, nullable=true)
     * @var string
     */
    protected $avatar;

    /**
     * User's website URL.
     *
     * @ORM\Column(name="website", type="string", length=255, nullable=true)
     * @var string
     */
    protected $website;

    /**
     * User's bio
     *
     * @ORM\Column(name="bio", type="text", nullable=true)
     * @var string
     */
    protected $bio;

    /**
     * User's Facebook account
     *
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true)
     * @var string
     */
    protected $facebook;

    /**
     * User's Twitter account
     *
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
     * @var string
     */
    protected $twitter;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Blog\Entity\Post", mappedBy="author")
     */
    protected $posts;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * Get the firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * Get the lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
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
     * @return User
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
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get the password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get the role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the role
     *
     * @param string $role
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * Get the avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set the avatar
     *
     * @param string $avatar
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
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
     * @return User
     */
    public function setWebsite($website)
    {
        $this->website = $website;
        return $this;
    }

    /**
     * Get the bio
     *
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set the bio
     *
     * @param string $bio
     * @return User
     */
    public function setBio($bio)
    {
        $this->bio = $bio;
        return $this;
    }

    /**
     * Get the facebook
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set the facebook
     *
     * @param string $facebook
     * @return User
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;
        return $this;
    }

    /**
     * Get the twitter
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set the twitter
     *
     * @param string $twitter
     * @return User
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
        return $this;
    }

    /**
     * Add related posts
     *
     * @param Collection $posts
     * @return User
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
     * @return User
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