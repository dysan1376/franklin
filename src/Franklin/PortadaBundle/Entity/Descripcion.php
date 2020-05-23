<?php

namespace Franklin\PortadaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Descripcion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Franklin\PortadaBundle\Entity\DescripcionRepository")
 */
class Descripcion
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
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="locale", type="string", length=50)
     */
    private $locale;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="Franklin\PortadaBundle\Entity\Caso", inversedBy="descripcion", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="caso_id", referencedColumnName="id")
     */
    private $caso;


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
     * Set title
     *
     * @param string $title
     *
     * @return Descripcion
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return Descripcion
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set caso
     *
     * @param string $caso
     *
     * @return Caso
     */
    public function setCaso($caso)
    {
        $this->caso = $caso;
    }

    /**
     * Get caso
     *
     * @return string
     */
    public function getCaso()
    {
        return $this->caso;
    }
}

