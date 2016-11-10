<?php

namespace Sbnet\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SbnetFrontBundle:Default:index.html.twig');
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
}
