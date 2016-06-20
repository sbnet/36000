<?php
namespace Sbnet\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @ORM\Table(name="country")
 * @ORM\Entity(repositoryClass="Sbnet\CoreBundle\Repository\CountryRepository")
 */
class Country
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
     * @ORM\Column(name="currency_code", type="string", length=255)
     */
    private $currencyCode;

    /**
     * @ORM\Column(name="currency_name", type="string", length=255)
     */
    private $currency;

    /**
     * @ORM\Column(name="phone_code", type="string", length=255)
     */
    private $phoneCode;

    /**
     * @ORM\Column(name="code2", type="string", length=2)
     */
    private $code2;

    /**
     * @ORM\Column(name="code3", type="string", length=3)
     */
    private $code3;

    /**
     * Get id
     *
     * @return int
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
     * @return Country
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
     * Set formalName
     *
     * @param string $formalName
     *
     * @return Country
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
     * Set currencyCode
     *
     * @param string $currencyCode
     *
     * @return Country
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    /**
     * Get currencyCode
     *
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * Set currency
     *
     * @param string $currency
     *
     * @return Country
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set phoneCode
     *
     * @param string $phoneCode
     *
     * @return Country
     */
    public function setPhoneCode($phoneCode)
    {
        $this->phoneCode = $phoneCode;

        return $this;
    }

    /**
     * Get phoneCode
     *
     * @return string
     */
    public function getPhoneCode()
    {
        return $this->phoneCode;
    }

    /**
     * Set code2
     *
     * @param string $code2
     *
     * @return Country
     */
    public function setCode2($code2)
    {
        $this->code2 = $code2;

        return $this;
    }

    /**
     * Get code2
     *
     * @return string
     */
    public function getCode2()
    {
        return $this->code2;
    }

    /**
     * Set code3
     *
     * @param string $code3
     *
     * @return Country
     */
    public function setCode3($code3)
    {
        $this->code3 = $code3;

        return $this;
    }

    /**
     * Get code3
     *
     * @return string
     */
    public function getCode3()
    {
        return $this->code3;
    }
}
