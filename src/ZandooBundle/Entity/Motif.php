<?php

namespace ZandooBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Motif
 *
 * @ORM\Table(name="MOTIF")
 * @ORM\Entity(repositoryClass="ZandooBundle\Repository\MotifRepository")
 */
class Motif
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="actif", type="boolean")
     */
    private $actif;
    
    /**
     * @var string
     *
     * @ORM\Column(name="date_creation", type="date")
     */
    private $dateCreation;
    
    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string",length=255)
     */
    private $libelle;// 
    
    public function __construct() {
        $this->dateCreation = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     *
     * @return Profil
     */
    public function setActif($actif)
    {
        $this->actif = $actif;
    
        return $this;
    }

    /**
     * Get actif
     *
     * @return boolean
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Profil
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    
        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
    /**
     * 
     * @return dateCreation
     */
    public function getDateCreation() {
        return $this->dateCreation;
    }
    /**
     * 
     * @param type $dateCreation
     */
    public function setDateCreation($dateCreation) {
        $this->dateCreation = $dateCreation;
        return $this;
    }


}
