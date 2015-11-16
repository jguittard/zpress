<?php

namespace Application\Doctrine\Mapper;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class DoctrineMapper
 *
 * @package Application\Doctrine\Mapper
 */
class DoctrineMapper implements DoctrineMapperInterface
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var EntityRepository
     */
    protected $entityRepository;

    /**
     * Get the entityManager
     *
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Set the entityManager
     *
     * @param EntityManager $entityManager
     * @return DoctrineMapper
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

    /**
     * Get the entityRepository
     *
     * @return EntityRepository
     */
    public function getEntityRepository()
    {
        return $this->entityRepository;
    }

    /**
     * Set the entityRepository
     *
     * @param EntityRepository $entityRepository
     * @return DoctrineMapper
     */
    public function setEntityRepository(EntityRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
        return $this;
    }

    /**
     * @param array|\Traversable|\stdClass $entity
     * @return mixed
     */
    public function store($entity)
    {
        $this->getEntityManager()->persist($entity);
        return $entity;
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function fetchOne($id)
    {
        return $this->getEntityRepository()->find($id);
    }

    /**
     * @return mixed
     */
    public function fetchAll($params = array())
    {
        if (empty($params)) {
            return $this->getEntityRepository()->findAll();
        } else {
            return $this->getEntityRepository()->findBy($params);
        }
    }

    /**
     * @param $field
     * @param $value
     * @return mixed
     */
    public function fetchBy($field, $value)
    {
        $result = $this->getEntityRepository()->findBy([$field => $value], null, 1);
        return $result[0];
    }

    /**
     * @param string $id
     * @return bool
     */
    public function delete($id)
    {
        $entity = $this->fetchOne($id);
        if (!$entity) {
            return false;
        }
        $this->getEntityManager()->remove($entity);
        return true;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function getCollectionQueryBuilder($entityClass , $params = array())
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $eb = $queryBuilder->expr();
        $queryBuilder->select('row')
            ->from($entityClass, 'row');

        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $queryBuilder->andWhere($eb->eq('row.' . $key, ':' . $key))->setParameter($key, $value);
            }
        }

        return $queryBuilder;
    }
}