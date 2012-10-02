<?php

namespace Sistema\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sistema\AdminBundle\Entity\Comprobate
 *
 * @ORM\Table(name="comprobate")
 * @ORM\Entity
 */
class Comprobate
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
     * @var integer $idCierreCaja
     *
     * @ORM\Column(name="id_cierre_caja", type="bigint", nullable=false)
     */
    private $idCierreCaja;

    /**
     * @var string $nombreMozo
     *
     * @ORM\Column(name="nombre_mozo", type="string", length=200, nullable=false)
     */
    private $nombreMozo;

    /**
     * @var \DateTime $fecha
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var float $total
     *
     * @ORM\Column(name="total", type="float", nullable=false)
     */
    private $total;



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
     * Set idCierreCaja
     *
     * @param integer $idCierreCaja
     * @return Comprobate
     */
    public function setIdCierreCaja($idCierreCaja)
    {
        $this->idCierreCaja = $idCierreCaja;
    
        return $this;
    }

    /**
     * Get idCierreCaja
     *
     * @return integer 
     */
    public function getIdCierreCaja()
    {
        return $this->idCierreCaja;
    }

    /**
     * Set nombreMozo
     *
     * @param string $nombreMozo
     * @return Comprobate
     */
    public function setNombreMozo($nombreMozo)
    {
        $this->nombreMozo = $nombreMozo;
    
        return $this;
    }

    /**
     * Get nombreMozo
     *
     * @return string 
     */
    public function getNombreMozo()
    {
        return $this->nombreMozo;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Comprobate
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
     * Set total
     *
     * @param float $total
     * @return Comprobate
     */
    public function setTotal($total)
    {
        $this->total = $total;
    
        return $this;
    }

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal()
    {
        return $this->total;
    }
}