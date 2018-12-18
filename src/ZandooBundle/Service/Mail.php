<?php
 namespace ZandooBundle\Service;
 
 use Symfony\Bundle\TwigBundle\TwigEngine;
 use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

 class Mail{
    private $mailer;
    public $templating;

    public function __construct(\Swift_Mailer $mailer,TwigEngine $template){
        $this->mailer = $mailer;
        $this->templating = $template;
    }
     
    public function sendMail($utilisateur,$randPassword){
  
        $message = (new \Swift_Message('Changement de mot de passe'))              
             ->setFrom($_SERVER["SERVER_ADMIN"])
             ->setTo($utilisateur->getEmail())
             ->setBody(
                 $this->templating->render(
                     '@Zandoo/Emails/modificationPassword.html.twig',
                     array( 
                             'utilisateur' =>$utilisateur,
                             'password'=>$randPassword
                )),'text/html');
        $this->mailer->send($message);                    
    }
     
    public function sendInitAccountEmail($utilisateur,$passWord){
        try{   
            $message = (new \Swift_Message('Création de votre compte'))              
                 ->setFrom($_SERVER["SERVER_ADMIN"])
                 ->setTo($utilisateur->getEmail())
                 ->setBody(
                     $this->templating->render(
                         '@Zandoo/Emails/creationUtilisateur.html.twig',
                         array(
                                'utilisateur' => $utilisateur,
                                'password'=>$passWord)
                     ),
                     'text/html'
                 );
                $this->mailer->send($message); 
                return 1;
            }catch(\ Exception $e){
                return 0;
        }             
    }
    
    public function sendMailContactMessage($annonce,$contatMessage){
         try{  
         $destinateur = $annonce->getUtilisateur()->getEmail(); 
       
         $message = (new \Swift_Message('Message de contact pour l\'annonce '.$annonce->getTitre() ))              
                 ->setFrom($_SERVER["SERVER_ADMIN"])
                 ->setTo($destinateur)
                 ->setBody(
                     $this->templating->render(
                        '@Zandoo/Emails/messageContact.html.twig',
                        array(
                                'annonce' => $annonce,
                                'messageContact'=>$contatMessage)
                     ),
                     'text/html'
                 );           
                $this->mailer->send($message); 
                return 1;
            }catch(\ Exception $e){
                return 0;
        }        
    }
    
    public function sendMailSignalementMessage($annonce,$messageSignalement){
        try{ 
           
            $message = (new \Swift_Message('Message de Signalement pour l\'annonce '.$annonce->getTitre() ))              
                 ->setFrom($_SERVER["SERVER_ADMIN"])
                 ->setTo('chirac.mbala@gmail.com')
                 ->setBody(
                     $this->templating->render(
                        '@Zandoo/Emails/messageSignalement.html.twig',
                        array(
                                'annonce' => $annonce,
                                'messageSignalement'=>$messageSignalement)
                     ),
                     'text/html'
                 );               
                $this->mailer->send($message); 
                return 1;
              }catch(\ Exception $e){               
            return 0;
        }        
    }
    
 }


