<?php

namespace ZandooBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class UtilisateurController extends Controller
{	
     
    /**
     * @Route("/login",name="login")
     */
    public function loginAction(Request $request)
    {    
            // Si le visiteur es t déjà identifié, on le redirige vers l'accueil
            if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
              return $this->redirectToRoute('enregistrer_annonce');
            }

            // Le service authentication_utils permet de récupérer le nom d'utilisateur
            // et l'erreur dans le cas où le formulaire a déjà été soumis mais était invalide
            // (mauvais mot de passe par exemple)
            $authenticationUtils = $this->get('security.authentication_utils');

            return $this->render('@Zandoo/connexion.html.twig', array(
              'last_username' => $authenticationUtils->getLastUsername(),
              'error'         => $authenticationUtils->getLastAuthenticationError(),
            ));	
    } 
    
    
}