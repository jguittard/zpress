<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Abstract class for taxonomies
 *
 * @package Blog\Entity
 *
 * @author Julien Guittard <julien.g@zend.com>
 * @version 1.0
 *
 * @ORM\Entity()
 * @ORM\Table(name="taxonomy")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 *     "category" = "Blog\Entity\Category",
 *     "tag" = "Blog\Entity\Tag",
 *     "posttype" = "Blog\Entity\PostType"
 * })
 */
abstract class AbstractTaxonomy implements EntityInterface
{
    use EntityTrait;

    /**
     * Taxonomy name
     *
     * @var string
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * Taxonomy slug
     *
     * @var string
     * @ORM\Column(length=255, unique=true)
     * @Gedmo\Slug(fields={"name"})
     */
    protected $slug;

    /**
     * Get the name
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the name
     *
     * @param mixed $name
     * @return AbstractTaxonomy
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

}