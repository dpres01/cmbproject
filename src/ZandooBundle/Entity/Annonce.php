<?php

namespace ZandooBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use ZandooBundle\Validator\Annonce as AnnonceConstraint;

/**
 * Annonce
 *
 * @ORM\Table(name="ANNONCE")
 * @ORM\Entity(repositoryClass="ZandooBundle\Repository\AnnonceRepository")
 * 
 * @ORM\HasLifecycleCallbacks
 * 
 * @AnnonceConstraint
 * 
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
     * @var string
     *
     * @ORM\Column(name="titre", type="string") 
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=2000) 
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="actif", type="boolean")
     */
    private $actif = 1;
    
     /**
     * @ORM\ManyToOne(targetEntity="Utilisateur",cascade={"persist"})
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
     * @ORM\Column(name="afficher_tel", type="boolean")
     */
    private $cacherTel;// 1 = telephone masqué | 0 =telephone affiché
    
    /**
     * @var string
     *
     * @ORM\Column(name="date_creation", type="date",nullable=false)
     */
    private $dateCreation;
    
    /**
     * @var string
     *
     * @ORM\Column(name="date_modif", type="date",nullable=true)
     */
    private $dateModification ;
    
    /**
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id",nullable=false)
     * 
     *
     * @var utilisateur
     */
    private $categorie;
    /**
     * @var bool
     *
     * @ORM\Column(name="type", type="boolean")
     * 
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide")
     */
    private $type = 0;// 0 = Annonce | 1 = Demande
    
    /**
     * @var string
     *
     * @ORM\Column(name="monnaie", type="boolean",nullable=true)
     */
    private $monnaie = 0;//0 = Fc(franc Congolais)| 1 = $(Dollars)
    
    
    /**
     * @ORM\ManyToMany(targetEntity="Image",cascade={"persist"})
     * @ORM\JoinTable(name="annonce_images",
     *      joinColumns={@ORM\JoinColumn(name="annonce_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="image_id", referencedColumnName="id")}
     *      )
     * 
     */
    private $images;
    
    /**
     * @ORM\ManyToOne(targetEntity="Ville")
     * @ORM\JoinColumn(name="ville_id", referencedColumnName="id",nullable=true)
     */
    private $villeAnnonce;
    /**
     * @ORM\Column(name="urgent", type="boolean")
     * @var boolean 
     */
    private $urgent;
    /**
     * @ORM\Column(name="generateur_id", type="string",nullable=true)
     * @var string 
     */
    private $generateurId;
    
    /**
     * @ORM\ManyToMany(targetEntity="Visite")
     * @ORM\JoinTable(name="annonce_visite",
     *      joinColumns={@ORM\JoinColumn(name="annonce_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="visite_id", referencedColumnName="id")}
     *      )
     * 
     */
    private $visite;
    
    public function __construct(){
        $this->images = new ArrayCollection();
        $this->visite = new ArrayCollection();
        $this->dateModification = new \DateTime();        
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
     * Set cacherTel
     *
     * @param string $cacherTel
     *
     * @return Annonce
     */
    public function setCacherTel($cacherTel)
    {
        $this->cacherTel= $cacherTel;
    
        return $this;
    }

    /**
     * Get cacherTel
     *
     * @return string
     */
    public function getCacherTel()
    {
        return $this->cacherTel;
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
    public function setCategorie($categorie = null)
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
    /**
     * Get monnaie
     *
     * @return string
     */
    function getMonnaie() {
        return $this->monnaie;
    }
    /**
     * Set categorie
     *
     * @param  $monnaie 
     *
     * @return $this
     */
    function setMonnaie($monnaie) {
        $this->monnaie = $monnaie;
        return $this;
    }
    /**
     * 
     * @return Image
     */
    public function getImages() {
        return $this->images;
    }
    /**
     * 
     * @param \ZandooBundle\Entity\Image $images
     * @return $this
     */
    public function setImages(Image $images) {
        $this->images[] = $images;
        return $this; 
    }
    /**
     * 
     * @return villeAnnonce
     */
    function getVilleAnnonce() {
        return $this->villeAnnonce;
    }
   /**
    * 
    * @param type $villeAnnonce
    */
    function setVilleAnnonce($villeAnnonce) {
        $this->villeAnnonce = $villeAnnonce;
    }
    /**
     * 
     * @return dateModification
     */
    function getDateModification() {
        return $this->dateModification;
    }
  /**
   * 
   * @param type $dateModification
   */
    function setDateModification($dateModification) {
        $this->dateModification = $dateModification;
    }
    /**
     * 
     * @return urgent
     */
    public function getUrgent() {
        return $this->urgent;
    }
    /**
     * 
     * @param type $urgent
     */
    public function setUrgent($urgent) {
        $this->urgent = $urgent;
    }
    /**
     * 
     * @return generateurId
     */
    public function getGenerateurId() {
        return $this->generateurId;
    }
    /**
     * 
     * @param type $generateurId
     */
     public function setGenerateurId($generateurId) {
        $this->generateurId = $generateurId;
    }
    
    public function getOldGenenerateurId($gen){
        return $this->generateurId = $gen ;
    }
   
   
    /**
     * 
     * @return viste
     */    
    function getVisite() {
        return $this->visite;
    }
    /**
     * 
     * @param type $visite
     */    
    function setVisite(Visite $visite) {
        $this->visite[] = $visite;
        return $this;
    }

}
