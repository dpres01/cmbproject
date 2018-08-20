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
    
    private $titre;
    
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


}
