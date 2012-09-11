<?php

namespace Kunstmaan\AdminNodeBundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Kunstmaan\AdminBundle\Entity\AbstractEntity;
use Kunstmaan\AdminNodeBundle\Entity\NodeTranslation;
use Kunstmaan\AdminNodeBundle\Form\NodeAdminType;

/**
 * NodeVersion
 *
 * @ORM\Entity(repositoryClass="Kunstmaan\AdminNodeBundle\Repository\NodeVersionRepository")
 * @ORM\Table(name="nodeversion")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class NodeVersion extends AbstractEntity
{

    /**
     * @ORM\ManyToOne(targetEntity="NodeTranslation")
     * @ORM\JoinColumn(name="nodetranslation", referencedColumnName="id")
     */
    protected $nodeTranslation;

    /**
     * @ORM\Column(type="string")
     */
    protected $type;

    /**
     * @ORM\Column(type="bigint")
     */
    protected $version;

    /**
     * @ORM\Column(type="string")
     */
    protected $owner;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated;

    /**
     * @ORM\Column(type="bigint")
     */
    protected $refId;

    /**
     * @ORM\Column(type="string")
     */
    protected $refEntityname;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setCreated(new \DateTime());
        $this->setUpdated(new \DateTime());
    }

    /**
     * Set nodeTranslation
     *
     * @param NodeTranslation $nodeTranslation
     */
    public function setNodeTranslation($nodeTranslation)
    {
        $this->nodeTranslation = $nodeTranslation;
    }

    /**
     * Get NodeTranslation
     *
     * @return NodeTranslation
     */
    public function getNodeTranslation()
    {
        return $this->nodeTranslation;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set version
     *
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * Set owner
     *
     * @param string $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * Get owner
     *
     * @return string
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedValue()
    {
        $this->setUpdated(new \DateTime());
    }

    /**
     * Get refId
     *
     * @return int
     */
    public function getRefId()
    {
        return $this->refId;
    }

    /**
     * Set refId
     *
     * @param int $refId
     */
    public function setRefId($refId)
    {
        $this->refId = $refId;
    }

    /**
     * Set refEntityname
     *
     * @param string $refEntityname
     */
    public function setRefEntityname($refEntityname)
    {
        $this->refEntityname = $refEntityname;
    }

    /**
     * Get refEntityname
     *
     * @return string
     */
    public function getRefEntityname()
    {
        return $this->refEntityname;
    }

    /**
     * @param ContainerInterface $container
     *
     * @return NodeAdminType
     */
    public function getDefaultAdminType(ContainerInterface $container)
    {
        return new NodeAdminType($container);
    }

    /**
     * @param EntityManager $em
     *
     * @return object
     */
    public function getRef(EntityManager $em)
    {
        return $em->getRepository($this->getRefEntityname())->find($this->getRefId());
    }
}
