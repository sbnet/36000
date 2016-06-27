<?php
namespace Tests\SbnetCoreBundle\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CountryRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testFindByIsoCode3()
    {
        $countries = $this->em
            ->getRepository('SbnetCoreBundle:Country')
            ->findByIsoCode3('FRA')
        ;

        $this->assertCount(1, $countries);
        $this->assertEquals("FRA", $countries[0]->getIsoCode3());
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null; // avoid memory leaks
    }
}