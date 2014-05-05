<?php
namespace Sitemap\Entity;

use Doctrine\Common\Collections\ArrayCollection,
    Doctrine\Common\Collections\Collection,
    Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="sitemap_pages")
 */

class Page
{
    /**
     * @var int|null
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string The entity the indexed item belongs to
     * @ORM\Column(type="string")
     * */
    protected $entity;

    /**
     * @var integer The entity ID
     * @ORM\Column(type="integer")
     * */
    protected $entity_id;

    /**
     * @var string the route of the entity
     * @ORM\Column(type="string")
     * */
    protected $route;

    /**
     * @var string the field to reference when building the url
     * @ORM\Column(type="string")
     * */
    protected $slug_field;

    /**
     * @var string the slug of the indexed item
     * @ORM\Column(type="string")
     * */
    protected $slug;

    /**
     * @var boolean whether or not to exclude this entry
     * @ORM\Column(type="boolean")
     * */
    protected $visible;

    /**
     * @var string the updated timestamp of the item
     * @ORM\Column(type="string")
     * */
    protected $modified;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime",nullable=true)
     */
    protected $created;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime",nullable=true)
     */
    protected $updated;
    
    public function __construct(){}


    /**
     * Getters and Setters
     * */

    /**
     * Gets the value of id.
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param int|null $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of entity.
     *
     * @return mixed
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Sets the value of entity.
     *
     * @param mixed $entity the entity
     *
     * @return self
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * Gets the value of entity_id.
     *
     * @return mixed
     */
    public function getEntity_id()
    {
        return $this->entity_id;
    }

    /**
     * Sets the value of entity_id.
     *
     * @param mixed $entity_id the entity_id
     *
     * @return self
     */
    public function setEntity_id($entity_id)
    {
        $this->entity_id = $entity_id;

        return $this;
    }

    /**
     * Gets the value of route.
     *
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Sets the value of route.
     *
     * @param mixed $route the route
     *
     * @return self
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Gets the value of slug_field.
     *
     * @return mixed
     */
    public function getSlug_field()
    {
        return $this->slug_field;
    }

    /**
     * Sets the value of slug_field.
     *
     * @param mixed $slug_field the slug_field
     *
     * @return self
     */
    public function setSlug_field($slug_field)
    {
        $this->slug_field = $slug_field;

        return $this;
    }

    /**
     * Gets the value of slug.
     *
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Sets the value of slug.
     *
     * @param mixed $slug the slug
     *
     * @return self
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Gets the value of modified.
     *
     * @return mixed
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Sets the value of modified.
     *
     * @param mixed $modified the modified
     *
     * @return self
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Gets the value of created.
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Sets the value of created.
     *
     * @param \DateTime $created the created
     *
     * @return self
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Gets the value of updated.
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Sets the value of updated.
     *
     * @param \DateTime $updated the updated
     *
     * @return self
     */
    public function setUpdated(\DateTime $updated)
    {
        $this->updated = $updated;

        return $this;
    }
}