<?php

namespace Sbnet\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SbnetCoreBundle:Default:index.html.twig');
    }
}
