<?php

namespace Blog\Service;

use \Traversable;
use Application\Doctrine\Mapper\DoctrineMapperInterface;
use Blog\Entity\EntityAwareInterface;
use Blog\Entity\EntityAwareTrait;
use DoctrineModule\Stdlib\Hydrator;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\Stdlib\Hydrator\HydratorAwareInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

/**
 * Class AbstractResourceService
 *
 * @package Blog\Service
 *
 * @author Julien Guittard <julien.g@zend.com>
 * @version 1.0
 */
class AbstractResourceService implements EventManagerAwareInterface, HydratorAwareInterface, EntityAwareInterface
{
    use EntityAwareTrait;

    /**
     * @var DoctrineMapperInterface
     */
    protected $mapper;

    /**
     * @var EventManagerInterface
     */
    protected $events;

    /**
     * @var HydratorInterface
     */
    protected $hydrator;

    /**
     * Inject an EventManager instance
     *
     * @param  EventManagerInterface $events
     * @return AbstractResourceService
     */
    public function setEventManager(EventManagerInterface $events)
    {
        $identifiers = array(__CLASS__, get_class($this));
        if (isset($this->eventIdentifier)) {
            if ((is_string($this->eventIdentifier))
                || (is_array($this->eventIdentifier))
                || ($this->eventIdentifier instanceof Traversable)
            ) {
                $identifiers = array_unique(array_merge($identifiers, (array) $this->eventIdentifier));
            } elseif (is_object($this->eventIdentifier)) {
                $identifiers[] = $this->eventIdentifier;
            }
            // silently ignore invalid eventIdentifier types
        }
        $events->setIdentifiers($identifiers);
        $this->events = $events;
        if (method_exists($this, 'attachDefaultListeners')) {
            $this->attachDefaultListeners();
        }
        return $this;
    }

    /**
     * Retrieve the event manager
     *
     * Lazy-loads an EventManager instance if none registered.
     *
     * @return EventManagerInterface
     */
    public function getEventManager()
    {
        if (!$this->events instanceof EventManagerInterface) {
            $this->setEventManager(new EventManager());
        }
        return $this->events;
    }

    /**
     * Get the hydrator
     *
     * @return HydratorInterface
     */
    public function getHydrator()
    {
        if (!$this->hydrator) {
            $this->hydrator = new Hydrator\DoctrineObject($this->mapper->getEntityManager(), $this->getEntityClass());
        }

        return $this->hydrator;
    }

    /**
     * Set the hydrator
     *
     * @param HydratorInterface $hydrator
     * @return AbstractResourceService
     */
    public function setHydrator(HydratorInterface $hydrator)
    {
        $this->hydrator = $hydrator;
        return $this;
    }

    /**
     * Post constructor.
     * @param DoctrineMapperInterface $mapper
     */
    public function __construct(DoctrineMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @param mixed $data
     * @return mixed
     */
    public function create($data)
    {
        $entityClass = $this->getEntityClass();
        $entity = new $entityClass;
        $hydrator = $this->getHydrator();
        $hydrator->hydrate((array) $data, $entity);

        $entity = $this->mapper->store($entity);
        $this->mapper->getEntityManager()->flush();

        return $entity;
    }

    /**
     * @param mixed $id
     * @return mixed
     */
    public function delete($id)
    {
        $entity = $this->mapper->fetchOne($id);
        if (!$entity) {
            return false;
        }
        $this->mapper->delete($id);
        $this->mapper->getEntityManager()->flush();
        return true;
    }
}