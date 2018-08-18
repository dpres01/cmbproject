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
        $typeImage = array('image/jpeg','image/jpg', 'image/gif', 'image/png','image/bmp','image/tiff','image/psd');
        $formatnonreconnu = false;
        //controle utilisateur connecté ou non
        if($annonce){
           if($annonce->getTitre() == NULL){
              $this->context->addViolation('Renseigner un titre à l\'annonce '); 
           }
           if($annonce->getDescription() == NULL){
              $this->context->addViolation('Renseigner une description à l\'annonce '); 
           }
           if($annonce->getCategorie()== NULL ){
              $this->context->addViolation('Renseigner une catégorie à l\'annonce '); 
           }
           if($annonce->getImages()!= NULL){
               foreach($annonce->getImages() as $image){
                  if($image->getFile()!= NULL && !in_array($image->getFile()->getMimeType(),$typeImage)) $formatnonreconnu = true;
               }
              if($formatnonreconnu)$this->context->addViolation('format des images acceptés : jpeg,jpg,gif,png,bmp,tiff,psd'); 
           }
        }
        //utilisateur non connecté
        if($annonce->getUtilisateur() != null && !is_object($this->token->getToken()->getUser())){
           if($annonce->getUtilisateur()->getVille() == NULL){
              $this->context->addViolation('Renseigner une ville '); 
           }
           if($annonce->getUtilisateur()->getAdresse() == NULL){
              $this->context->addViolation('Renseigner une adresse '); 
           }
           if($annonce->getUtilisateur()->getUsername() == NULL ){
              $this->context->addViolation('Renseigner un pseudo '); 
           }
           if($annonce->getUtilisateur()->getPassword() == NULL){
              $this->context->addViolation('Renseigner un mot de passe '); 
           }
           if($annonce->getUtilisateur()->getEmail() == NULL){
              $this->context->addViolation('Renseigner votre E-mail '); 
           }
           if($annonce->getUtilisateur()->getPassword()!= NULL && strlen($annonce->getUtilisateur()->getPassword()) < 8){
              $this->context->addViolation('Le mot de passe doit contenir 8 caractère minimum'); 
           }
            if($annonce->getUtilisateur()->getTelephone() == NULL){
              $this->context->addViolation('Renseigner un numero de téléphone '); 
           }
           if($annonce->getUtilisateur()->getIsProfessionnel() == NULL){
              $this->context->addViolation('Renseigner Type d\'utilisateur particulier ou professionnel'); 
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

