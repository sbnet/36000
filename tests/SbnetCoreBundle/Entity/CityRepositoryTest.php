<?php
namespace Tests\SbnetCoreBundle\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CityRepositoryTest extends KernelTestCase
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

    public function testFindOneByInseeCode()
    {
        $city = $this->em
            ->getRepository('SbnetCoreBundle:City')
            ->findOneByInseeCode("84036")
        ;

        // $this->assertEquals("Châteauneuf-de-Gadagne", $city->getName());
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
