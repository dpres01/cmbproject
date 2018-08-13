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
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setActif($actif) {
        $this->actif = $actif;
    }

    public function setPrixSup($prixSup) {
        $this->prixSup = $prixSup;
    }

    public function setPrixInf($prixInf) {
        $this->prixInf = $prixInf;
    }


    
}

