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
      // Si la requête est en POST
      if ($request->isMethod('POST')) {
        $cities = [];
        $restClient = $this->container->get("circle.restclient");

        $search = $request->get('q');
        if (is_numeric($search)) {
          $r = $restClient->get("http://api.36000.fr/city/postal/$search");
          $city = json_decode($r->getContent());
        } else {
          $r = $restClient->get("http://api.36000.fr/city/search/$search");
          $city = json_decode($r->getContent());
        }
var_dump($city);
exit;
      } else {
        $this->addFlash('message', 'Il y a eu un problème avec la recherche, essayez à nouveau');
        return $this->redirectToRoute('sbnet_front_homepage');
      }

      return $this->render('SbnetFrontBundle:Default:search.html.twig');
    }
}
