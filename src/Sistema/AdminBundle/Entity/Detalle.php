<?php

namespace Sistema\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sistema\AdminBundle\Entity\Detalle
 *
 * @ORM\Table(name="detalle")
 * @ORM\Entity
 */
class Detalle
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
     * @var string $nroFactura
     *
     * @ORM\Column(name="nro_factura", type="string", length=200, nullable=false)
     */
    private $nroFactura;

    /**
     * @var float $total
     *
     * @ORM\Column(name="total", type="float", nullable=false)
     */
    private $total;

    /**
     * @var float $comision
     *
     * @ORM\Column(name="comision", type="float", nullable=false)
     */
    private $comision;

    /**
     * @var Comprobante
     *
     * @ORM\ManyToOne(targetEntity="Comprobante")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_comprobante", referencedColumnName="id")
     * })
     */
    private $idComprobante;



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
     * Set nroFactura
     *
     * @param string $nroFactura
     * @return Detalle
     */
    public function setNroFactura($nroFactura)
    {
        $this->nroFactura = $nroFactura;
    
        return $this;
    }

    /**
     * Get nroFactura
     *
     * @return string 
     */
    public function getNroFactura()
    {
        return $this->nroFactura;
    }

    /**
     * Set total
     *
     * @param float $total
     * @return Detalle
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
     * Set comision
     *
     * @param float $comision
     * @return Detalle
     */
    public function setComision($comision)
    {
        $this->comision = $comision;
    
        return $this;
    }

    /**
     * Get comision
     *
     * @return float 
     */
    public function getComision()
    {
        return $this->comision;
    }

    /**
     * Set idComprobante
     *
     * @param Sistema\AdminBundle\Entity\Comprobante $idComprobante
     * @return Detalle
     */
    public function setIdComprobante(\Sistema\AdminBundle\Entity\Comprobante $idComprobante = null)
    {
        $this->idComprobante = $idComprobante;
    
        return $this;
    }

    /**
     * Get idComprobante
     *
     * @return Sistema\AdminBundle\Entity\Comprobante 
     */
    public function getIdComprobante()
    {
        return $this->idComprobante;
    }
}