<?php
namespace ZandooBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Signalement
 *
 * @ORM\Table(name="SIGNALEMENT")
 * @ORM\Entity(repositoryClass="ZandooBundle\Repository\SignalementRepository")
 */
class Signalement
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
     * @ORM\Column(name="nom", type="string")
     */
    private $nom;
    
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string")
     */
    private $email;
    
    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string",length=1000)
     */
    private $message;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Motif")
     * @ORM\JoinColumn(name="motif_id", referencedColumnName="id",nullable=false)
     * @var type 
     */
    private $motif;
    
    /**
     * @ORM\ManyToOne(targetEntity="Annonce")
     * @ORM\JoinColumn(name="annonce_id", referencedColumnName="id",nullable=false)
     * @var type 
     *
     */
    private $annonce;

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
     * 
     * @return nom
     */
    public function getNom() {
        return $this->nom;
    }
    /**
     * 
     * @param type $nom
     * @return \ZandooBundle\Entity\Signalement
     */
    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    } 
    /**
     * 
     * @return email
     */
    public function getEmail() {
        return $this->email;
    }
    /**
     * 
     * @param type $email
     * @return \ZandooBundle\Entity\Signalement
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }
    /**
     * 
     * @return message
     */
    public function getMessage() {
        return $this->message;
    }
    /**
     * 
     * @param type $message
     * @return \ZandooBundle\Entity\Signalement
     */     
    public function setMessage($message) {
        $this->message = $message;
        return $this;
    }
    /**
     * 
     * @return motif
     */
    public function getMotif() {
        return $this->motif;
    }
    /**
     * 
     * @param \ZandooBundle\Entity\Motif $motif
     */
    public function setMotif($motif) {
        $this->motif = $motif;
        return $this;
    }
    /**
     * 
     * @return annonce
     */
    public function getAnnonce() {
        return $this->annonce;
    }
    /**
     * 
     * @param \ZandooBundle\Entity\Annonce $annonce
     * @return \ZandooBundle\Entity\Signalement
     */
    public function setAnnonce(Annonce $annonce) {
        $this->annonce = $annonce;
        return $this;
    }
    
}
