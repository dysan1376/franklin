<?php

namespace Franklin\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Feedback
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Franklin\AdminBundle\Entity\FeedbackRepository")
 */
class Feedback
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
     * @ORM\Column(name="rate", type="string", length=10)
     */
    private $rate;

    /**
     * @var string
     *
     * @ORM\Column(name="feedback", type="string", length=255, nullable=true)
     */
    private $feedback;

    /**
     * @var string
     *
     * @ORM\Column(name="posquirurgico", type="string", length=255, nullable=true)
     */
    private $posquirurgico;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @ORM\ManyToOne(targetEntity="Franklin\UsuariosBundle\Entity\Paciente", inversedBy="feedback", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="paciente_id", referencedColumnName="id")
     */
    private $paciente;

    /**
     * @ORM\OneToMany(targetEntity="Franklin\AdminBundle\Entity\Invitacion", mappedBy="feedback")
     */
    protected $invitacion;


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
     * Set rate
     *
     * @param string $rate
     *
     * @return Feedback
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return string
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set feedback
     *
     * @param string $feedback
     *
     * @return Feedback
     */
    public function setFeedback($feedback)
    {
        $this->feedback = $feedback;

        return $this;
    }

    /**
     * Get feedback
     *
     * @return string
     */
    public function getFeedback()
    {
        return $this->feedback;
    }

    /**
     * Set posquirurgico
     *
     * @param string $posquirurgico
     *
     * @return Feedback
     */
    public function setPosquirurgico($posquirurgico)
    {
        $this->posquirurgico = $posquirurgico;

        return $this;
    }

    /**
     * Get posquirurgico
     *
     * @return string
     */
    public function getPosquirurgico()
    {
        return $this->posquirurgico;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Feedback
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
     * Set paciente
     *
     * 
     *
     * 
     */
    public function setPaciente($paciente)
    {
        $this->paciente = $paciente;
    }

    /**
     * Get paciente
     *
     * 
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * Set invitacion
     *
     * 
     *
     * 
     */
    public function setInvitacion($invitacion)
    {
        $this->invitacion = $invitacion;

        return $this;
    }

    /**
     * Get invitacion
     *
     * 
     */
    public function getInvitacion()
    {
        return $this->invitacion;
    }
}

