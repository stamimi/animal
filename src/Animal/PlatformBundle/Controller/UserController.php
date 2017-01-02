<?php

namespace Animal\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function connexionAction()
    {
        return $this->render('AnimalPlatformBundle:User:connexion.html.twig');
    }
    
}
