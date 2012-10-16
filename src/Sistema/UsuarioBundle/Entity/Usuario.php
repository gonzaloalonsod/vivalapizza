<?php
namespace Sistema\UsuarioBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class Usuario extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToMany(targetEntity="Sistema\UsuarioBundle\Entity\Group")
     * @ORM\JoinTable(name="fos_user_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;
    
//    /**
//     * @var string $nombre
//     *
//     * @ORM\Column(name="nombre", type="string", length=200, nullable=true)
//     */
//    protected $nombre;
//
//    /**
//     * @var string $apellido
//     *
//     * @ORM\Column(name="apellido", type="string", length=200, nullable=true)
//     */
//    protected $apellido;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
    
//    /**
//     * Set nombre
//     *
//     * @param string $nombre
//     */
//    public function setNombre($nombre)
//    {
//        $this->nombre = $nombre;
//    }
//
//    /**
//     * Get nombre
//     *
//     * @return string 
//     */
//    public function getNombre()
//    {
//        return $this->nombre;
//    }
//
//    /**
//     * Set apellido
//     *
//     * @param string $apellido
//     */
//    public function setApellido($apellido)
//    {
//        $this->apellido = $apellido;
//    }
//
//    /**
//     * Get apellido
//     *
//     * @return string 
//     */
//    public function getApellido()
//    {
//        return $this->apellido;
//    }
}