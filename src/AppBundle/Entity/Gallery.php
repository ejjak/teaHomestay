<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gallery
 *
 * @ORM\Table(name="gallery")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GalleryRepository")
 */
class Gallery
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
     * @ORM\Column(name="title_name", type="string", length=255)
     */
    private $titleName;


    /**
     * @var int
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Images", mappedBy="gallery",cascade={"all"},orphanRemoval=true)
     */
    private $image;
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titleName
     *
     * @param string $titleName
     *
     * @return Gallery
     */
    public function setTitleName($titleName)
    {
        $this->titleName = $titleName;

        return $this;
    }

    /**
     * Get titleName
     *
     * @return string
     */
    public function getTitleName()
    {
        return $this->titleName;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->image = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add image
     *
     * @param \AppBundle\Entity\Images $image
     *
     * @return Gallery
     */
    public function addImage(\AppBundle\Entity\Images $image)
    {
        $this->image[] = $image;
        $image->setGallery($this);
        return $this;
    }

    /**
     * Remove image
     *
     * @param \AppBundle\Entity\Images $image
     */
    public function removeImage(\AppBundle\Entity\Images $image)
    {
        $this->image->removeElement($image);
    }

    /**
     * Get image
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @var date $created
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    protected $created;
    /**
     * @var date $updated
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    protected $modified;

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Pages
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     *
     * @return Pages
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Triggered on insert
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->created = new \DateTime("now");
    }
    /**
     * Triggered on update
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->modified = new \DateTime("now");
    }
}
