<?php

namespace ZandooBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use ZandooBundle\Entity\Annonce;
use ZandooBundle\Form\FormAnnonceType;
use ZandooBundle\Entity\Utilisateur;
use ZandooBundle\Entity\Categorie;
use ZandooBundle\Entity\Famille;
use ZandooBundle\Entity\Critere;
use ZandooBundle\Entity\Ville;
use ZandooBundle\Entity\Signalement;
use ZandooBundle\Entity\Motif;
use ZandooBundle\Form\FormSignalementType;
use ZandooBundle\Form\FormUtilisateurType;


class ZandooController extends Controller
{      
    /**
     * @Route("/zando-index", name="home")
     */
    public function indexAction()
    {    
        return $this->render('@Zandoo/Default/index.html.twig');
    }
    
    /**
     * @Route("/demandes", name="demandes") 
     *     
     */	
    public function listerDemandeAction(Request $request)
	{
            $critere = new Critere();
            $session = new Session(); 

            $em = $this->getDoctrine(); 
            $repoAnnoce =  $em->getRepository(Annonce::class);          
            $offset  = empty($request->query->get('p')) ? 1 : $request->query->get('p') ;
                 
            $critere->setOffset($offset);
            $critere->setType(1);
            $annonces = $repoAnnoce->findAnnonceByCritere($critere);                                
            $nbr = intval(ceil($repoAnnoce->countAllAnnonce($critere)/20)); 
            
            return $this->render('@Zandoo/Annonce/listerAnnonce.html.twig',
                    array(
                            'form'       => "",
                            'colorBody'  => "F7F7F7",
                            'headsearch' => 1,
                            'annonces'   => $annonces,
			    'search'     => '',
                            'cat'        => '',
                            'titres'     => '',
                            'urgentes'   => '',
                            'numPage'    => $offset,
			    'total'      => $nbr
                    )
            );
    }	
    
    /**
     * @Route("/offres", name="offres") 
     *     
     */	
    public function listerAnnoncesAction(Request $request)
{
    $critere = new Critere();
    $session = new Session(); 
    
    $em = $this->getDoctrine(); 
    $repoAnnoce =  $em->getRepository(Annonce::class);          
    $offset  = empty($request->query->get('p')) ? 1 : $request->query->get('p') ;
    
    $critere->setOffset($offset);
    $critere->setType(0);
    $annonces = $repoAnnoce->findAnnonceByCritere($critere);   		
    $nbr = intval(ceil($repoAnnoce->countAllAnnonce($critere)/20));

    return $this->render('@Zandoo/Annonce/listerAnnonce.html.twig',
            array(
                    'form'       => "",
                    'colorBody'  => "F7F7F7",
                    'headsearch' => 1,
                    'annonces'   => $annonces,
                    'search'     => '',
                    'cat'        => '',
                    'titres'     => '',
                    'urgentes'   => '',
                    'numPage'    => $offset,  
                    'total'      => $nbr
            )
        );
    }	
    
    /**
     * @Route("/", name="annonces") 
     *     
     */
    public function rechercheAnnonce(Request $request){ 
        $critere = new Critere();
        $session = new Session(); 
        
        $em = $this->getDoctrine(); 	
        $repoAnnoce =  $em->getRepository(Annonce::class);
        
        $total = array();
        $search   = $request->query->get('q');
        $cat 	  = $request->query->get('cat');
        $titre 	  = $request->query->get('tre');
        $urgentes = $request->query->get('urg');
        $offset  = empty($request->query->get('p')) ? 1 : $request->query->get('p') ;                 
        $cat     = intval($cat) > 0 ? $cat : null; 
        
        $critere->setOffset($offset);
        $critere->setCategorie($cat);
        $critere->setTitre($search);
        $critere->setUrgent($urgentes);
        $critere->setTitreUniquement($titre);
        
        $annonces = $repoAnnoce->findAnnonceByCritere($critere);
        
        //if(empty($session->get('nbr'))){
        $nbr = intval(ceil($repoAnnoce->countAllAnnonce($critere)/20));
       // $session->set('nbr',$nbr);
       //}
        
        return $this->render('@Zandoo/Annonce/listerAnnonce.html.twig',array(
                                'form'       => "",
                                'colorBody'  => "F7F7F7",
                                'headsearch' => 1,
                                'annonces'   => $annonces,
                                'search'     => $search,
                                'cat'        => $cat,
                                'titres'     => $titre,
                                'urgentes'   => $urgentes,
                                'numPage'    =>$offset,
                                'total'      => $nbr
			)
                );
    }    

    /**
     * @Route("/annonce/{generateurId}",defaults={"generateurId" = null}, name="enregistrer_annonce")
     * @ParamConverter("annonce", class="ZandooBundle:Annonce", isOptional=true)
     */
    public function creerModifierAnnoce(Request $request, $annonce){
        $em = $this->getDoctrine()->getManager();
		$total = array();
        if($annonce == NULL){
          $annonce = new Annonce(); 
          $annonce->setDateCreation(new \DateTime());
        }else{
            $categorieID = $annonce->getCategorie()->getId();
            $villeID = $annonce->getVilleAnnonce() ? $annonce->getVilleAnnonce()->getId(): null;
            $annonce->setCategorie($categorieID);
            $annonce->setVilleAnnonce($villeID);
        }           
        $options['connected'] = false;
        $options['categorie'] = $em->getRepository(Categorie::class)->findAll();
        $options['famille'] = $em->getRepository(Famille::class)->findAll();
        $options['ville'] = $em->getRepository(Ville::class)->findAll();
        if($this->getUser()){
            $options['connected'] = true;
        } 
        $userConnect = ($this->getUser()) ?  $this->getUser()->getIsAdmin(): false;
       
        if(!$userConnect && (!empty($annonce->getUtilisateur()) && empty($this->getUser()) || 
        (!empty($this->getUser()) && !empty($annonce->getUtilisateur()) && $annonce->getUtilisateur()->getId() != $this->getUser()->getId()))){
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
                if(!is_null($annonce->getVilleAnnonce())){
                    $villeannonce = $em->getRepository(Ville::class)->find($annonce->getVilleAnnonce());
                    $annonce->setVilleAnnonce($villeannonce);
                }
                if(is_null($villeannonce) && $this->getUser()){
                    $annonce->setVilleAnnonce($utilisateur->getVille());
                }
                if(is_null($annonce)){
                    $annonce->setDateModification(new \DateTime());                    
                }
                $em->persist($annonce);               
                $em->flush();
                if(!is_null($annonce->getGenerateurId()) or !empty($annonce->getGenerateurId())){
                     $gen = $annonce->getGenerateurId();                    
                }else{
                     $gen = $annonce->getId();
                     $annonce->setGenerateurId($annonce->getId());    
                }
                $em->flush();
                $this->addFlash('succesAnnonce', 'votre annonce a été enregistré avec succes!');
                if(!$this->getUser()){                          
                    return $this->redirectToRoute('login',array());
                }
                return $this->redirectToRoute('afficher_annonce',array('id'=>$gen));
            }catch(Exception $e){
               sprintf("Une erreur technique: %s est survenue veuillez contacter l'administrateur ",$e) ;
            }
        }  
       
        return $this->render('@Zandoo/Annonce/newAnnonce.html.twig',
			array(
				'form' => $form->createView(),
				'colorBody' => "F7F7F7",
                                'url_upload'=> $this->getParameter('url_upload'),
                                'proprietaireAnnonce'=> $this->estPropritaireAnnonce($annonce->getUtilisateur(),$this->getUser())
			)
		);
    }
	
    /**
     * @Route("afficher/annonce/{id}",  name="afficher_annonce")     
     *
     */
    public function afficherAnnonce(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $critere = new Critere();
        $critere->setIdUtilisateur($id);
        $annonce = $em->getRepository(Annonce::class)->findOneBy(array('generateurId'=>$id));
	$nbImg = count($annonce->getImages());
        $signalement = new Signalement(); 
        $options['motif'] = $em->getRepository(Motif::class)->findAll();
	$form = $this->createForm(FormSignalementType::class ,$signalement,$options);
        $form->handleRequest($request);
        
        if($form->isValid() && $form->isSubmitted()){
            $motif = $em->getRepository(Motif::class)->find($signalement->getMotif());
            $signalement->setMotif($motif);
            $signalement->setAnnonce($annonce);            
            $em->persist($signalement);
            $em->flush();
        } 
        if($annonce){
            return $this->render('@Zandoo/Annonce/annonce.html.twig',
				array(
					'annonce'    => $annonce,
                                        'form'       =>$form->createView(),    
					'headsearch' => 1,
					'colorBody'  => "F7F7F7",
					'nbImg'      => $nbImg,
					'url_upload'=> $this->getParameter('url_upload'),
				));
        }else{
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException( 'Not found!');
        }
    } 
    
    /**
     * @Route("desactiver/annonce/{id}", requirements={"id": "\d+"}, name="desactiver_annonce")     
     *
     */
    public function desactiverAnnonceAction(Request $request,$id){
       $em = $this->getDoctrine()->getManager();
       $annonce = $em->getRepository(Annonce::class)->find($id);
       $annonce->setActif(0);
       $retour = $annonce->getType() == 1 ?  $this->redirectToRoute('demandes'):$this->redirectToRoute('annonces');  
       return $retour;
    }
    
    /**
     * 
     *  @Route("comptes/{id}", name="compte_utilisateurs")
     *  @ParamConverter("utilisateur", class="ZandooBundle:Utilisateur", isOptional=true)
     * 
     */
    public function annonceByUtilisateurAction(Request $request,$utilisateur){
        $repoAnnoce = $this->getDoctrine()->getRepository(Annonce::class); 
        $critere = new Critere();
        $form = $this->createForm(FormUtilisateurType::class,$utilisateur,array());
        $critere->setIdUtilisateur($utilisateur->getId());	
	$annonces = $repoAnnoce->findAnnonceByCritere($critere);
        if($form->isValid() && $form->isSubmitted()){
            //TODO
        }
        return $this->render('@Zandoo/Annonce/utilisateurAnnonce.html.twig',array(
                                    'annonces'=>$annonces,
                                    'utilisateur'=>$utilisateur,
                                    'form'=>$form->createView()
         )); 
    }
    /**
     * @Route("recherche", name="chercher_annonces")     
     *
     */
     public function chercheAnnonceAction(Request $request)
	 {
        $resp = new JsonResponse();
        $retour = array();
        $offset = 1;
        if ($offset){
                $offset = (intval($offset) - 1) * 20 ;
        }
        $critere = new Critere();
        $critere->setTitre('test')
                 ->setCategorie(1)
                 ->setOffset($offset);
        $em = $this->getDoctrine()->getManager();         
        $annonces = $em->getRepository(Annonce::class)->findAnnonceByCritere($critere);
        foreach($annonces as $key=>$annonce){
             $retour[$key]['titre']= $annonce->getTitre();
             $retour[$key]['description']= $annonce->getDescription();
             $retour[$key]['prix']= $annonce->getPrix();
             $retour[$key]['monnaie']= $annonce->getMonnaie();
             if(!$annonce->getImages()->isEmpty()){
                 $tabImg = $annonce->getImages();
                 $retour[$key]['image']= $tabImg[0]->getId().'.'.$tabImg[0]->getUrl();
             }             
        }
         
         $resp->setData($retour);
         return $resp; 
     }
     
     private function estPropritaireAnnonce ($utilisateAnnonce,$utilusateuConnecte){       
         if($utilisateAnnonce == null){
             return true;
         }
         if($utilusateuConnecte != null && $utilisateAnnonce!= null){
             return $utilusateuConnecte->getId() == $utilisateAnnonce->getId();
         }
     }
    
}
