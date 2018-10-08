<?php
namespace ZandooBundle\Form; 

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use ZandooBundle\Entity\Signalement;

/**
 * Description of FormAnnonceType
 *
 *
 */
class FormSignalementType extends AbstractType 
{   
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        $builder->add('motif',ChoiceType::class,array(
                'choices' => $this->listeMotif($options['motif']),
                'expanded' =>true ,
                'label'=>false,
                'required'=> true
            ))
            ->add('nom',TextType::class,array(
                'label' =>"Nom *"                
            )) 
             ->add('email',EmailType::class,array(
                'label' =>"Adresse e-mail *"                
            ))                  
            ->add('message',TextareaType::class,array(
                'label' =>"Message *"
            ));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Signalement::class,
            'motif'=>null
        ));
    }
    public function getName(){
         return "signalementFormType";
    }
     
    private function listeMotif($listeMotif){
        $tab = [];
        foreach($listeMotif as $motif){
            $tab[$motif->getLibelle()] = $motif->getId();
        }
        return $tab;
    }
}
