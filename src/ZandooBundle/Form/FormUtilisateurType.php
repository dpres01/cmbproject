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
use ZandooBundle\Entity\Utilisateur;



/**
 * Description of FormAnnonceType
 *
 * @author frup70988
 */
class FormUtilisateurType extends AbstractType 
{   
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        $builder 
            ->add('username',TextType::class,array(
                'label' =>"Pseudo *"                
            ))
             ->add('email',EmailType::class,array(
                'label' =>"Adresse e-mail *"                
            ))
           ->add('password',PasswordType::class,array(
                'label' =>"Mot de passe *"                
            ))          
            ->add('telephone',TelType::class,array(
                'label' =>"Téléphone *"
            ))
            ->add('adresse',TextType::class,array(
                'label' =>"Adresse *"              
            ))
            ->add('ville',TextType::class,array(
                'label' =>"Ville *"
            ))    
            ->add('isProfessionnel',ChoiceType::class,array(
                 'choices' => array(
                       'Particulier' => '0',
                       'Professionnel' => '1'
                    ),
                'expanded' =>true ,
                'label'=>false
            ))                
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Utilisateur::class,
            'connected'=>false
        ));
    }
     public function getName(){
         return "utilisateurFormType";
     }

}
