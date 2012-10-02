<?php

namespace Sistema\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sistema\AdminBundle\Entity\Comprobante
 *
 * @ORM\Table(name="comprobante")
 * @ORM\Entity
 */
class Comprobante
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
     * @var CierreCaja
     *
     * @ORM\ManyToOne(targetEntity="CierreCaja")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cierre_caja", referencedColumnName="id")
     * })
     */
    private $idCierreCaja;



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
     * Set nombreMozo
     *
     * @param string $nombreMozo
     * @return Comprobante
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
     * @return Comprobante
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
     * @return Comprobante
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

    /**
     * Set idCierreCaja
     *
     * @param Sistema\AdminBundle\Entity\CierreCaja $idCierreCaja
     * @return Comprobante
     */
    public function setIdCierreCaja(\Sistema\AdminBundle\Entity\CierreCaja $idCierreCaja = null)
    {
        $this->idCierreCaja = $idCierreCaja;
    
        return $this;
    }

    /**
     * Get idCierreCaja
     *
     * @return Sistema\AdminBundle\Entity\CierreCaja 
     */
    public function getIdCierreCaja()
    {
        return $this->idCierreCaja;
    }
}