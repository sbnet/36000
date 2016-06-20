<?php
namespace Sbnet\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Region
 *
 * @ORM\Table(name="region")
 * @ORM\Entity(repositoryClass="Sbnet\CoreBundle\Repository\RegionRepository")
 */
class Region
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     * @ORM\Column(name="search", type="string", length=255)
     */
    private $search;

    /**
     * @ORM\Column(name="emblem_url", type="string", length=255, nullable=true)
     *
     * Coat of arms
     */
    private $emblemUrl;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Region
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set emblemUrl
     *
     * @param string $emblemUrl
     *
     * @return Region
     */
    public function setEmblemUrl($emblemUrl)
    {
        $this->emblemUrl = $emblemUrl;

        return $this;
    }

    /**
     * Get emblemUrl
     *
     * @return string
     */
    public function getEmblemUrl()
    {
        return $this->emblemUrl;
    }

    /**
     * Set search
     *
     * @param string $search
     *
     * @return Region
     */
    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    /**
     * Get search
     *
     * @return string
     */
    public function getSearch()
    {
        return $this->search;
    }
}
