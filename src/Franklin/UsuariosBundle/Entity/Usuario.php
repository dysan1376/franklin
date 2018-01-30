<?php

namespace Franklin\UsuariosBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity(repositoryClass="Franklin\UsuariosBundle\Entity\UsuarioRepository")
 * @ORM\Table(name="Usuario")
 */
class Usuario extends BaseUser
{
	 /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="locale", type="string", length=10, nullable=true)
     */
    private $locale;  


    /**
     * Agrega un rol al usuario.
     * @throws Exception
     * @param Rol $rol 
     */
    public function addRole( $rol )
    {
        if($rol == 1) {
            array_push($this->roles, 'ROLE_FRANKLIN');
        } else if($rol == 2) {
            array_push($this->roles, 'ROLE_ADMIN');
        } else if($rol == 3) {
            array_push($this->roles, 'ROLE_USER');
        }

    }

    public function __construct()
    {
        parent::__construct();

        //your code
        $this->datosInstitucionales = new ArrayCollection();

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
     * Set locale
     *
     * @param string $locale
     * @return Usuario
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
  
}
