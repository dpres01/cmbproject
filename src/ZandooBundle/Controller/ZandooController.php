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
use ZandooBundle\Form\FormUtilisateurModificationType;
use ZandooBundle\Entity\Categorie;
use ZandooBundle\Entity\Famille;
use ZandooBundle\Entity\Critere;
use ZandooBundle\Entity\Ville;
use ZandooBundle\Entity\Signalement;
use ZandooBundle\Entity\Motif;
use ZandooBundle\Form\FormSignalementType;
use ZandooBundle\Form\FormUtilisateurType;
use ZandooBundle\Entity\UtilisateurModification;
use ZandooBundle\Service\DTO\UtilisateurConvert;
use ZandooBundle\Form\FormPasswordModificationType;
use ZandooBundle\Entity\Contact;
use ZandooBundle\Form\FormContactType;
use ZandooBundle\Entity\Visite;
use Symfony\Component\Validator\Constraints\Email as EmailConstraint;


class ZandooController extends Controller
{
     const NB_LIGNE_TOTAL = 20;
     const TYPE_DEMANDE = 1;
     const TYPE_OFFRE = 0;
    /**
     * @Route("/zando-index", name="home")
     */
    public function indexAction()
    {
        $nbAnnoByVille = $this->get('zandoo.utils')->countAnnonceByVille();
        return $this->render('@Zandoo/Default/index.html.twig', array('nbAnnoByVille'=>$nbAnnoByVille));
    }

    /**
     * @Route("/demandes", name="demandes")
     *
     */
    public function listerDemandeAction(Request $request){
        $critere = new Critere();
        $session = new Session();

        $em = $this->getDoctrine();
        $repoAnnoce =  $em->getRepository(Annonce::class);
        $offset  = empty($request->query->get('p')) ? 1 : $request->query->get('p') ;
        $cat 	 = $request->query->get('cat');
        $tri     = $request->query->get('tr');

        $critere->setOffset($offset);
        $critere->setType($this::TYPE_DEMANDE);
        $this->convertfiltreTocritere($tri,$critere);
        $annonces = $repoAnnoce->findAnnonceByCritere($critere);
        $nbr = intval(ceil($repoAnnoce->countAllAnnonce($critere)/$this::NB_LIGNE_TOTAL));
        $retour = array('form'=>"",'colorBody'=>"F7F7F7",'headsearch'=>1,'annonces'=>$annonces,'search'=>'','cat'=>'','titres'=>'',
                        'urgentes'=>'','numPage'=>$offset,'priceFrom'=>'','priceTo'=>'','total'=> $nbr,'tri'=>$tri);
        return $this->render('@Zandoo/Annonce/listerAnnonce.html.twig', $retour);
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

        $offset    = empty($request->query->get('p')) ? 1 : $request->query->get('p');
        $cat 	   = $request->query->get('cat');
        $tri       = $request->query->get('tr');
        $price     = $request->query->get('pr');
        $filter    = $request->query->get('ft');

        if($filter)
        {
                $filter = " checked";
        }

        $priceFrom = "";
        $priceTo   = "";
        if($price)
        {
                $tab	   = explode("_", $price);
                $priceFrom = $tab[0];
                $priceTo   = $tab[1];
        }

        $critere->setOffset($offset);
        $critere->setCategorie($cat);
        $critere->setType($this::TYPE_OFFRE);
        $this->convertfiltreTocritere($tri,$critere);
        $annonces = $repoAnnoce->findAnnonceByCritere($critere);
        $nbr = intval(ceil($repoAnnoce->countAllAnnonce($critere)/$this::NB_LIGNE_TOTAL));

        $retour = array(
			'form'		 =>'',
			'colorBody'	 => 'F7F7F7',
			'headsearch' =>1,
			'annonces'	 =>$annonces,
			'search'	 =>'',
			'cat' 		 =>'',
            'titres'	 => '',
			'urgentes'	 =>'',
			'numPage'	 => $offset,
			'priceFrom'	 =>$priceFrom,
			'priceTo'	 =>$priceTo,
			'total'	 	 =>$nbr,
			'tri'		 =>$tri,
			'filter'	 =>$filter,
		);
        return $this->render('@Zandoo/Annonce/listerAnnonce.html.twig', $retour);
    }

    /**
     * @Route("/", name="annonces")
     *
     */
    public function rechercheAnnonce(Request $request){
        $critere = new Critere();
        $session = new Session();

        $em 		= $this->getDoctrine();
        $repoAnnoce =  $em->getRepository(Annonce::class);

        $search   = $request->query->get('q');
        $cat 	  = $request->query->get('cat');
        $ville 	  = $request->query->get('vi');
        $titre 	  = $request->query->get('tre');
        $urgentes = $request->query->get('urg');
        $offset   = empty($request->query->get('p')) ? 1 : $request->query->get('p') ;
        $cat      = intval($cat) > 0 ? $cat : null;
		$tri      = $request->query->get('tr');		
		$price    = $request->query->get('pr');
        $filter   = $request->query->get('ft');

		if($filter)
		{
			$filter = " checked";
		}
		
		$priceFrom = "";
		$priceTo   = "";
		if($price)
		{
			$tab	   = explode("_", $price);
			$priceFrom = $tab[0];
			$priceTo   = $tab[1];
		}
		
        $this->convertfiltreTocritere($tri,$critere);
        $critere->setOffset($offset);
        $critere->setCategorie($cat);
        $critere->setVille($ville == 0 ? null:$ville );
        $critere->setTitre(trim($search));
        $critere->setUrgent($urgentes);
        $critere->setTitreUniquement($titre);
        $annonces = $repoAnnoce->findAnnonceByCritere($critere);

        //if(empty($session->get('nbr'))){
        $nbr = intval(ceil($repoAnnoce->countAllAnnonce($critere)/$this::NB_LIGNE_TOTAL));
       // $session->set('nbr',$nbr);
       //}
        $retour = array(
			'form'			=>'',
			'colorBody'		=>'F7F7F7',
			'headsearch'	=>1,
			'annonces'		=>$annonces,
			'search'		=>$search,
			'cat'			=>$cat,
			'titres'		=>$titre,
            'urgentes'		=>$urgentes,
			'numPage'		=>$offset,
			'priceFrom'		=>$priceFrom,
			'priceTo'		=>$priceTo,
			'total'			=>$nbr,
			'tri'			=>$tri,
			'filter'	 	=>$filter,
		);
        return $this->render('@Zandoo/Annonce/listerAnnonce.html.twig',$retour );
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
                if(is_null($annonce->getGenerateurId()) or empty($annonce->getGenerateurId())){
                    $gen = $this->get('zandoo_service_commun')->randomString().$annonce->getId();
                    $annonce->setGenerateurId($gen);
                }
                $em->flush();
                $this->addFlash('succesAnnonce', 'votre annonce a été enregistré avec succes!');
                if(!$this->getUser()){
                    return $this->redirectToRoute('login',array());
                }
                return $this->redirectToRoute('afficher_annonce',array('generateurId'=>$annonce->getGenerateurId()));
            }catch(Exception $e){
                sprintf("Une erreur technique: %s est survenue veuillez contacter l'administrateur ",$e) ;
            }
        }
        $retour = array('form' => $form->createView(),'colorBody' => "F7F7F7",'url_upload'=> $this->getParameter('url_upload'),
                        'proprietaireAnnonce'=> $this->estPropritaireAnnonce($annonce->getUtilisateur(),$this->getUser()));
        return $this->render('@Zandoo/Annonce/newAnnonce.html.twig',$retour);
    }

    /**
     * @Route("afficher/annonce/{generateurId}",  name="afficher_annonce")
     * @ParamConverter("annonce", class="ZandooBundle:Annonce", isOptional=true)
     *
     */
    public function afficherAnnonce(Request $request, $annonce){
        $em = $this->getDoctrine()->getManager();
        $critere = new Critere();
        $reponse = new JsonResponse;

        $critere->setCategorie($annonce->getCategorie()->getId())
                ->setType($annonce->getType());
        $annoncesSimilaires = $em->getRepository(Annonce::class)->findAnnonceByCritere($critere);
        $signalement = new Signalement();
        $options['motif'] = $em->getRepository(Motif::class)->findAll();
	$form = $this->createForm(FormSignalementType::class ,$signalement,$options);
        $form->handleRequest($request);

        $contatMessage = new Contact();
        $formContact = $this->createForm(FormContactType::class ,$contatMessage,array());
        $formContact->handleRequest($request);
        // Message pop-in signaler annonce
        if($request->isXmlHttpRequest() && $request->query->get('type') == 2){
            $retour = array('url'=>$this->generateUrl('afficher_annonce',array('generateurId'=>$annonce->getGenerateurId())),'form'=>$form->createView());
            if($form->isValid() && $form->isSubmitted()){
                $motif = $em->getRepository(Motif::class)->find($signalement->getMotif());
                $signalement->setMotif($motif);
                $signalement->setAnnonce($annonce);
                $content = array('template' => $this->renderView('@Zandoo/Commun/formSignalement.html.twig',$retour));
                $em->persist($signalement);
                $em->flush();
                $this->get('zandoo.mail')->sendMailSignalementMessage($annonce,$signalement);
                return $reponse->setData($content);
            }else{
                $reponse->setStatusCode(400);
                $retour['msgSignError']= "votre formulaire contient des erreurs ou Actualiser votre page (F5)";
                $content = array('template' => $this->renderView('@Zandoo/Commun/formSignalement.html.twig',$retour));
                return $reponse->setData($content);
            }
        }

        // Message contact proprietaire annonce
        if($request->isXmlHttpRequest() && $request->query->get('type') == 1){
            $retour = array('url'=>$this->generateUrl('afficher_annonce',array('generateurId'=>$annonce->getGenerateurId())),'formContact'=>$formContact->createView());
            if($formContact->isValid() && $formContact->isSubmitted()){
                $contatMessage->setAnnonce($annonce);
                $em->persist($contatMessage);
                $em->flush();
                $this->get('zandoo.mail')->sendMailContactMessage($annonce,$contatMessage);
                $retour['msgSuccess']= "Votre message est envoyé avec success";
                $content = array('template' => $this->renderView('@Zandoo/Commun/formContact.html.twig',$retour));
                return $reponse->setData($content);
            }else{
                $reponse->setStatusCode(400);
                $retour['msgError']= "votre formulaire contient des erreurs ou Actualiser votre page (F5)";
                $content = array('template' => $this->renderView('@Zandoo/Commun/formContact.html.twig',$retour));
                return $reponse->setData($content);
            }
        }
        if($annonce){
            $this->creerCompteurVisiteAnnonce($annonce,$em);
            $nbImg = count($annonce->getImages());
            $retour = array('annonce'=>$annonce,'formContact'=>$formContact->createView(),'form'=>$form->createView(),'colorBody'=>"F7F7F7"
                ,'nbImg'=>$nbImg,'url_upload'=>$this->getParameter('url_upload'),'annonSimilaires' => $annoncesSimilaires 
                ,'proprietaireAnnonce'=> $this->estPropritaireAnnonce($annonce->getUtilisateur(),$this->getUser()));
            return $this->render('@Zandoo/Annonce/annonce.html.twig',$retour);
        }else{
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException( 'Cette page n\'existe pas!');
        }
    }

    /**
     * @Route("desactiver/annonce/{id}", requirements={"id": "\d+"}, name="desactiver_annonce")
     *
     *
     */
    public function desactiverAnnonceAction(Request $request,$id){
       $em = $this->getDoctrine()->getManager();
       $annonce = $em->getRepository(Annonce::class)->find($id);
       $annonce->setActif(0);
       $em->flush();
       if(!empty($request->query->get('isUser'))){
           return $this->redirectToRoute('compte_utilisateurs',array('id'=>$this->getUser()->getId())) ;
       }else{
            return $retour = $annonce->getType() == 1 ?  $this->redirectToRoute('demandes'):$this->redirectToRoute('annonces');
       }
    }

    /**
     *
     *  @Route("comptes/{id}", name="compte_utilisateurs")
     *  @ParamConverter("utilisateur", class="ZandooBundle:Utilisateur", isOptional=true)
     *
     */
    public function annonceByUtilisateurAction(Request $request,$utilisateur){
        $em = $this->getDoctrine()->getManager();
        $repoAnnoce = $em->getRepository(Annonce::class);
        $encoder = $this->get('security.password_encoder');
        $critere = new Critere();
        $convert = $this->get(UtilisateurConvert::class);
        $utilisateurModif = $convert->convert($utilisateur);
        $form = $this->createForm(FormUtilisateurModificationType::class,$utilisateurModif,array('em'=>$em,'user'=>$utilisateur));
        $critere->setIdUtilisateur($utilisateur->getId());
	$annonces = $repoAnnoce->findAnnonceByCritere($critere);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() && $convert->convert($utilisateurModif,$utilisateur)){
            $em->flush();
            $this->addFlash('succesModif', "Vos modifications ont été éffectuées avec succès, Ces changements vous seront demandés lors de votre prochaine connexion");
        }
        $formPassword = $this->createForm(FormPasswordModificationType::class,null,array('em'=>$em,'user'=>$utilisateur,'encoder'=>$encoder));
        $formPassword->handleRequest($request);

        if($formPassword->isSubmitted() && $formPassword->isValid()){
            $newPass = $request->request->get('form_password_modification')['password'];
            $pwdEncod = $encoder->encodePassword($utilisateur,$newPass);
            $utilisateur->setPassword($pwdEncod);
            $em->flush();
            $this->get('zandoo.mail')->sendMail($utilisateur,$newPass);
            $this->addFlash('succesModif', "Votre mot de passe est modifié avec succès. un mail vient de vous être envoyé ,"
                            . "votre nouveau mot de passe vous sera demandé lors de la prochaine connexion");
        }
        $retour = array('annonces'=>$annonces,'utilisateur'=>$utilisateur,'form'=>$form->createView(),'formPassword'=>$formPassword->createView());
        return $this->render('@Zandoo/Annonce/utilisateurAnnonce.html.twig',$retour);
    }

    /**
     *  @Route("contact", name="contact")
     */
    public function contact(Request $request ){
        $nom = $request->request->get('nom');
        $telephone = $request->request->get('tel');
        $email = $request->request->get('email');
        $message = $request->request->get('message');
        $emailConstraint = new EmailConstraint();
        $reponse = new JsonResponse();

        $errors = $this->get('validator')->validate($email,$emailConstraint);

        $mailInvalid = count($errors) > 0;
        if(!empty($email) && !empty($message) && !$mailInvalid && ( is_numeric($telephone)|| empty($telephone)) ){
            $em = $this->getDoctrine()->getManager();
            $contatMessage = new Contact();
            $contatMessage->setEmail($email)
                       ->setDateEnvoi(new \DateTime())
                       ->setNom($nom)->setTelephone($telephone)
                       ->setMessage($message);
            $em->persist($contatMessage);
            $em->flush();
            $this->get('zandoo.mail')->sendMailUserContactMessage(null,$contatMessage);
            $reponse->setData(array('OK'));
        }else{
            $reponse->setStatusCode(400);
            $reponse->setData(array('NOK'));
        }
        return $reponse;

    }

    private function estPropritaireAnnonce ($utilisateAnnonce,$utilusateuConnecte){
         if($utilisateAnnonce == null){return true;}
         if($utilusateuConnecte != null && $utilisateAnnonce != null){return $utilusateuConnecte->getId() == $utilisateAnnonce->getId();}
    }
    // creer une nouvelle ligne dans nbre de visite par annonce
    private function creerCompteurVisiteAnnonce($annonce,$em){
        $now = new \DateTime();
        $tabId = array();
        $found = false;
        $visite = $em->getRepository(Visite::class)->findBy(array('ip'=>$_SERVER['REMOTE_ADDR']));
        if(is_array($visite) && !empty($visite)){
            foreach($visite as $v){
                $tabId[] = $v->getId();
            }
            //verifie si @dresse est attaché à l'annonce
            foreach ($annonce->getVisite() as $v){
               if(in_array($v->getId(), $tabId)){
                   $found = true;
               }
            }
            if(!$found){
                $annonce->setVisite($visite[0]);
                $em->flush();
            }
        }else{
                $visite = new Visite();
                $visite->setDateVisite($now)
                       ->setIp($_SERVER['REMOTE_ADDR']);
                $em->persist($visite);
                $em->flush();
                $annonce->setVisite($visite);
                $em->flush();
        }

//        $found = $annonce->getVisite()->map(function($a){
//            if($a->getIp() == $_SERVER['REMOTE_ADDR']) return $a;
//        })->last();
//        if((is_object($visite) && $visite instanceof Visite)){ //|| $found == false){
//         $interval = ($found == false) ? false : $this->dateIntervalToMinutes($now->diff($found->getDateVisite()));
//             if($found == false ){
//                $visite = new Visite();
//                $visite->setDateVisite($now)
//                       ->setIp($_SERVER['REMOTE_ADDR']);
//                $em->persist($visite);
//                $em->flush();
//        $found = false;
//        }
    }

    private function dateIntervalToMinutes(\DateInterval $dateInterval) {
        return (((int)$dateInterval->format('%y') * 365 * 24 * 60 * 60) +
               ((int)$dateInterval->format('%m') * 30 * 24 * 60 * 60) +
               ((int)$dateInterval->format('%d') * 24 * 60 * 60) +
               ((int)$dateInterval->format('%h') * 60 * 60) +
               ((int)$dateInterval->format('%i') * 60) +
               (int)$dateInterval->format('%s'))/60;
    }

    private function convertfiltreTocritere($tri,$critere){
        if($tri == 0){
           $critere->setPlusNouveau($tri);
        }
        if($tri == 1){
            $critere->setPlusAncien($tri);
        }
        if($tri == 2){
            $critere->setPrixCroisant($tri);
        }
        if($tri == 3){
            $critere->setPrixDecroissant($tri);
        }
    }
}
