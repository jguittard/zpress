<?php

namespace Application\Doctrine\Mapper;

/**
 * Interface MapperInterface
 *
 * @package Application\Doctrine\Mapper
 */
interface MapperInterface
{
    /**
     * @param mixed $entity
     * @return mixed
     */
    public function store($entity);

    /**
     * @param mixed $id
     * @return mixed
     */
    public function fetchOne($id);

    /**
     * @param $field
     * @param $value
     * @return mixed
     */
    public function fetchBy($field, $value);

    /**
     * @param array $params
     * @return mixed
     */
    public function fetchAll($params = array());

    /**
     * @param mixed $id
     * @return bool
     */
    public function delete($id);
}