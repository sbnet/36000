<?php
namespace Sbnet\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Sbnet\CoreBundle\Entity\Region;

class LoadRegion implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
  /**
   * @var ContainerInterface
   */
  private $container;

  public function setContainer(ContainerInterface $container = null)
  {
      $this->container = $container;
  }

  public function getOrder()
  {
    // the order in which fixtures will be loaded
    // the lower the number, the sooner that this fixture is loaded
    return 20;
  }

  public function load(ObjectManager $manager)
  {
    $batchSize = 20;
    $i = 1;

    $file = $this->container->getParameter('kernel.root_dir').'/../data/regions-2016.csv';

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

    // Get the corresponding country (France)
    $france = $manager
                ->getRepository('SbnetCoreBundle:Country')
                ->findOneByName("FRANCE");

    // Read the file, line by line
    while (FALSE !== ($data = fgetcsv($handle, 0, "\t"))) {
      $obj = new Region;
      $obj->setCode($data[0]);
      $obj->setName($data[3]);
      $obj->setFormalName($data[4]);
      $obj->setCountry($france);

      $search  = $data[3];
      $char    = array("-", " ");
      $replace = '';
      $obj->setSearch(str_replace($char, $replace, $search));

      $manager->persist($obj);

      // Load the database in batch
      if (($i % $batchSize) == 0) {
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
