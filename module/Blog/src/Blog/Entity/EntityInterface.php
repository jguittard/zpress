<?php

namespace Blog\Entity;

/**
 * Interface EntityInterface
 *
 * @package Blog\Entity
 */
interface EntityInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @param string $id
     * @return EntityTrait
     */
    public function setId($id);
}