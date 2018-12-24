<?php
namespace ZandooBundle\Entity;

class Critere
{
    /**
     *
     * @var int 
     */
    private $offset;
    /**
     *
     * @var boolean 
     */  
    private $type;
    /**
     *
     * @var boolean 
     */   
    private $actif;
    /**
     *
     * @var int
     */ 
    private $prixSup;
    
    /**
     *
     * @var int
     */   
    private $prixInf;
    /**
     *
     * @var string 
     */
    private $titre;
    /**
     * 
     * @return utilisateur
     */
    private $idUtilisateur;
    /**
     *
     * @var int 
     */
    private $categorie;
    /**
     *
     * @var string 
     */
    private $description;
    /**
     *
     * @var boolean
     */
    private $urgent;
    /**
     *
     * @var boolean
     */
    private $titreUniquement;
    
    private $ville;
    
    public function getTitre() {
        return $this->titre;
    }

    public function getOffset() {
        return $this->offset;
    }

    public function getType() {
        return $this->type;
    }

    public function getActif() {
        return $this->actif;
    }

    public function getPrixSup() {
        return $this->prixSup;
    }

    public function getPrixInf() {
        return $this->prixInf;
    }

    public function setOffset($offset) {
        $this->offset = $offset;
        return $this;
    }

    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    public function setActif($actif) {
        $this->actif = $actif;
        return $this;
    }

    public function setPrixSup($prixSup) {
        $this->prixSup = $prixSup;
        return $this;
    }

    public function setPrixInf($prixInf) {
        $this->prixInf = $prixInf;
        return $this;
    }
   
    public function setTitre($titre) {
        $this->titre = $titre;
        return $this;
    }
    
    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur($idUtilisateur) {
        $this->idUtilisateur = $idUtilisateur;
        return $this;
    }
  
    public function getCategorie() {
        return $this->categorie;       
    }

    public function setCategorie($categorie) {
        $this->categorie = $categorie;
        return $this;
    }
    
    public function getDescription() {
        return $this->description;
    }
    
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }
    
    public function getUrgent() {
        return $this->urgent;
    }

    public function setUrgent($urgent) {
        $this->urgent = $urgent;
    }
    
    public function getTitreUniquement() {
        return $this->titreUniquement;
    }

    public function setTitreUniquement($titreUniquement) {
        $this->titreUniquement = $titreUniquement;
        return $this;
    }
    
    function getVille() {
        return $this->ville;
    }
    function setVille($ville) {
        $this->ville = $ville;
        return $this;
    }

}

