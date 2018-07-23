<?php

namespace ZandooBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use ZandooBundle\Entity\Utilisateur;
use ZandooBundle\Form\FormUtilisateurType;

class UtilisateurController extends Controller
{	
     /**
     * @Route("/inscription",name="enregistrer_utilisateur")
     */
    public function inscription(Request $request){
        $utilisateur = new Utilisateur(); 
        $form = $this->createForm(FormUtilisateurType::class, $utilisateur, $options = array());
        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted()){
            //Enregistrment de l'annonce et de l'utilisateur
            $em = $this->getDoctrine()->getManager();
            $pwdEncoded = $this->get('security.password_encoder')->encodePassword($utilisateur, $utilisateur->getPassword());
            $utilisateur->setDateCreation(new \DateTime());
            $utilisateur->setPassword($pwdEncoded);
            $em->persist($utilisateur);              
            $em->flush();
            $this->get('session')->getFlashBag()->add('createUser', 'Votre compte a été créé avec succès');
            $this->addFlash('succes', 'Votre compte a été créé avec succès');
            return $this->redirectToRoute('login');
        }
        return $this->render('@Zandoo/inscription.html.twig',array('form'=>$form->createView()));
    }
    /**
     * @Route("/login",name="login")
     */
    public function loginAction(Request $request)
    {    
        // Si le visiteur est déjà identifié, on le redirige vers l'accueil
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
    
    /**
     * @Route("/generer-password",name="generer_password")
     */
    public function genererPasswordAction(Request $request)
    {   
        $form = $this->createFormBuilder()->add('email', EmailType::class,array('label'=>'Votre email',))->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $email = $request->request->all()['form']['email'];
            $utilisateur = $em->getRepository(Utilisateur::class)->findOneBy(array('email'=>$email));
            if($utilisateur){
               // envoi de mail et enregistrement de mot de passe provisoire
                $randPassword = $this->RandomString(); 
                $pwdEncoded = $this->get('security.password_encoder')->encodePassword($utilisateur,$randPassword);          
                $utilisateur->setPassword($pwdEncoded); 
                $em->flush();           
                //$this->get('zandoo.mail')->sendMail($email,$randPassword);
                $this->addFlash('succes', 'un email vous a été envoyer avec votre nouveau mot de passe verifiez votre spam!');
            }else{
                $this->addFlash('error', 'cet email n\'existe pas');
            }     
         } 
         return $this->render('@Zandoo/modifierPassword.html.twig', array('form'=>$form->createView())); 
    }
    
    /**
     * @Route("/modifier-password",name="modifier_password")
     */
    public function modifierPasswordAction(Request $request)
    {    
         $form = $this->createFormBuilder()
                 ->add('ancien_password',PasswordType::class,array(
                     'label'=>'Ancien mot de passe',
                 ))
                 ->add('nouveau_password',PasswordType::class,array(
                     'label'=>'Nouveau mot de passe',
                 ))
                 ->getForm();
         $form->handleRequest($request);
         if($form->isSubmitted()){       
              $ancien = $request->request->all()['form']['ancien_password'];
              $nouveau = $request->request->all()['form']['nouveau_password'];
              if($ancien != $nouveau && !empty($this->getUser())){
                  $em = $this->getDoctrine()->getManager();
                  $utilisateur = $em->getRepository(Utilisateur::class)->findOneBy(array('email'=>$this->getUser()->getEmail()));
                  $pwdEncoded = $this->get('security.password_encoder')->encodePassword($utilisateur,$nouveau);
                  $utilisateur->setPassword($pwdEncoded); 
                  $em->flush();
                  $this->addFlash('succes', 'votre mot de passe a été changé avec succès');
              }else{
                   $this->addFlash('error', 'connectez vous ou verifier que vos mot passes soit differents ');
              }
         }
         return $this->render('@Zandoo/modifierPassword.html.twig', array('form'=>$form->createView()));         
    }
      
    function RandomString(){
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';        
        $randstring = '';
        $retour = '';
        for ($i = 0; $i < 8; $i++) {
            $retour = $characters[rand(0, strlen($characters)-1)]; 
            $randstring .= $retour;
        }
        return $randstring;
    }
}
