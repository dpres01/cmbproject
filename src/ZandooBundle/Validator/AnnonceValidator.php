<?php
namespace ZandooBundle\Validator;

use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\ORM\EntityManager;
use ZandooBundle\Entity\Annonce as annonceEntity;
use ZandooBundle\Entity\Utilisateur;

class AnnonceValidator extends ConstraintValidator
{
    private $em;
    private $token;
    public function __construct(EntityManager $em, TokenStorage $token){
        $this->em = $em;
        $this->token = $token;
    }
    public function validate($annonce,Constraint $constraint ){ 
        if($annonce->getUtilisateur() != null && !is_object($this->token->getToken()->getUser())){
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
        }               
    }    
}

