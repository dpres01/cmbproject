<?php
namespace ZandooBundle\Service;
 
use ZandooBundle\Entity\SearchCategorie;
use Doctrine\ORM\EntityManager;
use ZandooBundle\Entity\Famille;
use ZandooBundle\Entity\Categorie;

class CategorieExtension extends \Twig_Extension
{
     private $em;

    public function __construct(EntityManager $manager)
    {
        $this->em = $manager;
    }

    public function getFunctions()
    {     
        return array(
            new \Twig_SimpleFunction('familleByCategorie', array($this, 'listeCategorieByFamille')),
        );
    }

    public function listeCategorieByFamille()
    {	
        $listeFamille = $this->em->getRepository(Famille::class)->findAll();
        $listeCategorie = $this->em->getRepository(Categorie::class)->findAll();
        $liste = array();
        foreach($listeFamille as $famille){
            foreach($listeCategorie as $categorie)
            {
                if($famille->getId() == $categorie->getFamille()->getId()){
		    $liste[$famille->getLibelle()][$categorie->getLibelle()] = $categorie->getId() ;
                }                 
            }
        }
        return $liste;
    }
}


