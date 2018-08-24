<?php

namespace ZandooBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annonce
 *
 * @ORM\Table(name="Ville")
 * @ORM\Entity(repositoryClass="ZandooBundle\Repository\VilleRepository")
 */
class Ville
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
     * @ORM\Column(name="code_postal", type="string")
     */
    private $codePostal;
    
    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string",length=255)
     */
    private $libelle;// particulier,professionnel  

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
     * @return string
     */
    function getCodePostal() {
        return $this->codePostal;
    }
    /**
     * 
     * @param type $codePostale
     */
    function setCodePostal($codePostal) {
        $this->codePostal = $codePostal;
        return $this;
    }


}
