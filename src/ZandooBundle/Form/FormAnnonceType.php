<?php

namespace ZandooBundle\Form; 

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use ZandooBundle\Form\FormUtilisateurType;
use ZandooBundle\Form\FormImageType;
use Symfony\Component\Form\CallbackTransformer;

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
            ->add('categorie',ChoiceType::class,array(
                'choices'  =>$this->listeCategorieByFamille($options['famille'],$options['categorie']),               
                'expanded' =>false,
                'label'    =>false,
                'required' => true           
            )) 
            ->add('type',ChoiceType::class,array(
                'choices'    => array(
                'Offre' => '0',
                'Demande' => '1',
                ),
                'expanded' =>true ,
                'label'=>false,
                'required'=> true
            ))                
            ->add('titre',TextType::class,array(
                'label' =>"Titre de l'annonce",
                'required'=> true
            ))
            ->add('urgent',CheckboxType::class,array(
                'label' =>"Urgent",
                'required' =>false 
            ))    
            ->add('description', TextareaType::class,array(
                 'label' =>'Decrivez votre annonce (900 caractères max)',
                 'attr'=>array('maxlength'=>1000),
                 'required'=> true                 
            ))
            ->add('villeAnnonce',ChoiceType::class,array(
                'choices'  =>$this->listeVilles($options['ville']),        
                'expanded' =>false,
                'label'    =>false,
                'required'=> false                 
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
            ->add('cacherTel',CheckboxType::class,array(
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
         $builder->get('prix')
            ->addModelTransformer(new CallbackTransformer(
                function ($prixAsNumber) {
                    $prixAsNumber = (string)$prixAsNumber;
                    $strArray = array();
                    if( strlen($split = $prixAsNumber ) > 3){ 
                        $tab = array_reverse(str_split($split));
                        $nbTour = count($tab)/3;
                        $cpt = 1;
                        foreach($tab as $value){
                            $strArray[] = $value;                    
                            if($cpt%3 == 0 && $nbTour > 1){
                                $strArray[] = '.'; 
                                $nbTour--;
                            }                               
                            $cpt++;
                        }
                    $prixAsNumber = implode('',array_reverse($strArray));           
                }
                return $prixAsNumber;
                },
                function ($prixAsString) {                   
                    if(strpos($prixAsString,',')){
                        return implode('',explode(',', $prixAsString));
                    }
                    if(strpos($prixAsString,'.')){
                        return implode('',explode('.', $prixAsString));
                    }
                    return (int)$prixAsString;
                }
            ));
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ZandooBundle\Entity\Annonce',
            'connected'=>false,
            'categorie'=>null,
            'famille'=>null,
            'ville'=>null
        ));
    }
    
     public function getName(){
         return "annonceFormType";
     }
     
    public function listeCategorieByFamille($listeFamille,$listeCategorie)
	{		
        $liste = array("Choississez une categorie" => "");
        foreach($listeFamille as $famille)
		{
            foreach($listeCategorie as $categorie)
			{
                if($famille->getId() == $categorie->getFamille()->getId()){
		    $liste[$famille->getLibelle()][$categorie->getLibelle()] = $categorie->getId() ;
                }                 
            }
        }
        return $liste;
    }
    // liste de villes
    public function listeVilles($listeVilles)
	{		
        $liste = array("Choissisez une ville(si differente de celle de l'utilisateur)" => "");
        foreach($listeVilles as $ville){    
	  $liste[$ville->getLibelle()] = $ville->getId() ;
        }                 
        return $liste;
    }
}
