<?php

namespace Application\Doctrine\Mapper;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Interface DoctrineMapperInterface
 *
 * @package Application\Doctrine\Mapper
 */
interface DoctrineMapperInterface extends MapperInterface
{
    /**
     * Get the entityManager
     *
     * @return EntityManager
     */
    public function getEntityManager();

    /**
     * Get the entityRepository
     *
     * @return EntityRepository
     */
    public function getEntityRepository();
}