<?php

namespace Franklin\UsuariosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
//use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Paciente
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Franklin\UsuariosBundle\Entity\PacienteRepository")
 */
class Paciente
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
     * @ORM\Column(name="nombre", type="string", length=25, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=25, nullable=true)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="string", length=12, nullable=true)
     */
    private $celular;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isSubscribed", type="boolean")
     */
    private $isSubscribed;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @ORM\OneToMany(targetEntity="Franklin\AdminBundle\Entity\Feedback", mappedBy="paciente")
     */
    protected $feedback;

    /**
     * @ORM\OneToMany(targetEntity="Franklin\AdminBundle\Entity\Invitacion", mappedBy="paciente")
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
     * Set nombre
     *
     * @param string $nombre
     * @return Paciente
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
     * Set apellido
     *
     * @param string $apellido
     * @return Paciente
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Paciente
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
     * Set celular
     *
     * @param string $celular
     *
     * @return Paciente
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get celular
     *
     * @return string
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set isSubscribed
     *
     * @param boolean $isSubscribed
     *
     * @return Paciente
     */
    public function setIsSubscribed($isSubscribed)
    {
        $this->isSubscribed = $isSubscribed;

        return $this;
    }

    /**
     * Get isSubscribed
     *
     * @return boolean
     */
    public function getIsSubscribed()
    {
        return $this->isSubscribed;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Blog
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
     * Set feedback
     *
     * 
     *
     * 
     */
    public function setFeedback($feedback)
    {
        $this->feedback = $feedback;

        return $this;
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

