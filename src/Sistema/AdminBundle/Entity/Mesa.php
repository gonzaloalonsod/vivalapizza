<?php

namespace Sistema\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sistema\AdminBundle\Entity\Mesa
 *
 * @ORM\Table(name="mesa")
 * @ORM\Entity
 */
class Mesa
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $numero
     *
     * @ORM\Column(name="numero", type="string", length=200, nullable=false)
     */
    private $numero;

    /**
     * @var string $ubicacion
     *
     * @ORM\Column(name="ubicacion", type="string", length=200, nullable=false)
     */
    private $ubicacion;

    /**
     * @var Persona
     *
     * @ORM\ManyToOne(targetEntity="Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_mozo", referencedColumnName="id")
     * })
     */
    private $idMozo;



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
     * Set numero
     *
     * @param string $numero
     * @return Mesa
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    
        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set ubicacion
     *
     * @param string $ubicacion
     * @return Mesa
     */
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;
    
        return $this;
    }

    /**
     * Get ubicacion
     *
     * @return string 
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * Set idMozo
     *
     * @param Sistema\AdminBundle\Entity\Persona $idMozo
     * @return Mesa
     */
    public function setIdMozo(\Sistema\AdminBundle\Entity\Persona $idMozo = null)
    {
        $this->idMozo = $idMozo;
    
        return $this;
    }

    /**
     * Get idMozo
     *
     * @return Sistema\AdminBundle\Entity\Persona 
     */
    public function getIdMozo()
    {
        return $this->idMozo;
    }
}