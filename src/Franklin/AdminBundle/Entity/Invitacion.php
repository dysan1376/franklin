<?php

namespace Franklin\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invitacion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Franklin\AdminBundle\Entity\InvitacionRepository")
 */
class Invitacion
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
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="expira", type="datetime", nullable=true)
     */
    private $expira;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\ManyToOne(targetEntity="Franklin\AdminBundle\Entity\Feedback", inversedBy="invitacion", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="feedback_id", referencedColumnName="id")
     */
    private $feedback;

    /**
     * @ORM\ManyToOne(targetEntity="Franklin\UsuariosBundle\Entity\Paciente", inversedBy="invitacion", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="paciente_id", referencedColumnName="id")
     */
    private $paciente;


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
     * @return Invitacion
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
     * Set expira
     *
     * @param integer $expira
     *
     * @return Invitacion
     */
    public function setExpira($expira)
    {
        $this->expira = $expira;

        return $this;
    }

    /**
     * Get expira
     *
     * @return integer
     */
    public function getExpira()
    {
        return $this->expira;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Invitacion
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set feedback
     *
     * 
     *
     * 
     */
    public function setFeedback($feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Get feedback
     *
     * 
     */
    public function getFeedback()
    {
        return $this->feedback;
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
}

