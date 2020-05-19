<?php

namespace Franklin\PortadaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Review
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Franklin\PortadaBundle\Entity\ReviewRepository")
 */
class Review
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(name="picture", type="string", nullable=true)
     *
     * @Assert\File(mimeTypes={ "image/jpg", "image/jpeg", "image/png" })
     * @Assert\File(maxSize="6000000")
     */
    private $picture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @ORM\OneToMany(targetEntity="Franklin\PortadaBundle\Entity\Comentario", mappedBy="review", cascade={"persist", "remove"})
     */
    private $comentario;

    public function removeFiles($file)
    {
        $file_path = __DIR__.'/../../../../web/uploads/reviews/'.$file;
        if(file_exists($file_path)) unlink($file_path);
    }

    public function __construct()
    {
        $this->comentario = new ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Review
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return Review
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Review
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Get comentario
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    public function setComentario(\Doctrine\Common\Collections\Collection $comentario)
    {
        $this->comentario = $comentario;
        foreach ($comentario as $comentario) {
            $comentario->setReview($this);
        }
    }

    public function removeComentario($comentario)
    {
        $this->comentario->removeElement($comentario);
    }

}

