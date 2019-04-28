<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use ZandooBundle\Entity\Annonce;
use ZandooBundle\Entity\Utilisateur;
use ZandooBundle\Entity\Critere;
use ZandooBundle\Entity\Signalement;


class DefaultController extends Controller
{
    private $em ;
    
    public function __construct(EntityManagerInterface $entityManager ){
        $this->em = $entityManager;
    }
    /**
     * @Route("/admin",name="tableauBord")
     */
    public function tableauBordAction(){
        $annonces = $this->em->getRepository(Annonce::class)->findAll(); 
        $cptAnnoNonActif = 0;  
        foreach($annonces as $annonce){
            if(!$annonce->getActif())$cptAnnoNonActif++;
        }
        $totalAnno  = count($annonces);
        $nbAnnoActif = (100*($totalAnno - $cptAnnoNonActif))/$totalAnno;
        $nbAnnoNonActif = (100 * $cptAnnoNonActif)/$totalAnno;
       
        $users = $this->em->getRepository(Utilisateur::class)->findAll();
        $totalUser = count($users);            
        $cptUser= 0; 
        foreach($users as $user){
            if(!$user->getActif())$cptUser++;
        }
        $nbUserActif = (100*($totalUser-$cptUser))/$totalUser;
        $nbUserNonActif = (100*$cptUser)/$totalUser;
        
        $signalement = $this->em->getRepository(Signalement::class)->findAll();
        $array = [];
        foreach($signalement as $signal){
              $array[] =  $signal->getAnnonce()->getId();      
        }
        $nbSignaler = count(array_unique($array));
        $purcentSignal = (100*$nbSignaler)/$totalUser;
        $retour = [
            'totalAnno'=>$totalAnno,
            'totalUser'=>$totalUser,
            'nbAnnoActif'=>$nbAnnoActif,
            'cptAnnoNonActif'=>$cptAnnoNonActif,
            'nbAnnoNonActif'=>$nbAnnoNonActif,
            'nbUserNonActif'=>$nbUserNonActif,
            'nbUserActif'=>$nbUserActif,
            'cptUser'=>$cptUser,
            'nbSignaler'=>count(array_unique($array)),
            'purcentSignal'=>$purcentSignal
            ];
        return $this->render('AdminBundle:Default:index.html.twig',$retour);
    }
    
     /**
     * @Route("/admin/annonces/{id}",defaults={"id": null},name="annocesAdmin")
     * @ParamConverter("annonce", class="ZandooBundle:Annonce", isOptional=true)
     * 
     */
    public function listeAnnoncesAction(Request $request, $annonce){
        $annonces = $this->em->getRepository(Annonce::class)->findAll();    
        $signalement = $this->em->getRepository(Signalement::class)->findAll();
        $isActif = $request->request->get('actif')!== null;
        $isVendu = $request->request->get('vendu')!== null;
        //dump($annonce,$isActif,$isVendu);die;
        if($annonce){     
            //!$isVendu ? $annonce->setVendu(false) : $annonce->setVendu(true);
            !$isActif ? $annonce->setActif(false) : $annonce->setActif(true);
            //dump($annonce);
            $this->em->flush();
            //dump($annonce,$isActif,$isVendu);die;
        }
       
        $retour = [
                    'annonces'=>$annonces,
                    'signaler'=>$signalement,
                    'url' => $this->generateUrl('annocesAdmin')
                ];
        return $this->render('AdminBundle:Default:annonces.html.twig',$retour);
    }
    
    /**
     *  @Route("/admin/utilisateur/{id}",defaults={"id": null},name="utilisateurAdmin")
     *  @ParamConverter("utilisateur", class="ZandooBundle:Utilisateur", isOptional=true)
     * 
     */
    public function listeUtilisateurAction(Request $request, $utilisateur){
        $users = $this->em->getRepository(Utilisateur::class)->findAll();
        $isAdmin = $request->request->get('admin') !== null; 
        $isProfessionnel = $request->request->get('professionnel')!== null ;
        $isActif = $request->request->get('actif')!== null;
        if($utilisateur && ($isAdmin || $isProfessionnel || $isActif )){     
            $utilisateur->setIsAdmin($isAdmin);
            $utilisateur->setIsProfessionnel($isProfessionnel);
            $utilisateur->setActif($isActif);
            $this->em->flush();
        }
        $retour = [
            'users'=>$users,
            'url' => $this->generateUrl('utilisateurAdmin')
            ];
        return $this->render('AdminBundle:Default:users.html.twig',$retour);
    }
}
