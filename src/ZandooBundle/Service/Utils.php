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

    public function countCategorieByFamille($categorie)
    {	
        $listeCategorie = $this->em->getRepository(Categorie::class)->findAll();
        $critere  = new \ZandooBundle\Entity\Critere();
        $critere->setCategorie($categorie);
        $nbannonces = $this->em->getRepository(Annonce::class)->nbAnnoncesByCategorie($critere);
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
                if(!is_null($annonce->getVilleAnnonce()) && $ville->getId() == $annonce->getVilleAnnonce()->getId() && $annonce->getActif()){
                    $liste[$ville->getId()][$ville->getLibelle()] = $t++;  //$ville->getId();
                }
                if(is_null($annonce->getVilleAnnonce()) &&  $ville->getId() == $annonce->getUtilisateur()->getVille()->getId() && $annonce->getActif()){
                    $liste[$ville->getId()][$ville->getLibelle()] = $t++; 
                }   
            } 
            
        }        
        return $liste;
    }
    
    public function formattePrixAnnonce($annonce){
        $prixAsNumber = (string)$annonce->getPrix();
        if( strlen($split = $prixAsNumber ) > 3){ 
    
                        $tab = array_reverse(str_split($split));
                        $nbTour = count($tab)/3;
                        $cpt = 1;
                        foreach($tab as $value){
                            $strArray[] = $value;                    
                            if($cpt%3 == 0 && $nbTour > 1){
                                $strArray[] = '.'; 
                            }                               
                            $cpt++;
                        }
                    $prixAsNumber = implode('',array_reverse($strArray));
                    $annonce->setPrix($prixAsNumber);
        }
        return $annonce;
    }
}


