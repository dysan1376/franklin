<?php

namespace Franklin\PortadaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Caso
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Franklin\PortadaBundle\Entity\CasoRepository")
 */
class Caso
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @ORM\Column(name="picture", type="string", nullable=true)
     *
     * @Assert\File(mimeTypes={ "image/jpg", "image/jpeg", "image/png" })
     * @Assert\File(maxSize="6000000")
     */
    private $picture;

    /**
     * @ORM\Column(name="hover", type="string", nullable=true)
     *
     * @Assert\File(mimeTypes={ "image/jpg", "image/jpeg", "image/png" })
     * @Assert\File(maxSize="6000000")
     */
    private $hover;

    /**
     * @ORM\OneToMany(targetEntity="Franklin\PortadaBundle\Entity\Descripcion", mappedBy="caso", cascade={"persist", "remove"})
     */
    private $descripcion;


    public function __construct()
    {
        $this->descripcion = new ArrayCollection();
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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Caso
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
     * Set picture
     *
     * @param string $picture
     *
     * @return Caso
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

    public function removePicture($file)
    {
        $file_path = __DIR__.'/../../../../web/uploads/casos/picture/'.$file;
        if(file_exists($file_path)) unlink($file_path);
    }

    /**
     * Set hover
     *
     * @param string $hover
     *
     * @return Caso
     */
    public function setHover($hover)
    {
        $this->hover = $hover;

        return $this;
    }

    /**
     * Get hover
     *
     * @return string
     */
    public function getHover()
    {
        return $this->hover;
    }

    public function removeHover($file)
    {
        $file_path = __DIR__.'/../../../../web/uploads/casos/hover/'.$file;
        if(file_exists($file_path)) unlink($file_path);
    }

    /**
     * Get descripcion
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion(\Doctrine\Common\Collections\Collection $descripcion)
    {
        $this->descripcion = $descripcion;
        foreach ($descripcion as $descripcion) {
            $descripcion->setCaso($this);
        }
    }

    public function removeDescripcion($descripcion)
    {
        $this->descripcion->removeElement($descripcion);
    }
}

