<?php
namespace ZandooBundle\Service;
 
use Doctrine\ORM\EntityManager;
use ZandooBundle\Entity\Ville;

class VilleExtension extends \Twig_Extension
{
     private $em;

    public function __construct(EntityManager $manager)
    {
        $this->em = $manager;
    }

    public function getFunctions()
    {     
        return array(
            new \Twig_SimpleFunction('listeVilles', array($this, 'listerVilles')),
        );
    }

    public function listerVilles()
    {	
        $listeVilles = $this->em->getRepository(Ville::class)->findAll();
        $liste = array();
        foreach($listeVilles as $ville){
	  $liste[$ville->getLibelle()]= $ville->getId() ;
        }
        return $liste;
    }
}


