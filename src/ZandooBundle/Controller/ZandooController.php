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
     * @Route("/zando-index", name="home")
     */
    public function indexAction()
    {    
        //$em 		= $this->getDoctrine()->getManager();
        //$test 	=  $em->getRepository('\ZandooBundle\Entity\Categorie')->findCategorieByFamille();
		$homehead 	= 1;
        return $this->render('@Zandoo/Default/index.html.twig', 
			array(
				//'homehead' => $homehead
			)		
		);
    }
	
	
    /**
     * @Route("/annonce", name="annonce")     
     **/
    public function listerAnnoce(Request $request)
	{
		$tab["title"] = "Les Bananes Vertes buttanes";
		$tab["img"] = "/public/img/fd8017b0877dc633d90eaa06c011532e7e36172d.jpg";
		$tab["price"] = "99";
		$tab["currency"] = "€";
		$tab["date"] = "Aujourd'hui 17:45";
		$tab["desc"] = "GXR Suzuki 600 for sale or trade. Would love a camper of sorts. Parked the bike two years ago...";
		
		$i = 0;
		$htm = '';
		while($i < 10)
		{
			$data[] = $tab;
			$i++;
		}
		return $this->render('@Zandoo/listerAnnonce.html.twig',
			array(
				'form' => "",
				'colorBody' => "F7F7F7",
				'headsearch' => 1,
				'data' => $data
			)
		);
    } 
    
    /**
     * @Route("/annonce/new", name="enregistrer_annonce")
     * @ParamConverter("annonce", class="ZandooBundle:Annonce", isOptional=true)
     */
    public function depotAnnoce(Request $request, $annonce)
	{
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
        return $this->render('@Zandoo/newAnnonce.html.twig',
			array(
				'form' => $form->createView(),
				'colorBody' => "F7F7F7"
			)
		);
    }
	
    /**
     * @Route("/annonce/{id}", name="afficher_annonce")     
     **/
    public function afficherAnnoce(Request $request, $id)
	{
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository(Annonce::class)->find($id);
        return $this->render('@Zandoo/annonce.html.twig',array('annonce'=>$annonce));
    }     
}
