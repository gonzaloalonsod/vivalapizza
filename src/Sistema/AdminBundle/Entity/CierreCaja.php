<?php

namespace Sistema\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sistema\AdminBundle\Entity\CierreCaja
 *
 * @ORM\Table(name="cierre_caja")
 * @ORM\Entity
 */
class CierreCaja
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
     * @var \DateTime $fecha
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var string $ingresos
     *
     * @ORM\Column(name="ingresos", type="string", length=200, nullable=false)
     */
    private $ingresos;

    /**
     * @var string $egresos
     *
     * @ORM\Column(name="egresos", type="string", length=200, nullable=false)
     */
    private $egresos;

    /**
     * @var string $total
     *
     * @ORM\Column(name="total", type="string", length=200, nullable=false)
     */
    private $total;

    /**
     * @var Caja
     *
     * @ORM\ManyToOne(targetEntity="Caja")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_caja", referencedColumnName="id")
     * })
     */
    private $idCaja;



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
     * @return CierreCaja
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
     * Set ingresos
     *
     * @param string $ingresos
     * @return CierreCaja
     */
    public function setIngresos($ingresos)
    {
        $this->ingresos = $ingresos;
    
        return $this;
    }

    /**
     * Get ingresos
     *
     * @return string 
     */
    public function getIngresos()
    {
        return $this->ingresos;
    }

    /**
     * Set egresos
     *
     * @param string $egresos
     * @return CierreCaja
     */
    public function setEgresos($egresos)
    {
        $this->egresos = $egresos;
    
        return $this;
    }

    /**
     * Get egresos
     *
     * @return string 
     */
    public function getEgresos()
    {
        return $this->egresos;
    }

    /**
     * Set total
     *
     * @param string $total
     * @return CierreCaja
     */
    public function setTotal($total)
    {
        $this->total = $total;
    
        return $this;
    }

    /**
     * Get total
     *
     * @return string 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set idCaja
     *
     * @param Sistema\AdminBundle\Entity\Caja $idCaja
     * @return CierreCaja
     */
    public function setIdCaja(\Sistema\AdminBundle\Entity\Caja $idCaja = null)
    {
        $this->idCaja = $idCaja;
    
        return $this;
    }

    /**
     * Get idCaja
     *
     * @return Sistema\AdminBundle\Entity\Caja 
     */
    public function getIdCaja()
    {
        return $this->idCaja;
    }
}