<?php

namespace ZandooBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annonce
 *
 * @ORM\Table(name="entity_annonce")
 * @ORM\Entity(repositoryClass="ZandooBundle\Repository\CategorieRepository")
 */
class Utilisateur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    private $pseudo;
    
    private $email;
    
    private $adresse;
    
    private $profil;
    
    private $telephone;
    
    private $ville;
    
    private $profil;
    
    private $actif;
    
    private $numOrdre;
    
    private $dateCreation;
  
}

