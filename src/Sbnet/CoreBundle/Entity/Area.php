<?php
namespace Sbnet\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Area - French departement
 *
 * @ORM\Table(name="area")
 * @ORM\Entity(repositoryClass="Sbnet\CoreBundle\Repository\AreaRepository")
 */
class Area
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
     * @ORM\Column(name="formal_name", type="string", length=255)
     */
    private $formalName;

    /**
     * @ORM\Column(name="search", type="string", length=255, nullable=true)
     */
    private $search;

    /**
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(name="surface", type="integer", nullable=true)
     */
    private $surface;

    /**
     * @ORM\Column(name="density", type="integer", nullable=true)
     */
    private $density;

    /**
     * @ORM\Column(name="population", type="integer", nullable=true)
     */
    private $population;

    /**
     * @ORM\ManyToOne(targetEntity="Sbnet\CoreBundle\Entity\Region")
     * @ORM\JoinColumn(nullable=false)
     */
    private $region;

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
     * @return Area
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
     * Set search
     *
     * @param string $search
     *
     * @return Area
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

    /**
     * Set number
     *
     * @param string $number
     *
     * @return Area
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set surface
     *
     * @param integer $surface
     *
     * @return Area
     */
    public function setSurface($surface)
    {
        $this->surface = $surface;

        return $this;
    }

    /**
     * Get surface
     *
     * @return integer
     */
    public function getSurface()
    {
        return $this->surface;
    }

    /**
     * Set density
     *
     * @param integer $density
     *
     * @return Area
     */
    public function setDensity($density)
    {
        $this->density = $density;

        return $this;
    }

    /**
     * Get density
     *
     * @return integer
     */
    public function getDensity()
    {
        return $this->density;
    }

    /**
     * Set population
     *
     * @param integer $population
     *
     * @return Area
     */
    public function setPopulation($population)
    {
        $this->population = $population;

        return $this;
    }

    /**
     * Get population
     *
     * @return integer
     */
    public function getPopulation()
    {
        return $this->population;
    }

    /**
     * Set oid
     *
     * @param string $oid
     *
     * @return Area
     */
    public function setOid($oid)
    {
        $this->oid = $oid;

        return $this;
    }

    /**
     * Get oid
     *
     * @return string
     */
    public function getOid()
    {
        return $this->oid;
    }

    /**
     * Set region
     *
     * @param \Sbnet\CoreBundle\Entity\Region $region
     *
     * @return Area
     */
    public function setRegion(\Sbnet\CoreBundle\Entity\Region $region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return \Sbnet\CoreBundle\Entity\Region
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set formalName
     *
     * @param string $formalName
     *
     * @return Area
     */
    public function setFormalName($formalName)
    {
        $this->formalName = $formalName;

        return $this;
    }

    /**
     * Get formalName
     *
     * @return string
     */
    public function getFormalName()
    {
        return $this->formalName;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Area
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
}
