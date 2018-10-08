<?php
 namespace ZandooBundle\Service;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 class Mail{
     
     public function sendMail($destinataire,$randPassword){
        $subject = 'changement de mot de passe';
        $message = 'Bonjour votre nouveau mot de passe est'.$randPassword.'\n ce ci est un mail automatique inutile d\'y repondre';
        $headers = array(
           'From' => 'webmaster@example.com',
           'Reply-To' => 'webmaster@example.com',
           'X-Mailer' => 'PHP/' . phpversion()
       );

       mail($destinataire, $subject, $message, 'webmaster@example.com');//$headers);
         
     }
 }


