<?php
 namespace ZandooBundle\Service;
 
 use  Symfony\Bundle\TwigBundle\TwigEngine;

 class Mail{
     private $mailer;
     public $templating;

     public function __construct(\Swift_Mailer $mailer,TwigEngine $template){
        $this->mailer = $mailer;
        $this->templating = $template;
     }
     
     public function sendMail($destinataire,$randPassword){
        $subject = 'Changement de mot de passe';
        $message = "Bonjour votre nouveau mot de passe est.$randPassword.<br/><p> ce ci est un mail automatique inutile d'y repondre <p>
                   <br/><p> <a href='http://82.165.65.236/cmbproject/web/app.php'> Aller sur Zandoo </a></p>";
        $headers = array(
           'From' => 'zando-admin@gmail.com',
           'Reply-To' => 'zando-admin@gmail.com',
           'X-Mailer' => 'PHP/' . phpversion()
       );

       mail($destinataire, $subject, $message, 'webmaster@example.com');//$headers);
         
     }
     
     public function sendInitAccountEmail($utilisateur,$randPassword){
        $subject = 'Création de votre compte';
        $message = "Bonjour <br/> Votre compte est bien créé avec </br>
                   Identifiant : ".$utilisateur->getUsername()."".
                   "Mot de Passe : ".$randPassword ."".
                   "<p> ce ci est un mail automatique inutile d'y repondre <p>
                   <p><a href='http://82.165.65.236/cmbproject/web/app.php'> Aller sur Zandoo </a></p>";   
        $headers = array(
           'From' => 'zando-admin@gmail.com',
           'Reply-To' => 'zando-admin@gmail.com',
           'X-Mailer' => 'PHP/' . phpversion()
       );
     
         
//        $message = (new \Swift_Message('Création de votre compte'))              
//        ->setFrom('zando-admin@gmail.com')
//        ->setTo($utilisateur->getEmail())
//        ->setBody(
//            $this->templating->render(
//                '@Zandoo/Emails/creationUtilisateur.html.twig',
//                array('utilisateur' => $utilisateur)
//            ),
//            'text/html'
//        );
//       $this->mailer->send($message); 
//       
       
       mail($utilisateur->getEmail(), $subject, $message, 'zando-admin@gmail.com');//$headers);
         
     }
 }


