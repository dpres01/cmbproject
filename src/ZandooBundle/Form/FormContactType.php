<?php
namespace ZandooBundle\Form; 

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use ZandooBundle\Entity\Contact;

/**
 * Description of FormPasswordModificationType
 *
 * @author frup70988
 */
class FormContactType extends AbstractType 
{   
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        $builder 
            ->add('nom',TextType::class,array(
                'label' => false, 
                'attr'=>array(
                    'placeholder'=>"Votre Nom*"
            )))
             ->add('email',TextType::class,array(
                'label' =>false ,
                'attr'=>array(
                    'placeholder'=>"Votre e-mail*"
            )))
             ->add('telephone',TextType::class,array(
                'label' =>false ,
                'attr'=>array(
                    'placeholder'=>"Votre telephone (optionnel)"
             )))
            ->add('message',TextareaType::class,array(
                'label' =>false ,
                'attr'=>array(
                    'placeholder'=>"Votre message*"
            ))) ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults( array(
          'data_class'=> Contact::class,
           'labe' =>false
        ));
    }
    public function getName(){
         return "formContact";
    }
    
}
