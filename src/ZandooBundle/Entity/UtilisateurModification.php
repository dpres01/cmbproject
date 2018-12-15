<?php

namespace ZandooBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * UtilisateurModification
 * 
 */

class UtilisateurModification 
{

    /**
     * @var string
     *
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide")
     * @Assert\Length( min = 5, max = 5,
     *    exactMessage = "votre pseudo doit contenir {{ limit }} caracteres",
     * )     
     *
     */
    private $username;
    /**
     * @var string
     *
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide")
     * @Assert\Email(
     *     message = "cette adresse email '{{ value }}' n'est pas valide.",
     *     checkMX = true
     * )
     */
    private $email;
    
    /**
     * @var string
     * 
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide")
     * 
     */
    private $adresse;
    /**
     * @var string
     *
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide")
     * @Assert\Type(
     *     type="numeric",
     *     message="cette valeur {{ value }}  doit être {{ type }}."
     * )
     * 
     * 
     */
    private $telephone;
    /**
     * @var string
     *
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide")
     * 
     */
    private $ville;
    /**
     * @var string
     *
     * @Assert\NotNull(message="cette valeur ne doit pas être vide")
     */
    private $isProfessionnel = false;// 0 = Particulier | 1 = Professionnel
    
    /**
     * Set username
     *
     * @param string $username
     *
     * @return Utilisateur
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Utilisateur
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Utilisateur
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    
        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Utilisateur
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    
        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Utilisateur
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    
        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }
    
    /**
     * Set isProfessionnel
     *
     * @param boolean $isProfessionnel
     *
     * @return Utilisateur
     */
    public function setIsProfessionnel($isProfessionnel)
    {
        $this->isProfessionnel = $isProfessionnel;
    
        return $this;
    }

    /**
     * Get isProfessionnel
     *
     * @return boolean
     */
    public function getIsProfessionnel()
    {
        return $this->isProfessionnel;
    }
    
    function __toString() {
       return (string)$this->username.$this->email.$this->telephone.$this->adresse.$this->ville.(int)$this->isProfessionnel;
    }

}
