<?php

namespace ZandooBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Motif
 *
 * @ORM\Table(name="visite")
 * @ORM\Entity(repositoryClass="ZandooBundle\Repository\VisiteRepository")
 */
class Visite
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
     * @ORM\Column(name="date_visite", type="datetime")
     */
    private $dateVisite;
    
    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string",length=55)
     */
    private $ip;
    
    
    public function __construct() {
        $this->dateCreation = new \DateTime();
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
     * @return date
     */
    function getDateVisite() {
        return $this->dateVisite;
    }
    /**
     * 
     * @param type $dateVisite
     * @return $this
     */
    function setDateVisite($dateVisite) {
      $this->dateVisite = $dateVisite;
      return $this;
    }
    /**
     * 
     * @return string
     */
    function getIp() {
        return $this->ip;
    }
    /**
     * 
     * @param type $ip
     * @return $this
     */
    function setIp($ip) {
        $this->ip = $ip;
        return $this;
    }

}
