<?php

namespace ZandooBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annonce
 *
 * @ORM\Table(name="FAMILLE")
 * @ORM\Entity(repositoryClass="ZandooBundle\Repository\CategorieRepository")
 */
class Famille
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
     * @var bool
     *
     * @ORM\Column(name="actif", type="boolean")
     *
     */
    private $actif;
    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string",length=255)
     *
     */
    private $libelle;
     /**
     * @var int
     *
     * @ORM\Column(name="num_ordre", type="integer")
     *
     */
    private $numOrdre;

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
     * @return Famille
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
     * @return Famille
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
     * Set numOrdre
     *
     * @param integer $numOrdre
     *
     * @return Famille
     */
    public function setNumOrdre($numOrdre)
    {
        $this->numOrdre = $numOrdre;
    
        return $this;
    }

    /**
     * Get numOrdre
     *
     * @return integer
     */
    public function getNumOrdre()
    {
        return $this->numOrdre;
    }
}
