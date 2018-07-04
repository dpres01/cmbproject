<?php

namespace ZandooBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annonce
 *
 * @ORM\Table(name="ANNONCE")
 * @ORM\Entity(repositoryClass="ZandooBundle\Repository\AnnonceRepository")
 */
class Annonce
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
     * @var int
     *
     * @ORM\Column(name="titre", type="string")
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="actif", type="boolean")
     */
    private $actif;
    
     /**
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id",nullable=false)
     *
     * @var utilisateur
     */
    private $utilisateur;
    
    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="string", length=60,nullable=true)
     */
    private $prix;
    
    /**
     * @var string
     *
     * @ORM\Column(name="afficher_tel", type="string", length=255,nullable=true)
     */
    private $afficherTel;
    
    /**
     * @var string
     *
     * @ORM\Column(name="date_creation", type="date",nullable=false)
     */
    private $dateCreation;
    
    /**
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id",nullable=false)
     *
     * @var utilisateur
     */
    private $categorie;
     /**
     * @var bool
     *
     * @ORM\Column(name="type", type="boolean")
     */
    private $type = 0;// 0 = Annonce | 1 = Demande
    
    /**
     * @var string
     *
     * @ORM\Column(name="num_ordre", type="integer",nullable=true)
     */
    private $numOrdre ;

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
     * Set titre
     *
     * @param integer $titre
     *
     * @return Annonce
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    
        return $this;
    }

    /**
     * Get titre
     *
     * @return integer
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Annonce
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     *
     * @return Annonce
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
     * Set prix
     *
     * @param string $prix
     *
     * @return Annonce
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    
        return $this;
    }

    /**
     * Get prix
     *
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set afficherTel
     *
     * @param string $afficherTel
     *
     * @return Annonce
     */
    public function setAfficherTel($afficherTel)
    {
        $this->afficherTel = $afficherTel;
    
        return $this;
    }

    /**
     * Get afficherTel
     *
     * @return string
     */
    public function getAfficherTel()
    {
        return $this->afficherTel;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Annonce
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    
        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set numOrdre
     *
     * @param integer $numOrdre
     *
     * @return Annonce
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
     * Set utilisateur
     *
     * @param \ZandooBundle\Entity\Utilisateur $utilisateur
     *
     * @return Annonce
     */
    public function setUtilisateur(\ZandooBundle\Entity\Utilisateur $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;
    
        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \ZandooBundle\Entity\Utilisateur
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set categorie
     *
     * @param \ZandooBundle\Entity\Categorie $categorie
     *
     * @return Annonce
     */
    public function setCategorie(\ZandooBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;
    
        return $this;
    }

    /**
     * Get categorie
     *
     * @return \ZandooBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
    /**
     * Get type
     *
     * @return bool
     */
    function getType() {
        return $this->type;
    }
    /**
     * Set categorie
     *
     * @param  $type 
     *
     * @return $this
     */
    function setType($type) {
        $this->type = $type;
        return $this;
    }


}
