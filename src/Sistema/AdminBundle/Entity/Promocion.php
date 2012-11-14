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
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=200, nullable=false)
     */
    private $nombre;

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
     * @ORM\ManyToMany(targetEntity="TipoProducto")
     * @ORM\JoinTable(name="TipoProducto_de_Promocion",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_Promocion", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_Producto", referencedColumnName="id")
     *   }
     * )
     */
    private $idProducto;
    
    /**
     * @var string $cantidad_vendido
     *
     * @ORM\Column(name="cantidad_vendido", type="string", length=200, nullable=true)
     */
    private $cantidad_vendido;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idProducto = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     * @return Promocion
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Add idProducto
     *
     * @param Sistema\AdminBundle\Entity\TipoProducto $idProducto
     * @return Promocion
     */
    public function addIdProducto(\Sistema\AdminBundle\Entity\TipoProducto $idProducto)
    {
        $this->idProducto[] = $idProducto;
    
        return $this;
    }

    /**
     * Remove idProducto
     *
     * @param Sistema\AdminBundle\Entity\TipoProducto $idProducto
     */
    public function removeIdProducto(\Sistema\AdminBundle\Entity\TipoProducto $idProducto)
    {
        $this->idProducto->removeElement($idProducto);
    }

    /**
     * Get idProducto
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getIdProducto()
    {
        return $this->idProducto;
    }
}