<?php

namespace Blog\Entity;

/**
 * Interface EntityAwareInterface
 *
 * @package Blog\Entity
 */
interface EntityAwareInterface
{
    /**
     * Get the entityClass
     *
     * @return string
     */
    public function getEntityClass();

    /**
     * Set the entityClass
     *
     * @param string $entityClass
     * @return EntityAwareTrait
     */
    public function setEntityClass($entityClass);
}