<?php

namespace Blog\Entity;

/**
 * Class EntityAwareTrait
 *
 * @package Blog\Entity
 */
trait EntityAwareTrait
{
    /**
     * @var string
     */
    protected $entityClass;

    /**
     * Get the entityClass
     *
     * @return string
     */
    public function getEntityClass()
    {
        return $this->entityClass;
    }

    /**
     * Set the entityClass
     *
     * @param string $entityClass
     * @return EntityAwareTrait
     */
    public function setEntityClass($entityClass)
    {
        $this->entityClass = $entityClass;
        return $this;
    }
}