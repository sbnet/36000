<?php
namespace Sbnet\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Sbnet\CoreBundle\Entity\Region;

class LoadRegion implements FixtureInterface, ContainerAwareInterface
{
  /**
   * @var ContainerInterface
   */
  private $container;

  public function setContainer(ContainerInterface $container = null)
  {
      $this->container = $container;
  }

  public function load(ObjectManager $manager)
  {
    $batchSize = 20;
    $i = 1;
    $file = $this->container->getParameter('kernel.root_dir').'/../data/regions.json';

    if (!file_exists($file)) {
      throw new \Exception("Data file ($file) is not present !");
    }

    $handle = fopen($file, "r");

    if (!$handle) {
      throw new \Exception("Can't read the file !");
    }

    // Read the json file, line by line
    while (($line = fgets($handle, 4096)) !== false) {    
      $obj = new Region;
      $var = json_decode($line);

      $obj->setName($var->nom);
      $obj->setSearch($var->search);
      $manager->persist($obj);

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