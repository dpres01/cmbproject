<?php

namespace ZandooBundle\Form; 

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use ZandooBundle\Entity\Annonce;


/**
 * Description of FormAnnonceType
 *
 * @author frup70988
 */
class FormAnnonceType extends AbstractType 
{
     
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('categorie') 
            ->add('titre')
            ->add('description',TextareaType::class,array())
            //->add('actif')
            ->add('prix')
            ->add('afficherTel')
            //->add('utilisateur')
            //->add('dueDate', null, array('widget' => 'single_text'))
            //->add('save', SubmitType::class)
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ZandooBundle\Entity\Annonce',
        ));
    }
     public function getName(){
         return "annonceFormType";
     }
}
