<?php
namespace ZandooBundle\Form; 

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use ZandooBundle\Entity\UtilisateurModification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use ZandooBundle\Entity\Utilisateur;



/**
 * Description of utilisateurModificationFormType
 *
 * @author frup70988
 */
class FormUtilisateurModificationType extends AbstractType 
{   
    private $em;
    private $user;
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        $this->em = $options['em'];
        $this->user = $options['user'];
        $findPseudo = function($string,ExecutionContextInterface $context){
            $ret = $this->em->getRepository(Utilisateur::class)->finUserByPseudoOrEmail($string);
            !empty($ret) && ($this->user->getUsername() != $ret->getUsername() || $this->user->getEmail() != $ret->getEmail() ) ? $context->addViolation("cette valeur existe"): null;      
        };
        $builder 
            ->add('username',TextType::class,array(
                'label' =>"Pseudo *" ,
                'constraints'=> array(
                    new Callback($findPseudo)
                )
            ))
            ->add('email',EmailType::class,array(
                'label' =>"Adresse e-mail *" ,
                'constraints'=> array(
                    new Callback($findPseudo)
                )
            ))                   
            ->add('telephone',TelType::class,array(
                'label' =>"Téléphone *"
            ))
            ->add('adresse',TextType::class,array(
                'label' =>"Adresse *"              
            ))
            ->add('ville',EntityType::class,array(
                'class'  =>  \ZandooBundle\Entity\Ville::class,        
                'choice_label' =>"libelle",
                'label' =>"ville *",
                'placeholder' => "Choississez une ville",
                'expanded' =>false,
                'required'=> false                  
            ))        
                    
            ->add('isProfessionnel',ChoiceType::class,array(
                 'choices' => array(
                       'Particulier' => '0',
                       'Professionnel' => '1'
                    ),
                'empty_data' => 'Particulier',
                'expanded' =>true ,
                'label'=>false,
                'required'=> true
            ))                
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => UtilisateurModification::class,
            'disabledPassword' => false,
            'liste_ville' => null,
        ))->setRequired('em')->setRequired('user');
    }
    public function getName(){
         return "utilisateurModificationFormType";
    }
    

}
