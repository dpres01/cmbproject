<?php

namespace ZandooBundle\Form; 

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use ZandooBundle\Form\FormUtilisateurType;
use ZandooBundle\Form\FormImageType;
use Doctrine\ORM\EntityRepository;
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
            ->add('categorie', EntityType::class,array(
                'class' => 'ZandooBundle:Categorie',
                'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('c')
                            ->orderBy('c.numOrdre', 'ASC');
                    },
                 'choice_label' => 'libelle',
                 'required'=> true           
            )) 
            ->add('type',ChoiceType::class,array(
                 'choices' => array(
                       'Offre' => '0',
                       'Demande' => '1',
                    ),
                'expanded' =>true ,
                'label'=>false,
                'required'=> true
            ))                
            ->add('titre',TextType::class,array(
                'label' =>"Titre de l'annoonce",
                'required'=> true
            ))
            ->add('description', TextareaType::class,array(
                 'label' =>'Decrivez votre annonce (600 caractères max)',
                 'required'=> true                 
            ))
            ->add('prix',TextType::class,array(
                'required'=> false
            ))
            ->add('monnaie',ChoiceType::class,array(
                 'choices' => array(
                       'Fc' => '0',
                       '$' => '1',
                    ),
                'expanded' =>false ,
                'label'=>false
            ))                
            ->add('afficherTel',CheckboxType::class,array(
                'label'=>'Masquer le numéro de téléphone pour cette annoce',
                'required'=> false
            ))
            ->add('utilisateur',FormUtilisateurType::class,array(
                'label'=>false ,
                'required'=>false,
                'disabled' =>$options['connected']
            ))
           ->add('images',CollectionType::class,array(
                'entry_type' => FormImageType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'empty_data' => null,
                'label' => false,
                'required'=> false
          ))                  
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ZandooBundle\Entity\Annonce',
            'connected'=>false
        ));
    }
    
     public function getName(){
         return "annonceFormType";
     }
     
//     public function listeCategorieByFamille($famille,$categorie){
//         
//     }
}
