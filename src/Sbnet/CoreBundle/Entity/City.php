<?php
namespace Sbnet\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;
use CrEOF\Spatial\PHP\Types\Geometry\Point;

/**
 * City
 *
 * @ORM\Table(name="city", indexes={
 *  @ORM\Index(name="search_idx", columns={"search"}),
 *  @ORM\Index(name="postcode_idx", columns={"post_code"})
*  })
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sbnet\CoreBundle\Repository\CityRepository")
 */
class City
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
     * @ORM\Column(name="prefix", type="string", length=255, nullable=true)
     */
    private $prefix;

    /**
     * @ORM\Column(name="search", type="string", length=255, nullable=true)
     */
    private $search;

    /**
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @ORM\Column(name="population", type="integer", nullable=true)
     */
    private $population;

    /**
     * @ORM\Column(name="department_code", type="string", length=255)
     */
    private $departmentCode;

    /**
     * @ORM\Column(name="city_code", type="string", length=255)
     */
    private $cityCode;

    /**
     * @ORM\Column(name="post_code", type="string", length=255, nullable=true)
     */
    private $postCode;

    /**
     * @ORM\Column(name="coordinates", type="point", nullable=true)
     */
    private $coordinates;

    /**
     * @ORM\Column(name="gentile", type="string", length=255, nullable=true)
     */
    private $gentile;

    /**
     * @ORM\Column(name="cityhall_web", type="string", length=255, nullable=true)
     */
    private $cityhallWeb;

    /**
     * @ORM\Column(name="cityhall_phone", type="string", length=255, nullable=true)
     */
    private $cityhallPhone;

    /**
     * @ORM\Column(name="mayor", type="string", length=255, nullable=true)
     */
    private $mayor;

    /**
     * @ORM\ManyToOne(targetEntity="Sbnet\CoreBundle\Entity\Area")
     * @ORM\JoinColumn(nullable=false)
     */
    private $area;

    /**
     * Get Insee code
     *
     * @return string
     */
    public function getInseeCode()
    {
        return "{$this->departmentCode}{$this->cityCode}";
    }

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
     * @return City
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
     * Set prefix
     *
     * @param string $prefix
     *
     * @return City
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Set search
     *
     * @param string $search
     *
     * @return City
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
     * Set status
     *
     * @param integer $status
     *
     * @return City
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set departmentCode
     *
     * @param string $departmentCode
     *
     * @return City
     */
    public function setDepartmentCode($departmentCode)
    {
        $this->departmentCode = $departmentCode;

        return $this;
    }

    /**
     * Get departmentCode
     *
     * @return string
     */
    public function getDepartmentCode()
    {
        return $this->departmentCode;
    }

    /**
     * Set cityCode
     *
     * @param string $cityCode
     *
     * @return City
     */
    public function setCityCode($cityCode)
    {
        $this->cityCode = $cityCode;

        return $this;
    }

    /**
     * Get cityCode
     *
     * @return string
     */
    public function getCityCode()
    {
        return $this->cityCode;
    }

    /**
     * Set area
     *
     * @param \Sbnet\CoreBundle\Entity\Area $area
     *
     * @return City
     */
    public function setArea(\Sbnet\CoreBundle\Entity\Area $area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return \Sbnet\CoreBundle\Entity\Area
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set coordinates
     *
     * @param point $coordinates
     *
     * @return City
     */
    public function setCoordinates(Point $coordinates)
    {
        $this->coordinates = $coordinates;

        return $this;
    }

    /**
     * Get coordinates
     *
     * @return point
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * Set population
     *
     * @param integer $population
     *
     * @return City
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
     * Set postCode
     *
     * @param string $postCode
     *
     * @return City
     */
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;

        return $this;
    }

    /**
     * Get postCode
     *
     * @return string
     */
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     * Set gentile
     *
     * @param string $gentile
     *
     * @return City
     */
    public function setGentile($gentile)
    {
        $this->gentile = $gentile;

        return $this;
    }

    /**
     * Get gentile
     *
     * @return string
     */
    public function getGentile()
    {
        return $this->gentile;
    }

    /**
     * Set cityhallWeb
     *
     * @param string $cityhallWeb
     *
     * @return City
     */
    public function setCityhallWeb($cityhallWeb)
    {
        $this->cityhallWeb = $cityhallWeb;

        return $this;
    }

    /**
     * Get cityhallWeb
     *
     * @return string
     */
    public function getCityhallWeb()
    {
        return $this->cityhallWeb;
    }

    /**
     * Set cityhallPhone
     *
     * @param string $cityhallPhone
     *
     * @return City
     */
    public function setCityhallPhone($cityhallPhone)
    {
        $this->cityhallPhone = $cityhallPhone;

        return $this;
    }

    /**
     * Get cityhallPhone
     *
     * @return string
     */
    public function getCityhallPhone()
    {
        return $this->cityhallPhone;
    }

    /**
     * Set mayor
     *
     * @param string $mayor
     *
     * @return City
     */
    public function setMayor($mayor)
    {
        $this->mayor = $mayor;

        return $this;
    }

    /**
     * Get mayor
     *
     * @return string
     */
    public function getMayor()
    {
        return $this->mayor;
    }
}
