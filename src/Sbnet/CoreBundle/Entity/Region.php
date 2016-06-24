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
     * @ORM\Column(name="code", type="integer")
     */
    private $code;

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
     * @ORM\Column(name="emblem_url", type="string", length=255, nullable=true)
     *
     * Coat of arms
     */
    private $emblemUrl;

    /**
     * Has one -> city
     *
     * @ORM\OneToOne(targetEntity="Sbnet\CoreBundle\Entity\City")
     * @ORM\JoinColumn(nullable=true)          
     */
    private $cheflieu;

    /**
     * Many regions to one country
     *
     * @ORM\ManyToOne(targetEntity="Sbnet\CoreBundle\Entity\Country")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

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

    /**
     * Set oid
     *
     * @param string $oid
     *
     * @return Region
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
     * Set cheflieu
     *
     * @param \Sbnet\CoreBundle\Entity\City $cheflieu
     *
     * @return Region
     */
    public function setCheflieu(\Sbnet\CoreBundle\Entity\City $cheflieu = null)
    {
        $this->cheflieu = $cheflieu;

        return $this;
    }

    /**
     * Get cheflieu
     *
     * @return \Sbnet\CoreBundle\Entity\City
     */
    public function getCheflieu()
    {
        return $this->cheflieu;
    }

    /**
     * Set country
     *
     * @param \Sbnet\CoreBundle\Entity\Country $country
     *
     * @return Region
     */
    public function setCountry(\Sbnet\CoreBundle\Entity\Country $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Sbnet\CoreBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set formalName
     *
     * @param string $formalName
     *
     * @return Region
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
     * @param integer $code
     *
     * @return Region
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return integer
     */
    public function getCode()
    {
        return $this->code;
    }
}
