<?php

namespace Sbnet\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SbnetFrontBundle:Default:index.html.twig');
    }
}
