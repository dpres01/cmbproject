<?php

namespace ZandooBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Motif
 *
 * @ORM\Table(name="CONTACT_MESSAGE")
 * @ORM\Entity(repositoryClass="ZandooBundle\Repository\ContactRepository")
 * 
 * 
 */
class Contact
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
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide")
     */
    private $nom;
    
    /**
     * @var string
     *
     * @ORM\Column(name="date_envoi", type="date")
     */
    private $dateEnvoi;
    
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string",length=255)
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide")
     * @Assert\Email(
     *     message = "cette adresse email '{{ value }}' n'est pas valide.",
     *     checkMX = true
     * )
     * 
     */
    private $email;
    
    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string",length=55,nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="cette valeur doit etre numérique."
     * )
     */
    private $telephone;
    
    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string",length=1000)
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide")
     * 
     */
    private $message;
    /**
     *
     * @ORM\ManyToOne(targetEntity="Annonce")
     * @ORM\JoinColumn(name="annonce_id", referencedColumnName="id",nullable=true)
     * 
     * @var type 
     */
    private $annonce;
    
    public function __construct() {
        $this->dateEnvoi = new \DateTime();
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
     * 
     * @return string
     */
    function getNom() {
        return $this->nom;
    }
    /**
     * 
     * @param type $nom
     * @return $this
     */
    function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }
    /**
     * 
     * @return date
     */
    function getDateEnvoi() {
        return $this->dateEnvoi;
    }
    /**
     * 
     * @param type $dateEnvoi
     * @return $this
     */
    function setDateEnvoi(\DateTime $dateEnvoi = null) {
        $this->dateEnvoi = $dateEnvoi;
        return $this;
    }
    /**
     * 
     * @return string
     */
    function getEmail() {
        return $this->email;
    }
    /**
     * 
     * @param type $email
     * @return $this
     */
    function setEmail($email) {
        $this->email = $email;
        return $this;
    }
    /**
     * 
     * @return string
     */
    function getTelephone() {
        return $this->telephone;
    }
    /**
     * 
     * @param type $telephone
     * @return $this
     */
    function setTelephone($telephone) {
        $this->telephone = $telephone;
        return $this;
    }
    /**
     * 
     * @return string
     */
    function getMessage() {
        return $this->message;
    }
    /**
     * 
     * @param type $message
     * @return $this
     */
    function setMessage($message) {
        $this->message = $message;
        return $this;
    }
    
    function getAnnonce() {
        return $this->annonce;
    }
    /**
     * 
     * @param Annonce $annonce
     */
    function setAnnonce(Annonce $annonce) {
        $this->annonce = $annonce;
        return $this;
    }
}
