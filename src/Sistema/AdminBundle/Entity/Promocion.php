<?php

namespace Sistema\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sistema\AdminBundle\Entity\Promocion
 *
 * @ORM\Table(name="promocion")
 * @ORM\Entity
 */
class Promocion
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
     * @var float $precio
     *
     * @ORM\Column(name="precio", type="float", nullable=false)
     */
    private $precio;

    /**
     * @var \DateTime $validoHasta
     *
     * @ORM\Column(name="valido_hasta", type="date", nullable=false)
     */
    private $validoHasta;

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
     * @var string $cantidad_vendido
     *
     * @ORM\Column(name="cantidad_vendido", type="string", length=200, nullable=true)
     */
    private $cantidad_vendido;



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
     * Set precio
     *
     * @param float $precio
     * @return Promocion
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    
        return $this;
    }

    /**
     * Get precio
     *
     * @return float 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set validoHasta
     *
     * @param \DateTime $validoHasta
     * @return Promocion
     */
    public function setValidoHasta($validoHasta)
    {
        $this->validoHasta = $validoHasta;
    
        return $this;
    }

    /**
     * Get validoHasta
     *
     * @return \DateTime 
     */
    public function getValidoHasta()
    {
        return $this->validoHasta;
    }

    /**
     * Set idProducto
     *
     * @param Sistema\AdminBundle\Entity\Producto $idProducto
     * @return Promocion
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
    
    /**
     * Set cantidad_vendido
     *
     * @param string $cantidad_vendido
     * @return Producto
     */
    public function setCantidadVendido($cantidad_vendido)
    {
        $this->cantidad_vendido = $cantidad_vendido;
    
        return $this;
    }

    /**
     * Get cantidad_vendido
     *
     * @return string 
     */
    public function getCantidadVendido()
    {
        return $this->cantidad_vendido;
    }
}