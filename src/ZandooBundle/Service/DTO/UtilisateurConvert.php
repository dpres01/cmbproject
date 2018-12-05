<?php
namespace ZandooBundle\Service\DTO;

use ZandooBundle\Entity\UtilisateurModification;
use ZandooBundle\Entity\Utilisateur;


class UtilisateurConvert
{
    public function convert($utilisateur,$user = null){
        if($utilisateur instanceof Utilisateur && is_null($user)){
            $user = new UtilisateurModification();
            $user->setAdresse($utilisateur->getAdresse())
                ->setUsername($utilisateur->getUsername())
                ->setEmail($utilisateur->getEmail())
                ->setVille($utilisateur->getVille())
                ->setTelephone($utilisateur->getTelephone())
                ->setIsProfessionnel($utilisateur->getIsProfessionnel());
        }
        if($utilisateur instanceof UtilisateurModification && !is_null($user)){
           $ret = false;
           if((string)$utilisateur !== (string)$user){
               $user->setAdresse($utilisateur->getAdresse())
                ->setUsername($utilisateur->getUsername())
                ->setEmail($utilisateur->getEmail())
                ->setVille($utilisateur->getVille())
                ->setTelephone($utilisateur->getTelephone())
                ->setIsProfessionnel($utilisateur->getIsProfessionnel());
               $ret = true;
           } 
          $user = $ret; 
        }
        return $user; 
             
    }
  
}

