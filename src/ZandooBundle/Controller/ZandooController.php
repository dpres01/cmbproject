<?php

namespace ZandooBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use ZandooBundle\Entity\Annonce;
use ZandooBundle\Form\FormAnnonceType;
use ZandooBundle\Entity\Utilisateur;

class ZandooController extends Controller
{	
    /**
     * @Route("/zando-index")
     */
    public function indexAction()
    {    
        //$em 		= $this->getDoctrine()->getManager();
        //$test 	=  $em->getRepository('\ZandooBundle\Entity\Categorie')->findCategorieByFamille();
		$homehead 	= 1;
        return $this->render('@Zandoo/Default/index.html.twig', array(
			//'homehead' => $homehead
		));
    }
    
    /**
     * @Route("/annonce",name="enregistrer_annonce")
     */
    public function depotAnnoce(Request $request){
        $annonce = new Annonce();
        
        $form = $this->createForm(FormAnnonceType::class, $annonce, $options = array());
        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            try{
                $annonce->setDateCreation(new \DateTime());
                $annonce->getUtilisateur()->setDateCreation(new \DateTime());              
                $em->persist($annonce);              
                $em->flush();  
            }catch(Exception $e){
               echo $e;
            }
        }
        return $this->render('@Zandoo/annonce.html.twig',array('form'=>$form->createView()));
    }
    
    
}
