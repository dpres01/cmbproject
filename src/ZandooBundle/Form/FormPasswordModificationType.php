<?php
namespace ZandooBundle\Form; 

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use ZandooBundle\Entity\Utilisateur;



/**
 * Description of FormPasswordModificationType
 *
 * @author frup70988
 */
class FormPasswordModificationType extends AbstractType 
{   
    private $em;
    private $user;
    private $encoder;
    private $message = "le mot de passe doit contenir 8 caratère au minimum";
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        $this->em = $options['em'];
        $this->user = $options['user'];
        $this->encoder = $options['encoder'];
        $findPseudo = function($string,ExecutionContextInterface $context){
            $encode = $this->encoder->encodePassword($this->user,$string);
            $ret = $this->em->getRepository(Utilisateur::class)->findOneBy(array('id'=>$this->user->getId(),'password'=>$encode));
            strlen($string) < 8 ? $context->addViolation($this->message):null;
            empty($ret) ? $context->addViolation("Mot de passe incorrect"): null;      
        };
        
        $CompareString = function($string,ExecutionContextInterface $context){
            $data = $context->getRoot()->getData();
            if (!array_key_exists('password', $data)){
                return;
            }
            $password = $data['password'];
            strlen($string) < 8 ? $context->addViolation($this->message):null;
            $password != $string ? $context->addViolation("Ce Mot de passe est different"):null;
        };
        
        $builder 
            ->add('passwordOld',TextType::class,array(
                'label' =>"Ancien Mot de passe *" ,               
                'constraints'=> array(  
                    new Callback($findPseudo)
                )
            ))
             ->add('password',TextType::class,array(
                'label' =>"Nouveau Mot de passe *" ,
                'constraints'=> array(
                     new Callback(function($string,ExecutionContextInterface $context){
                         strlen($string) < 8 ? $context->addViolation($this->message):null; 
                     }),
                )
            ))
             ->add('passwordConfirm',TextType::class,array(
                'label' =>"Confirmer votre Mot de passe *" ,
                'constraints'=> array(
                    new Callback($CompareString)
                )
            ));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'em'=>null,
            'user'=>null,
            'encoder'=>null
        ));
    }
    public function getName(){
         return "formPasswordModification";
    }
    

}
