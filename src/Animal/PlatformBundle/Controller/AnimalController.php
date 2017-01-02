<?php

namespace Animal\PlatformBundle\Controller;

use Animal\PlatformBundle\Form\AnimalType;
use Animal\PlatformBundle\Entity\Animal;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AnimalController extends Controller
{

/**
	add new animal
**/
    public function ajouterAction(Request $request)
    {
        $user = $this->getUser();
        if(!is_object($user))
            return $this->render('AnimalPlatformBundle:User:connexion.html.twig');
        $animal = new Animal();

        $form = $this->get('form.factory')->create(AnimalType::class, $animal);

        if ($request->isMethod('POST') && $form->handleRequest($request)) {
            
            $em = $this->getDoctrine()->getManager();
            $animal->setUser($this->getUser());
            $em->persist($animal);
            $em->flush();

            return $this->render('AnimalPlatformBundle:Animal:ajouter.html.twig',array('form' => $form->createView(),'valider' => true));
        }

        return $this->render('AnimalPlatformBundle:Animal:ajouter.html.twig', array('form' => $form->createView()));
    }
    
/**
	show animal list page
**/
    public function listerAction(Request $request)
    {
        $user = $this->getUser();
        if(!is_object($user))
            return $this->render('AnimalPlatformBundle:User:connexion.html.twig');
        $animaux = new Animal();

        $form = $this->get('form.factory')->create(AnimalType::class, $animaux);

        $animaux = $this->getDoctrine()->getRepository('AnimalPlatformBundle:Animal')->findBy(array('user' => $this->getUser()->getId()));
            
        if($animaux){

            $age = array();
            foreach ($animaux as $animal) {
                array_push($age, $animal->getAge()->format('Y-m-d'));
            }

            return $this->render('AnimalPlatformBundle:Animal:lister.html.twig', array('recherche' => true, 'animaux' => $animaux, 'age' => $age));
        }else{
            return $this->render('AnimalPlatformBundle:Animal:lister.html.twig', array('erreur' => false));
        }    
        return $this->render('AnimalPlatformBundle:Animal:lister.html.twig');
    }
    
/**
	Edit animal
**/
    public function modifierAction($id, Request $request)
    {
        $user = $this->getUser();
        if(!is_object($user))
            return $this->render('AnimalPlatformBundle:User:connexion.html.twig');
		$animal = new Animal();
    	$form = $this->get('form.factory')->create(AnimalType::class, $animal);

		$em = $this->getDoctrine()->getManager();
		
		$animal = $em->getRepository('AnimalPlatformBundle:Animal')->find($id);

        if ($request->isMethod('POST')) {

 			$form->handleRequest($request);
        	$anim = $form->getData();
            $animal->setNom($anim->getNom());
            $animal->setAge($anim->getAge());
            $animal->setFamille($anim->getFamille());
            $animal->setRace($anim->getRace());
            $animal->setNourriture($anim->getNourriture());
            $em->flush();

	        return $this->render('AnimalPlatformBundle:Animal:modifier.html.twig',array(
	        	'form' => $form->createView(),'animal' => $animal,'modifier' => true));
        }
        return $this->render('AnimalPlatformBundle:Animal:modifier.html.twig',array(
        	'form' => $form->createView(),'animal' => $animal));
    }
    
/**
	delete animal
**/
    public function supprimerAction($id)
    {
        $user = $this->getUser();
        if(!is_object($user))
            return $this->render('AnimalPlatformBundle:User:connexion.html.twig');
    	$animal = new Animal();

    	$em = $this->getDoctrine()->getEntityManager();

    	$animal = $this->getDoctrine()->getRepository('AnimalPlatformBundle:Animal')->find($id);

		if($animal){
			$em->remove($animal);
			$em->flush();

			return new Response("true");
		}else
    		return new Response("false");
    }
    
/**
    information animal
**/
    public function infoAction($id)
    {
        $user = $this->getUser();
        if(!is_object($user))
            return $this->render('AnimalPlatformBundle:User:connexion.html.twig');
        $animal = new Animal();

        $em = $this->getDoctrine()->getEntityManager();

        $animal = $this->getDoctrine()->getRepository('AnimalPlatformBundle:Animal')->find($id);

        if($animal){
            $naissance = $animal->getAge()->format('Y-m-d');
            return $this->render('AnimalPlatformBundle:Animal:info.html.twig', array('animal'=>$animal, 'naissance' => $naissance));
        }else
            return new Response("false");
    }
    
}
