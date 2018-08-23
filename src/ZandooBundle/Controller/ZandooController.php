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
use ZandooBundle\Entity\Critere;
use ZandooBundle\Service\Monnaie;

class ZandooController extends Controller
{      
    /**
     * @Route("/zando-index", name="home")
     */
    public function indexAction()
    {    
        $homehead 	= 1;
        return $this->render('@Zandoo/Default/index.html.twig', 
	             array(
				//'homehead' => $homehead
			)		
		);
    }
    /**
     * @Route("/demandes", name="demandes")     
     **/	
    public function listerDemandeAction(Request $request)
	{
            $em = $this->getDoctrine()->getManager(); 
            $critere = new Critere();
            $offset = 1;
            if ($offset)
            {
                    $offset = (intval($offset) - 1) * 20 ;
            }
            $critere->setOffset($offset);
            $critere->setType(1);
            $annonce = $em->getRepository(Annonce::class)->findAnnonceByCritere($critere);       
            $tab["titre"] = "Les Bananes Vertes buttanes";
            $tab["img"] =  "/web/uploads/documents/37.jpeg";
            $tab["prix"] = "99";
            $tab["monnaie"] = "€";
            $tab["dateCreation"] = new \DateTime();
            $tab["description"] = "GXR Suzuki 600 for sale or trade. Would love a camper of sorts. Parked the bike two years ago...";

            $i = 0;
            $htm = '';
            while($i < 10)
            {
                    $data[] = $tab;
                    $i++;
            }
		return $this->render('@Zandoo/Annonce/listerAnnonce.html.twig',
			array(
				'form' => "",
				'colorBody' => "F7F7F7",
				'headsearch' => 1,
				'data' => $data
			)
		);
    }	
    /**
     * @Route("/", name="annonces")     
     **/
    public function listerAnnonce(Request $request){       
        $em = $this->getDoctrine(); 
        $repoAnnoce =  $em->getRepository(Annonce::class);

        $total = $repoAnnoce->countAllAnnonce();
        $critere = new Critere();
        $offset = 1;
        if ($offset){
                $offset = (intval($offset) - 1) * 20 ;
        }
        $critere->setOffset($offset);
        $critere->setType(0);

        $annonces = $repoAnnoce->findAnnonceByCritere($critere);   

        return $this->render('@Zandoo/Annonce/listerAnnonce.html.twig',
                        array
                        (
                                'form' => "",
                                'colorBody' => "F7F7F7",
                                'headsearch' => 1,
                                'annonces' => $annonces,
                                'url_upload'=> $this->getParameter('url_upload')
                        )
        );
    }    

    /**
     * @Route("/annonce/{id}",defaults={"id" = null}, name="enregistrer_annonce")
     * @ParamConverter("annonce", class="ZandooBundle:Annonce", isOptional=true)
     */
    public function creerModifierAnnoce(Request $request, $annonce){
        $em = $this->getDoctrine()->getManager();
        if($annonce == NULL){
          $annonce = new Annonce();  
        }else{
            $categorieID = $annonce->getCategorie()->getId();
            $annonce->setCategorie($categorieID);
        }           
        $options['connected'] = false;
        $options['categorie'] = $em->getRepository(Categorie::class)->findAll();
        $options['famille'] = $em->getRepository(Famille::class)->findAll();
        if($this->getUser()){
            $options['connected'] = true;
        }        
        if(!empty($annonce->getUtilisateur()) && empty($this->getUser()) || 
        (!empty($this->getUser()) && !empty($annonce->getUtilisateur()) && $annonce->getUtilisateur()->getId() != $this->getUser()->getId())){
             throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException('Vous n\'avez pas le droit d\'acces à cette page veuillez vous connecté.');          
        }    
        $form = $this->createForm(FormAnnonceType::class, $annonce, $options);
        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted()){
            try{
                if($this->getUser()){
                    $utilisateur = $em->getRepository(Utilisateur::class)->find($this->getUser()->getId());
                    $annonce->setUtilisateur($utilisateur);
                }
		else
		{                  
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
                if(!$this->getUser()){                          
                    return $this->redirectToRoute('login',array());
                }
                return $this->redirectToRoute('afficher_annonce',array('id'=>$annonce->getId()));
            }catch(Exception $e){
               sprintf("Une erreur technique: %s est survenue veuillez contacter l'administrateur ",$e) ;
            }
        }  
       
        return $this->render('@Zandoo/Annonce/newAnnonce.html.twig',
			array(
				'form' => $form->createView(),
				'colorBody' => "F7F7F7",
                                'url_upload'=> $this->getParameter('url_upload')
			)
		);
    }
	
    /**
     * @Route("afficher/annonce/{id}", requirements={"id": "\d+"}, name="afficher_annonce")     
     **/
    public function afficherAnnonce(Request $request, $id){
        $em = $this->getDoctrine()->getManager();

        $critere = new Critere();
        $critere->setIdUtilisateur($id);
        $annonce = $em->getRepository(Annonce::class)->find($id);//->findAnnonceByCritere($critere);
        //dump($annonce->getutilisateur()->getEmail());exit;
        if($annonce){
            return $this->render('@Zandoo/Annonce/annonce.html.twig',
				array(
                                        'annonce'    => $annonce,
                                        'headsearch' => 1,
                                        'colorBody'  => "F7F7F7",
                                        'url_upload'=> $this->getParameter('url_upload'),
				) );

        }
	else{
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException( 'Not found!');
        }
    } 
    
    /**
     * @Route("desactiver/annonce/{id}", requirements={"id": "\d+"}, name="desactiver_annonce")     
     **/
    public function desactiverAnnonceAction($request,$id){
       $em = $this->getDoctrine()->getManager();
       $annonce = $em->getRepository(Annonce::class)->find($id);
       $annonce->setActif(0);
       $retour = $annonce->getType() == 1 ?  $this->redirectToRoute('demandes'):$this->redirectToRoute('annonces');  
       return $retour;
    } 
}
