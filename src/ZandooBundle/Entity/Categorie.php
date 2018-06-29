<?php

namespace ZandooBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annonce
 *
 * @ORM\Table(name="CATEGORIE")
 * @ORM\Entity(repositoryClass="ZandooBundle\Repository\CategorieRepository")
 */
class Categorie
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
     * @ORM\Column(name="libelle", type="string")
	 */
    private $libelle;
	
    /**
     * @ORM\ManyToOne(targetEntity="Famille")
     * @ORM\JoinColumn(name="famille_id", referencedColumnName="id")
     *
     * @var famille
     */
    private $famille; 
    /**
     * @var int
     *
     * @ORM\Column(name="numOrdre", type="integer")
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
     * @return Categorie
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
     * @return Categorie
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
     * @return Categorie
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

    /**
     * Set famille
     *
     * @param \ZandooBundle\Entity\Famille $famille
     *
     * @return Categorie
     */
    public function setFamille(\ZandooBundle\Entity\Famille $famille = null)
    {
        $this->famille = $famille;
    
        return $this;
    }

    /**
     * Get famille
     *
     * @return \ZandooBundle\Entity\Famille
     */
    public function getFamille()
    {
        return $this->famille;
    }
}
