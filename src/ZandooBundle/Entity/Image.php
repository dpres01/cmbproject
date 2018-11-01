<?php

namespace ZandooBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Image
 *
 * @ORM\Table(name="IMAGE")
 * @ORM\Entity(repositoryClass="ZandooBundle\Repository\CategorieRepository")
 * 
 * @ORM\HasLifecycleCallbacks
 * 
 */
class Image
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
     * @ORM\Column(name="name", type="string",length=255)
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string",length=255)
     */
    private $url;
    
    private $file;
   
    private $temp;
     

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
     * Set name
     *
     * @param string $name
     *
     * @return Image
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Image
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image url
        if (is_file($this->getAbsoluteUrl())) {
            // store the old name to delete after the update
            $this->temp = $this->getAbsoluteUrl();
        } else {
            $this->url = 'initial';
        }
    }
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            $this->url = $this->getFile()->guessExtension();
            $this->name = $this->getFile()->getClientOriginalName();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }
        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->temp);
            // clear the temp image url
            $this->temp = null;
        }
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->id.'.'.$this->getFile()->guessExtension()
        ); 
        $this->setFile(null);
    }

    /**
     * @ORM\PreRemove()
     */
    public function storeFilenameForRemove()
    {
        $this->temp = $this->getAbsoluteUrl();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if (isset($this->temp)) {
            unlink($this->temp);
        }
    }

    public function getAbsoluteUrl()
    {
        return null === $this->url
            ? null
            : $this->getUploadRootDir().'/'.$this->id.'.'.$this->url;
    }
   

    public function getWebUrl()
    {
        return null === $this->url
            ? null
            : $this->getUploadDir().'/'.$this->id.'.'.$this->url;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory url where uploaded
        // documents should be saved
        return '/var/www/cmbproject/web/bundles/zandoo/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/documents';
    }
}
