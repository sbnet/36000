<?php

namespace Sbnet\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class DefaultController extends Controller
{
    public function indexAction()
    {
      $cache = new FilesystemAdapter();
      $cRegions = $cache->getItem('front.regions');

      if (!$cRegions->isHit()) {
          // regions does not exists in the cache
          $geo = $this->container->get("sbnet_front.apiaccess");
          $regions = $geo->getRegions();

          // Save it to the cache (permanently, see : https://symfony.com/doc/3.1/components/cache/cache_items.html#cache-item-expiration)
          $cRegions->set($regions);
          $cache->save($cRegions);
      }

      return $this->render('SbnetFrontBundle:Default:index.html.twig', array(
        "regions" => $cRegions->get()
      ));
    }

    public function searchAction(Request $request)
    {
      // if it's a POST
      if ($request->isMethod('POST')) {
        $geo = $this->container->get("sbnet_front.apiaccess");
        $cities = $geo->search($request->get('q'));
      } else {
        $this->addFlash('message', 'Il y a eu un problème avec la recherche, essayez à nouveau');
        return $this->redirectToRoute('sbnet_front_homepage');
      }

      return $this->render('SbnetFrontBundle:Default:search.html.twig', array(
        "cities" => $cities
      ));
    }

    public function cityAction(Request $request)
    {
      $geo = $this->container->get("sbnet_front.apiaccess");
      $city = $geo->getById($request->get('id'));

      return $this->render('SbnetFrontBundle:Default:city.html.twig', array(
        "city" => $city
      ));
    }

    public function regionAction(Request $request)
    {
      $geo = $this->container->get("sbnet_front.apiaccess");
      $region = $geo->getRegionById($request->get('id'));

      return $this->render('SbnetFrontBundle:Default:region.html.twig', array(
        "region" => $region
      ));
    }
}
