<?php

namespace Franklin\PortadaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Comentario
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Franklin\PortadaBundle\Entity\ComentarioRepository")
 */
class Comentario
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
     * @ORM\Column(name="locale", type="string", length=10)
     */
    private $locale;

    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="text")
     */
    private $comentario;

    /**
     * @ORM\ManyToOne(targetEntity="Franklin\PortadaBundle\Entity\Review", inversedBy="comentario", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="review_id", referencedColumnName="id")
     */
    private $review;


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
     * Set Comentario
     *
     * @param string $locale
     *
     * @return Comentario
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get Locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     *
     * @return Comentario
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set review
     *
     * @param string $review
     *
     * @return Comentario
     */
    public function setReview($review)
    {
        $this->review = $review;
    }

    /**
     * Get review
     *
     * @return string
     */
    public function getReview()
    {
        return $this->review;
    }
}

