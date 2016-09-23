<?php
namespace Tests\SbnetCoreBundle\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Sbnet\CoreBundle\Entity;

class CityTest extends KernelTestCase
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

    public function testSpatial()
    {
        $ent = new \Sbnet\CoreBundle\Entity\City();
        $point = new \Sbnet\CoreBundle\ORM\Point(10, 20.5);

        $ent->setCoordinates($point);

        $this->em->persist($ent);
        $this->em->flush();

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
