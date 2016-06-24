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
     * @ORM\Column(name="old_name", type="string", length=255, nullable=true)
     */
    private $oldName;

    /**
     * @ORM\Column(name="currency_code", type="string", length=255, nullable=true)
     */
    private $currencyCode;

    /**
     * @ORM\Column(name="currency_name", type="string", length=255, nullable=true)
     */
    private $currency;

    /**
     * @ORM\Column(name="phone_code", type="string", length=255, nullable=true)
     */
    private $phoneCode;

    /**
     * Satus
     * @see : http://www.insee.fr/fr/methodes/nomenclatures/cog/documentation.asp?page=telechargement/2016/doc/doc_variables.htm#actualp
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * French COG
     *
     * @ORM\Column(name="code", type="integer")
     */
    private $code;

    /**
     * Actual code of the referent country
     *
     * Note :
     *  If this field is empty, it mean that this country is expired ($status = 2) and was linked to many other countires in the past. 
     *  To find them, we just need to find the $actualReferenceCode of the country wich is prent in the $code of countries with $status = 1
     *
     *  Example :
     *  COREE : $code is 99237, $status is 2 and actualReferenceCode is empty. To find the refferal countries, 
     *          we need to search for 99237 inside the $code :
     *    - COREE (REPUBLIQUE POPULAIRE DEMOCRATIQUE DE )
     *      $code = 99238 $status = 1
     *    - COREE (REPUBLIQUE DE )
     *      $code = 99239 $status = 1
     *
     * @ORM\Column(name="actual_reference_code", type="integer", nullable=true)
     */
    private $actualReferenceCode;

    /**
     * Geographical code of an old referent country.
     *
     * @ORM\Column(name="old_reference_code", type="integer", nullable=true)
     */
    private $oldReferenceCode;

    /**
     * @ORM\Column(name="iso_code2", type="string", length=2)
     */
    private $isoCode2;

    /**
     * @ORM\Column(name="iso_code3", type="string", length=3)
     */
    private $isoCode3;

    /**
     * @ORM\Column(name="independance_year", type="integer", nullable=true)
     */
    private $independanceYear;

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

    /**
     * Set oldName
     *
     * @param string $oldName
     *
     * @return Country
     */
    public function setOldName($oldName)
    {
        $this->oldName = $oldName;

        return $this;
    }

    /**
     * Get oldName
     *
     * @return string
     */
    public function getOldName()
    {
        return $this->oldName;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Country
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
     * Set code
     *
     * @param integer $code
     *
     * @return Country
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

    /**
     * Set actualReferenceCode
     *
     * @param integer $actualReferenceCode
     *
     * @return Country
     */
    public function setActualReferenceCode($actualReferenceCode)
    {
        $this->actualReferenceCode = $actualReferenceCode;

        return $this;
    }

    /**
     * Get actualReferenceCode
     *
     * @return integer
     */
    public function getActualReferenceCode()
    {
        return $this->actualReferenceCode;
    }

    /**
     * Set oldReferenceCode
     *
     * @param integer $oldReferenceCode
     *
     * @return Country
     */
    public function setOldReferenceCode($oldReferenceCode)
    {
        $this->oldReferenceCode = $oldReferenceCode;

        return $this;
    }

    /**
     * Get oldReferenceCode
     *
     * @return integer
     */
    public function getOldReferenceCode()
    {
        return $this->oldReferenceCode;
    }

    /**
     * Set isoCode2
     *
     * @param string $isoCode2
     *
     * @return Country
     */
    public function setIsoCode2($isoCode2)
    {
        $this->isoCode2 = $isoCode2;

        return $this;
    }

    /**
     * Get isoCode2
     *
     * @return string
     */
    public function getIsoCode2()
    {
        return $this->isoCode2;
    }

    /**
     * Set isoCode3
     *
     * @param string $isoCode3
     *
     * @return Country
     */
    public function setIsoCode3($isoCode3)
    {
        $this->isoCode3 = $isoCode3;

        return $this;
    }

    /**
     * Get isoCode3
     *
     * @return string
     */
    public function getIsoCode3()
    {
        return $this->isoCode3;
    }

    /**
     * Set codeNum3
     *
     * @param string $codeNum3
     *
     * @return Country
     */
    public function setCodeNum3($codeNum3)
    {
        $this->codeNum3 = $codeNum3;

        return $this;
    }

    /**
     * Get codeNum3
     *
     * @return string
     */
    public function getCodeNum3()
    {
        return $this->codeNum3;
    }

    /**
     * Set independanceYear
     *
     * @param integer $independanceYear
     *
     * @return Country
     */
    public function setIndependanceYear($independanceYear)
    {
        $this->independanceYear = $independanceYear;

        return $this;
    }

    /**
     * Get independanceYear
     *
     * @return integer
     */
    public function getIndependanceYear()
    {
        return $this->independanceYear;
    }
}
