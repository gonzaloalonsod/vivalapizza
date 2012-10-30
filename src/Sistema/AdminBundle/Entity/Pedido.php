<?php

namespace Sistema\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Sistema\AdminBundle\Entity\Pedido
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sistema\AdminBundle\Repository\FacturaRepository")
 */
class Pedido
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime $fecha
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var float $total
     *
     * @ORM\Column(name="total", type="float")
     */
    private $total;

    /**
     * @var Caja
     *
     * @ORM\ManyToOne(targetEntity="Caja")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pedido_id_caja", referencedColumnName="id")
     * })
     */
    private $idCaja;

//    /**
//     * @var Persona
//     *
//     * @ORM\ManyToOne(targetEntity="Persona")
//     * @ORM\JoinColumns({
//     *   @ORM\JoinColumn(name="id_mozo", referencedColumnName="id")
//     * })
//     */
//    private $idMozo;

    /**
     * @var Persona
     *
     * @ORM\ManyToOne(targetEntity="Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cliente", referencedColumnName="id")
     * })
     */
    private $idCliente;

    /**
     * @var array $lineasPedido
     *
     * @ORM\Column(name="lineasPedido", type="array")
     */
    private $lineasPedido;
    
    /**
     * @ORM\OneToOne(targetEntity="Factura")
     * @ORM\JoinColumn(name="pedido_factura_id", referencedColumnName="id", nullable=true)
     */
    private $idFactura;


    public function __construct() {
        $this->fecha = new \DateTime();
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Pedido
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
     * @return Pedido
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
     * Set lineasPedido
     *
     * @param array $lineasPedido
     * @return Pedido
     */
    public function setLineasPedido($lineasPedido)
    {
        $this->lineasPedido = $lineasPedido;
    
        return $this;
    }

    /**
     * Get lineasPedido
     *
     * @return array 
     */
    public function getLineasPedido()
    {
        return $this->lineasPedido;
    }

    /**
     * Set idFactura
     *
     * @param Sistema\AdminBundle\Entity\Factura $idFactura
     * @return Pedido
     */
    public function setIdFactura(\Sistema\AdminBundle\Entity\Factura $idFactura = null)
    {
        $this->idFactura = $idFactura;
    
        return $this;
    }

    /**
     * Get idFactura
     *
     * @return Sistema\AdminBundle\Entity\Factura 
     */
    public function getIdFactura()
    {
        return $this->idFactura;
    }

    /**
     * Set idCaja
     *
     * @param Sistema\AdminBundle\Entity\Caja $idCaja
     * @return Pedido
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

//    /**
//     * Set idMozo
//     *
//     * @param Sistema\AdminBundle\Entity\Persona $idMozo
//     * @return Pedido
//     */
//    public function setIdMozo(\Sistema\AdminBundle\Entity\Persona $idMozo = null)
//    {
//        $this->idMozo = $idMozo;
//    
//        return $this;
//    }
//
//    /**
//     * Get idMozo
//     *
//     * @return Sistema\AdminBundle\Entity\Persona 
//     */
//    public function getIdMozo()
//    {
//        return $this->idMozo;
//    }

    /**
     * Set idCliente
     *
     * @param Sistema\AdminBundle\Entity\Persona $idCliente
     * @return Pedido
     */
    public function setIdCliente(\Sistema\AdminBundle\Entity\Persona $idCliente = null)
    {
        $this->idCliente = $idCliente;
    
        return $this;
    }

    /**
     * Get idCliente
     *
     * @return Sistema\AdminBundle\Entity\Persona 
     */
    public function getIdCliente()
    {
        return $this->idCliente;
    }
}