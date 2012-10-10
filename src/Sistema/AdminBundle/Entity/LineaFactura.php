<?php

namespace Sistema\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sistema\AdminBundle\Entity\LineaFactura
 *
 * @ORM\Table(name="linea_factura")
 * @ORM\Entity
 */
class LineaFactura
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
     * @var integer $cantidad
     *
     * @ORM\Column(name="cantidad", type="bigint", nullable=false)
     */
    private $cantidad;

    /**
     * @var float $total
     *
     * @ORM\Column(name="total", type="float", nullable=false)
     */
    private $total;

    /**
     * @var Factura
     *
     * @ORM\ManyToOne(targetEntity="Factura")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_factura", referencedColumnName="id")
     * })
     */
    private $idFactura;

    /**
     * @var Producto
     *
     * @ORM\ManyToOne(targetEntity="Producto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_producto", referencedColumnName="id")
     * })
     */
    private $idProducto;



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
     * Set cantidad
     *
     * @param integer $cantidad
     * @return LineaFactura
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    
        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set total
     *
     * @param float $total
     * @return LineaFactura
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
     * Set idFactura
     *
     * @param Sistema\AdminBundle\Entity\Factura $idFactura
     * @return LineaFactura
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
     * Set idProducto
     *
     * @param Sistema\AdminBundle\Entity\Producto $idProducto
     * @return LineaFactura
     */
    public function setIdProducto(\Sistema\AdminBundle\Entity\Producto $idProducto = null)
    {
        $this->idProducto = $idProducto;
    
        return $this;
    }

    /**
     * Get idProducto
     *
     * @return Sistema\AdminBundle\Entity\Producto 
     */
    public function getIdProducto()
    {
        return $this->idProducto;
    }
}