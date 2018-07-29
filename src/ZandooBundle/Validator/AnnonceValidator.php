<?php
namespace ZandooBundle\Validator;

use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;
use Doctrine\ORM\EntityManager;
use ZandooBundle\Entity\Annonce as annonceEntity;
use ZandooBundle\Entity\Utilisateur;

class AnnonceValidator extends ConstraintValidator
{
    private $em;
    public function __construct(EntityManager $em){
        $this->em = $em;
    }
    public function validate($annonce,Constraint $constraint ){  
        //dump($annonce,$this->em);
        
        if(!empty($annonce->getUtilisateur())){
           if(empty($annonce->getUtilisateur()->getPassword())){
              $this->context->addViolation('Renseigner un mot de passe '); 
           }
           $username =  $this->em->getRepository(Utilisateur::class)->findOneBy(array('username'=>$annonce->getUtilisateur()->getUsername()));
           $email =  $this->em->getRepository(Utilisateur::class)->findOneBy(array('email'=>$annonce->getUtilisateur()->getEmail()));
           if($username){
              $this->context->addViolation('Votre pseudo '. $annonce->getUtilisateur()->getUsername().' existe déjà'); 
           }
           if($email){
              $this->context->addViolation('Votre email '. $annonce->getUtilisateur()->getEmail().' existe déjà'); 
           }
           //dump($er);die;
           
        }
        
//        $sortantOtes = $ongletDetails->getSortantsOtes()->toArray();        
//        if($this->existenceDoublons($sortantOtes)){
//            $this->context->addViolation('erreur.onglets.details.sortants_otes.doublons');
//        }       
    }
    
    
}

