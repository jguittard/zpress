<?php

namespace Blog\Mapper;

use Application\Doctrine\Mapper\DoctrineMapper;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class AbstractFactory
 *
 * @package Blog\Mapper
 *
 * @author Julien Guittard <julien.g@zend.com>
 * @version 1.0
 */
class AbstractFactory implements AbstractFactoryInterface
{
    /**
     * Determine if we can create a service with name
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param $name
     * @param $requestedName
     * @return bool
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        /*if (strpos($requestedName, 'blog') === 0) {
            $classParts = explode('.', $requestedName);

            $className = array_reduce($classParts, function (&$result, $val) {
                return $result .= '\\' . ucfirst($val);
            });
            var_dump();exit;
        }*/
        $classParts = explode('.', $requestedName);

        $className = array_reduce($classParts, function (&$result, $val) {
            return $result .= '\\' . ucfirst($val);
        });

        return strpos($className, __NAMESPACE__) === 1;
    }

    /**
     * Create service with name
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param $name
     * @param $requestedName
     * @return mixed
     */
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $classParts = explode('.', $requestedName);

        $className = array_reduce($classParts, function (&$result, $val) {
            return $result .= '\\' . ucfirst($val);
        });

        $entityClass = str_replace('Mapper', 'Entity', $className);

        /** @var \Doctrine\ORM\EntityManager $entityManager */
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $mapper = new DoctrineMapper();
        $mapper->setEntityManager($entityManager);
        $mapper->setEntityRepository($entityManager->getRepository($entityClass));
        return $mapper;
    }

}