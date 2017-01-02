<?php

namespace Animal\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AnimalPlatformBundle:Default:index.html.twig');
    }
    
    public function menuAction()
    {
        return $this->render('AnimalPlatformBundle:Default:menu.html.twig');
    }
}
