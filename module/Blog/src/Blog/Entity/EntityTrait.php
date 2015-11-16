<?php

namespace Blog\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class EntityTrait
 *
 * @package Blog\Entity
 */
trait EntityTrait
{
    /**
     * Primary identifier
     *
     * @ORM\Id
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="UUID")
     * @var string
     */
    protected $id;

    /**
     * @var DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_time", type="datetime", nullable=false)
     */
    protected $createdTime;

    /**
     * @var DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_time", type="datetime", nullable=false)
     */
    protected $updatedTime;

    /**
     * Get the id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the id
     *
     * @param string $id
     * @return EntityTrait
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the createdTime
     *
     * @return DateTime
     */
    public function getCreatedTime()
    {
        return $this->createdTime;
    }

    /**
     * Set the createdTime
     *
     * @param DateTime $createdTime
     * @return EntityTrait
     */
    public function setCreatedTime(DateTime $createdTime = null)
    {
        $this->createdTime = $createdTime;
        return $this;
    }

    /**
     * Get the updatedTime
     *
     * @return DateTime
     */
    public function getUpdatedTime()
    {
        return $this->updatedTime;
    }

    /**
     * Set the updatedTime
     *
     * @param DateTime $updatedTime
     * @return EntityTrait
     */
    public function setUpdatedTime(DateTime $updatedTime = null)
    {
        $this->updatedTime = $updatedTime;
        return $this;
    }

}