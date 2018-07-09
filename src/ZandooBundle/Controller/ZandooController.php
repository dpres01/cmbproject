<?php

namespace ZandooBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use ZandooBundle\Entity\Annonce;
use ZandooBundle\Form\FormAnnonceType;

class ZandooController extends Controller
{
    /**
     * @Route("/zando-index")
     */
    public function indexAction()
    {    
        $em = $this->getDoctrine()->getManager();
        $test =  $em->getRepository('\ZandooBundle\Entity\Categorie')->findCategorieByFamille();
     
        return $this->render('@Zandoo/Default/index.html.twig');
    }
    
    /**
     * @Route("/annonce")
     */
    public function depotAnnoce(Request $request){
        $annonce = new Annonce(); 
        $form = $this->createForm(FormAnnonceType::class, $annonce, $options = array());
        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted()){
            //Enregistrment de l'annonce et de l'utilisateur
            dump($_POST,$form->isValid(),$form->isSubmitted());   
        }
        return $this->render('@Zandoo/annonce.html.twig',array('form'=>$form->createView()));
    }
    
    /**
     * @Route("/inscription")
     */
    public function depotAnnoce(Request $request){
        $utilisateur = new Utilisateur(); 
        $form = $this->createForm(FormAnnonceType::class, $utilisateur, $options = array());
        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted()){
            //Enregistrment de l'annonce et de l'utilisateur
            dump($_POST,$form->isValid(),$form->isSubmitted());   
        }
        return $this->render('@Zandoo/Utilisateur.html.twig',array('form'=>$form->createView()));
    }
}
