<?php

namespace ZandooBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
     * @Route("/annonce/{id}",defaults={"id" = null},name="enregistrer_annonce")
     * @ParamConverter("annonce", class="ZandooBundle:Annonce", isOptional=true)
     */
    public function depotAnnoce(Request $request,$annonce){
        $em = $this->getDoctrine()->getManager();
        if($annonce == NULL){
          $annonce = new Annonce();  
        }         
        $options['connected'] = false;
        if($this->getUser() && empty($annonce->getId())){
            $options['connected'] = true;
        } 
       
        if(!empty($annonce->getUtilisateur()) && empty($this->getUser()) || (!empty($this->getUser()) && !empty($annonce->getUtilisateur()) && $annonce->getUtilisateur()->getId() != $this->getUser()->getId()) ){
             throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException('Vous n\'avez pas acces à cette page veuillez vous connecté.');          
        }
        
        $form = $this->createForm(FormAnnonceType::class, $annonce, $options);
        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted()){
           
            try{
                if($this->getUser()){
                    $utilisateur = $em->getRepository(Utilisateur::class)->find($this->getUser()->getId());
                    $utilisateur->setUsername($this->getUser()->getUsername());
                    $utilisateur->setEmail($this->getUser()->getEmail());
                    $utilisateur->setPassword($this->getUser()->getPassword());
                    $utilisateur->setAdresse($this->getUser()->getAdresse());
                    $utilisateur->setTelephone($this->getUser()->getTelephone());
                    $utilisateur->setVille($this->getUser()->getVille());                 
                    $annonce->setUtilisateur($utilisateur);
                }else{                  
                   $annonce->getUtilisateur()->setDateCreation(new \DateTime()); 
                   $pwdEncoded = $this->get('security.password_encoder')->encodePassword(new Utilisateur(), $annonce->getUtilisateur()->getPassword());
                   $annonce->getUtilisateur()->setPassword($pwdEncoded);
          
                }
                $annonce->setDateCreation(new \DateTime());                        
                $em->persist($annonce);              
                $em->flush();
                $this->addFlash('succesAnnonce', 'votre annonce a été enregistré avec succes!');
            }catch(Exception $e){
               echo $e;
            }
        }
        return $this->render('@Zandoo/annonce.html.twig',array('form'=>$form->createView()));
    }
     /**
     * @Route("/annonce/afficher/{id}",defaults={"id" = null},name="afficher_annonce")
     * 
     */
    public function afficherAnnoce(Request $request,$id){
         $em = $this->getDoctrine()->getManager();
         $annonce = $em->getRepository(Annonce::class)->find($id);
         return $this->render('@Zandoo/afficherAnnonce.html.twig',array('annonce'=>$annonce));
    }
    
    
}
