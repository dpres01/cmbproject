<?php

namespace ZandooBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use ZandooBundle\Entity\Annonce;
use ZandooBundle\Form\FormAnnonceType;
use ZandooBundle\Form\FormUtilisateurType;

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
//            foreach ($annonce->getImages() as $image ){
//                //$image->getUrl()->move(__DIR__.'/upload',$image->getUrl()->getClientOriginalName());   
//                //$image->setLibelle(__DIR__.'/upload/'.$image->getUrl()->getClientOriginalName());
//            }
            $em = $this->getDoctrine()->getManager();
            try{
                $annonce->setDateCreation(new \DateTime());
                $annonce->getUtilisateur()->setDateCreation(new \DateTime());
                dump($annonce);
                $em->persist($annonce);
                //dump($annonce);die;
                $em->flush();  
            }catch(Exception $e){
               dump($e);die; 
            }
          
        }
        return $this->render('@Zandoo/annonce.html.twig',array('form'=>$form->createView()));
    }
    
    /**
     * @Route("/inscription")
     */
    public function inscription(Request $request){
        $utilisateur = new Utilisateur(); 
        $form = $this->createForm(FormUtilisateurType::class, $utilisateur, $options = array());
        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted()){
            //Enregistrment de l'annonce et de l'utilisateur
            dump($_POST,$form->isValid(),$form->isSubmitted());   
        }
        return $this->render('@Zandoo/Utilisateur.html.twig',array('form'=>$form->createView()));
    }
}
