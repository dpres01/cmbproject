<?php

namespace ZandooBundle\Form; 

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('pseudo',TextType::class,array(
                'label' =>"Pseudo *"
            ))
             ->add('email',TextType::class,array(
                'label' =>"Adresse e-mail"
            ))
           ->add('password',TextType::class,array(
                'label' =>"Mot de passe"
            )) 
           
            ->add('telephone',TextType::class,array(
                'label' =>"Téléphone"
            ))
            ->add('adresse',TextType::class,array(
                'label' =>"Adresse"
            ))
            ->add('ville',TextType::class,array(
                'label' =>"Ville"
            ))    
            ->add('isProfessionnel',ChoiceType::class,array(
                 'choices' => array(
                       'Particulier' => '0',
                       'Professionnel' => '1',
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
        ));
    }
     public function getName(){
         return "utilisateurFormType";
     }

}
