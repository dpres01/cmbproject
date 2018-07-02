<?php

namespace ZandooBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use ZandooBundle\Entity\Annonce;
use ZandooBundle\Form\FormAnnonceType;

class ZandooController extends Controller
{
    /**
     * @Route("/zando-index")
     */
    public function indexAction()
    {    
        $em = $this->getDoctrine()->getManager();
        $test =  $em->getRepository('\ZandooBundle\Entity\Categorie')->findCategorieByFamille();
        dump($test);die;
        return $this->render('@Zandoo/Default/index.html.twig');
    }
    
    /**
     * @Route("/annonce")
     */
    public function depotAnnoce(Request $request){
        $annonce = new Annonce(); 
        $form = $this->createForm( FormAnnonceType::class, $annonce, $options = array());
        return $this->render('@Zandoo/Default/index.html.twig',array('form'=>$form->createView()));
    }
}
