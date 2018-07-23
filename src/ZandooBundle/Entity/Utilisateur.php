<?php

namespace ZandooBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Annonce
 *
 * @ORM\Table(name="UTILISATEUR")
 * @ORM\Entity(repositoryClass="ZandooBundle\Repository\UtilisateurRepository")
 * 
 * @UniqueEntity("username",message="ce pseudo existe.")
 * @UniqueEntity("email",message="cet email existe.")
 * 
 */
//UniqueEntity(fields={"pseudo","email"}, errorPath="pseudo", message="Un article existe déjà avec ce titre.")
class Utilisateur implements UserInterface
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
     * @ORM\Column(name="pseudo", type="string",length=5,unique=true)
     * 
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 5,
     *      max = 5,
     *      minMessage = "votre pseudo doit contenir {{ limit }} 5 caracteres minimum",
     *      maxMessage = "votre pseudo doit contenir {{ limit }} 5 caracteres maximum"
     * )
     */
    private $username;
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string",length=255,unique=true) 
     * 
     * @Assert\Email(
     *     message = "cette adresse email '{{ value }}' n'est pas valide.",
     *     checkMX = true
     * )
     */
    private $email;
    
    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string",length=255)
     * 
     * @Assert\NotBlank()
     * 
     */
    private $password;
    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string",length=255)
     * 
     */
    private $adresse;
    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string",length=60)
     * 
     * 
     */
    private $telephone;
    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string",length=255)
     */
    private $ville;
    /**
     * @var string
     *
     * @ORM\Column(name="actif", type="boolean")
     */
    private $actif = 1;
    /**
     * @var string
     *
     * @ORM\Column(name="date_création", type="date")
     */
    private $dateCreation;
    /**
     * @var string
     *
     * @ORM\Column(name="is_admin", type="boolean")
     */
    private $isAdmin = 0;// 0 = Utilisateur normal | 1 = Administrateur
    /**
     * @var string
     *
     * @ORM\Column(name="is_professionnel", type="boolean")
     */
    private $isProfessionnel = 0;// 0 = Particulier | 1 = Professionnel
    
    private $roles = array();
  
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
     * Set password
     *
     * @param string $password
     *
     * @return Utilisateur
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
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
     * Set actif
     *
     * @param boolean $actif
     *
     * @return Utilisateur
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Utilisateur
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
     * Set isAdmin
     *
     * @param boolean $isAdmin
     *
     * @return Utilisateur
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    
        return $this;
    }

    /**
     * Get isAdmin
     *
     * @return boolean
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
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

    public function getRoles()
    {
        return $this->roles;
    }
    
     public function setRoles($role)
    {   
         $this->roles[] = $role;
        return $this;
    }

    public function getSalt()
    {
    }
    public function eraseCredentials()
    {
    }
}
