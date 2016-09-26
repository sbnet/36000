<?php
namespace Tests\SbnetCoreBundle\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Sbnet\CoreBundle\Entity;
use CrEOF\Spatial\PHP\Types\Geometry\Point;

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
        $point = new Point(-73.7562317, 42.6525793);

        $ent = new \Sbnet\CoreBundle\Entity\City();
        $ent->setCoordinates($point);
        $ent->setName("bigville");
        $ent->setStatus(0);
        $ent->setDepartmentCode(84);
        $ent->setCityCode(1);

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
