<?php
namespace Sbnet\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Sbnet\CoreBundle\Entity\City;
use CrEOF\Spatial\PHP\Types\Geometry\Point;

class LoadCity implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
  /**
   * @var ContainerInterface
   */
  private $container;
  private $logger;

  public function setContainer(ContainerInterface $container = null)
  {
      $this->container = $container;
  }

  public function getOrder()
  {
    // the order in which fixtures will be loaded
    // the lower the number, the sooner that this fixture is loaded
    return 40;
  }

  public function load(ObjectManager $manager)
  {
    $this->logger = $this->container->get('logger');
    $this->addStoredProcedure($manager);
    $this->loadCities($manager);
    $this->updateFromMongo($manager);
    $this->loadExceptions($manager);
  }

  private function addStoredProcedure(ObjectManager $manager)
  {
    $sql = "CREATE FUNCTION `distance`(`a` POINT, `b` POINT) RETURNS DOUBLE DETERMINISTIC return round(glength(linestringfromwkb(linestring(asbinary(a), asbinary(b)))))";

    $conn = $manager->getConnection();
    $sth = $conn->prepare($sql);
    $sth->execute();
  }

  private function loadExceptions(ObjectManager $manager)
  {
    $file = $this->container->getParameter('kernel.root_dir').'/../data/cities-exceptions.sql';

    if (!file_exists($file)) {
        throw new \Exception("Data file ($file) is not present !");
    }

    $sql = file_get_contents($file);

    $conn = $manager->getConnection();
    $sth = $conn->prepare($sql);
    $sth->execute();
  }

  private function loadCities(ObjectManager $manager)
  {
    $batchSize = 20;
    $i = 1;

    $file = $this->container->getParameter('kernel.root_dir').'/../data/communes-2016.csv';

    if (!file_exists($file)) {
      throw new \Exception("Data file ($file) is not present !");
    }

    $handle = fopen($file, "r");

    if (!$handle) {
      throw new \Exception("Can't read the file !");
    }

    // By default logging of the SQL connection is set to the value of kernel.debug,
    // so if you have instantiated AppKernel with debug set to true the SQL commands
    // get stored in memory for each iteration.
    // http://stackoverflow.com/questions/9699185/memory-leaks-symfony2-doctrine2-exceed-memory-limit
    $manager->getConnection()->getConfiguration()->setSQLLogger(null);

    // Skip the first line
    $data = fgetcsv($handle, 0, "\t");

    // Read the file, line by line
    while (FALSE !== ($data = fgetcsv($handle, 0, "\t"))) {
      if (!empty($data[4])) {

        // Get the corresponding area
        $area = $manager
                  ->getRepository('SbnetCoreBundle:Area')
                  ->findOneByCode($data[5]);

        $obj = new City;
        $obj->setStatus($data[0]);
        $obj->setCityCode($data[6]);
        $obj->setDepartmentCode($data[5]);
        $obj->setName($data[15]);

        if (!empty($data[14])) {
          $obj->setPrefix(str_replace(array("(", ")"), "", $data[14]));
        }

        $obj->setArea($area);
        $manager->persist($obj);

        // Load the database in batch
        if (($i % $batchSize) === 0) {
          $manager->flush();
          $manager->clear();
        }

        $i++;
      }
    }

    $manager->flush();
    $manager->clear();
    fclose($handle);
  }

  private function updateFromMongo(ObjectManager $manager)
  {
    $batchSize = 20;
    $i = 1;

    $file = $this->container->getParameter('kernel.root_dir').'/../data/mongo/villes.json';

    if (!file_exists($file)) {
      throw new \Exception("Data file ($file) is not present !");
    }

    $handle = fopen($file, "r");

    if (!$handle) {
      throw new \Exception("Can't read the file !");
    }

    // By default logging of the SQL connection is set to the value of kernel.debug,
    // so if you have instantiated AppKernel with debug set to true the SQL commands
    // get stored in memory for each iteration.
    // http://stackoverflow.com/questions/9699185/memory-leaks-symfony2-doctrine2-exceed-memory-limit
    $manager->getConnection()->getConfiguration()->setSQLLogger(null);

    // Read the json file, line by line
    while (FALSE !== ($data = fgets($handle))) {
      $obj = json_decode($data);

      // Get the corresponding city
      $city = $manager
              ->getRepository('SbnetCoreBundle:City')
              ->findOneByInseeCode($obj->insee);

      if ($city) {
        $city->setCoordinates(new Point($obj->geo->lon, $obj->geo->lat));
        $city->setPostCode($obj->code_postal);
        $city->setSearch($obj->search);
        $city->setPopulation($obj->population);

        if(property_exists($obj, 'gentile'))
            $city->setGentile($obj->gentile);

        if(property_exists($obj, 'mairie'))
            $city->setCityhallWeb($obj->mairie);

        if(property_exists($obj, 'tel_mairie'))
            $city->setCityhallPhone($obj->tel_mairie);

        if(property_exists($obj, 'maire'))
            $city->setMayor($obj->maire);

        $manager->persist($city);
      } else {
        $this->logger->warning("FIXTURES : Can't find {$obj->insee} !");
      }

      // Load the database in batch
      if (($i % $batchSize) === 0) {
        $manager->flush();
        $manager->clear();
      }

      $i++;
    }

    $manager->flush();
    $manager->clear();
    fclose($handle);
  }
}
