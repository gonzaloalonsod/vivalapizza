<?php

namespace Sistema\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sistema\AdminBundle\Entity\Opinion
 *
 * @ORM\Table(name="opinion")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Opinion
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
     * @var TipoProducto
     *
     * @ORM\ManyToOne(targetEntity="TipoProducto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipoproducto", referencedColumnName="id")
     * })
     */
    private $idTipoProducto;

    /**
     * @var string $comentario
     *
     * @ORM\Column(name="comentario", type="string", length=200, nullable=false)
     */
    private $comentario;
    
    /**
     * @var string $valoracion
     *
     * @ORM\Column(name="valoracion", type="string", length=200, nullable=false)
     */
    private $valoracion;


    public function __toString() {
        return $this->id;
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
     * Set idTipoProducto
     *
     * @param Sistema\AdminBundle\Entity\TipoProducto $idTipoProducto
     * @return LineaFactura
     */
    public function setIdTipoProducto(\Sistema\AdminBundle\Entity\TipoProducto $idTipoProducto = null)
    {
        $this->idTipoProducto = $idTipoProducto;
    
        return $this;
    }

    /**
     * Get idTipoProducto
     *
     * @return Sistema\AdminBundle\Entity\TipoProducto 
     */
    public function getIdTipoProducto()
    {
        return $this->idTipoProducto;
    }
    
    /**
     * Set comentario
     *
     * @param string $comentario
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }

    /**
     * Get comentario
     *
     * @return string 
     */
    public function getComentario()
    {
        return $this->comentario;
    }
    
    /**
     * Set valoracion
     *
     * @param string $valoracion
     * @return Producto
     */
    public function setValoracion($valoracion)
    {
        $this->valoracion = $valoracion;
    
        return $this;
    }

    /**
     * Get valoracion
     *
     * @return string 
     */
    public function getValoracion()
    {
        return $this->valoracion;
    }
    
   
}