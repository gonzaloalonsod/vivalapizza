<?php

namespace Sistema\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sistema\AdminBundle\Entity\TipoProducto
 *
 * @ORM\Table(name="tipo_producto")
 * @ORM\Entity
 */
class TipoProducto
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
     * @var string $descripcion
     *
     * @ORM\Column(name="descripcion", type="string", length=200, nullable=false)
     */
    private $descripcion;

    /**
     * @var float $precio
     *
     * @ORM\Column(name="precio", type="float", nullable=false)
     */
    private $precio;

    /**
     * @var Producto
     *
     * @ORM\ManyToOne(targetEntity="Producto", inversedBy="idTipoProducto")
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
     * @ORM\OneToOne(targetEntity="Sistema\GKValoracionBundle\Entity\Valoracion", cascade={"persist", "remove"})
     */
    private $idValoracion;
    

    public function __toString() {
        return $this->idProducto->getNombre().' - '.$this->descripcion;
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return TipoProducto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set precio
     *
     * @param float $precio
     * @return TipoProducto
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
     * Set idProducto
     *
     * @param Sistema\AdminBundle\Entity\Producto $idProducto
     * @return TipoProducto
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

    /**
     * Set idValoracion
     *
     * @param Sistema\GKValoracionBundle\Entity\Valoracion $idValoracion
     * @return TipoProducto
     */
    public function setIdValoracion(\Sistema\GKValoracionBundle\Entity\Valoracion $idValoracion = null)
    {
        $this->idValoracion = $idValoracion;
    
        return $this;
    }

    /**
     * Get idValoracion
     *
     * @return Sistema\GKValoracionBundle\Entity\Valoracion 
     */
    public function getIdValoracion()
    {
        return $this->idValoracion;
    }
}