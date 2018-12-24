<?php
namespace ZandooBundle\Service;
 
use Doctrine\ORM\EntityManager;
use ZandooBundle\Entity\Famille;
use ZandooBundle\Entity\Categorie;
use ZandooBundle\Entity\Annonce;
use ZandooBundle\Entity\Ville;

class Utils 
{
     private $em;

    public function __construct(EntityManager $manager)
    {
        $this->em = $manager;
    }

    public function countCategorieByFamille()
    {	
        $listeCategorie = $this->em->getRepository(Categorie::class)->findAll();
        $nbannonces = $this->em->getRepository(Annonce::class)->nbAnnoncesByCategorie();
        $liste = array();
        foreach($listeCategorie as $categorie){
                $liste[$categorie->getId()] = array($categorie->getLibelle(),0);
                foreach($nbannonces as $nbannonce){
                    if( $categorie->getId() == $nbannonce[0]->getCategorie()->getId()){
                        $liste[$categorie->getId()] = array($categorie->getLibelle(), $nbannonce[1]);
                    }                 
                }
        }
        return $liste;
    }
    
    public function countAnnonceByVille(){
        $listeAnnonce = $this->em->getRepository(Annonce::class)->findAll();
        $listeVille = $this->em->getRepository(Ville::class)->findAll();
        $liste = array();
        $init = 0;
        foreach($listeVille as $ville){
            $t = 1; 
            $liste[$ville->getId()][$ville->getLibelle()] = $init; 
            foreach ($listeAnnonce as $annonce){
                if($ville->getId() == $annonce->getVilleAnnonce()->getId() ){
                    $liste[$ville->getId()][$ville->getLibelle()] = $t++;  //$ville->getId();
                }
                if(is_null($annonce->getVilleAnnonce()) &&  $ville->getId() == $annonce->getUtilisateur()->getVille()->getId()){
                    $liste[$ville->getId()][$ville->getLibelle()] = $t++; 
                }   
            } 
            
        }        
        return $liste;
    }  
}


