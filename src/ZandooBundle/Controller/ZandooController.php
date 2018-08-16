<?php

namespace ZandooBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use ZandooBundle\Entity\Annonce;
use ZandooBundle\Form\FormAnnonceType;
use ZandooBundle\Entity\Utilisateur;
use ZandooBundle\Entity\Categorie;
use ZandooBundle\Entity\Famille;

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
     * @Route("/", name="annonce")     
     **/
    public function listerAnnonce(Request $request)
	{       
            $em = $this->getDoctrine()->getManager();  
            $offset = 1;
            if ($offset){
                $offset = (intval($offset) - 1) * 3 ;
            }
            
            $annonce = $em->getRepository(Annonce::class)->findAnnonceByCritere($offset);
                                        
            $tab["title"] = "Les Bananes Vertes buttanes";
            //dump($this->getParameter('url_img_test'));die;
            $tab["img"] =  "/web/uploads/documents/11.jpeg";
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
     * @Route("/annonce/{id}",defaults={"id" = null}, name="enregistrer_annonce")
     * @ParamConverter("annonce", class="ZandooBundle:Annonce", isOptional=true)
     */
    public function creerModifierAnnoce(Request $request, $annonce)
	{
        $em = $this->getDoctrine()->getManager();
        if($annonce == NULL){
          $annonce = new Annonce();  
        }         
        $options['connected'] = false;
        $options['categorie'] = $em->getRepository(Categorie::class)->findAll();
        $options['famille'] = $em->getRepository(Famille::class)->findAll();
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
                $categorie = $em->getRepository(Categorie::class)->find($annonce->getCategorie());
                $annonce->setCategorie($categorie);
                $annonce->setDateCreation(new \DateTime());                        
                $em->persist($annonce);              
                $em->flush();
                $this->addFlash('succesAnnonce', 'votre annonce a été enregistré avec succes!');
                if(is_null($this->getUser()) && $request->request->get('_username') && $request->request->get('_password')){
                    return $this->redirectToRoute('login_check',array());
                }
                return $this->redirectToRoute('afficher_annonce',array('id'=>$annonce->getId()));
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
     * @Route("afficher/annonce/{id}", requirements={"idDossier": "\d+"}, name="afficher_annonce")     
     **/
    public function afficherAnnonce(Request $request, $id)
	{
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository(Annonce::class)->find($id);      
        if($annonce){
            return $this->render('@Zandoo/annonce.html.twig',
                    array(
                            'annonce' => $annonce,
                            'headsearch' => 1,
                            'colorBody' => "F7F7F7",
                    )
            );
        }else{
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException( 'Not found!') ;
        }
    }     
}
