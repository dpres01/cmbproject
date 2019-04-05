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
        return $this->render('AdminBundle:Default:index.html.twig',['annonces'=>$annonces]);
    }
    
     /**
     * @Route("/admin/annonces",name="annocesAdmin")
     */
    public function listaAnnoncesAction(){
        $annonces = $this->em->getRepository(Annonce::class)->findAll();     
        return $this->render('AdminBundle:Default:index.html.twig',['annonces'=>$annonces]);
    }
    
    /**
     *  @Route("/admin/utilisateur/{id}",defaults={"id": null},name="utilisateurAdmin")
     *  @ParamConverter("utilisateur", class="ZandooBundle:Utilisateur", isOptional=true)
     * 
     */
    public function listeUtilisateurAction(Request $request,$utilisateur){
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
