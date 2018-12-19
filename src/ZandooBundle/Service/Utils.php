<?php
namespace ZandooBundle\Service;
 
use Doctrine\ORM\EntityManager;
use ZandooBundle\Entity\Famille;
use ZandooBundle\Entity\Categorie;
use ZandooBundle\Entity\Annonce;

class Utils 
{
     private $em;

    public function __construct(EntityManager $manager)
    {
        $this->em = $manager;
    }

    public function CountCategorieByFamille()
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
   
}


