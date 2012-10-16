<?php

namespace Sistema\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Sistema\AdminBundle\Entity\Factura
 *
 * @ORM\Table(name="factura")
 * @ORM\Entity
 */
class Factura {

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
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var float $total
     *
     * @ORM\Column(name="total", type="float", nullable=false)
     */
    private $total;

    /**
     * @var string $formaPago
     *
     * @ORM\Column(name="forma_pago", type="string", length=200, nullable=false)
     */
    private $formaPago;

    /**
     * @var string $nroComprobante
     *
     * @ORM\Column(name="nro_comprobante", type="string", length=200, nullable=true)
     */
    private $nroComprobante;

    /**
     * @var string $banco
     *
     * @ORM\Column(name="banco", type="string", length=200, nullable=true)
     */
    private $banco;

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
     * @var Persona
     *
     * @ORM\ManyToOne(targetEntity="Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_mozo", referencedColumnName="id")
     * })
     */
    private $idMozo;

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
     * @ORM\OneToMany(targetEntity="LineaFactura", mappedBy="idFactura", cascade={"persist", "remove"})
     */
    private $idLineaFactura;

    public function __construct()
    {
        $this->idLineaFactura = new ArrayCollection();
        $this->fecha =  new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Factura
     */
    public function setFecha($fecha) {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha() {
        return $this->fecha;
    }

    /**
     * Set total
     *
     * @param float $total
     * @return Factura
     */
    public function setTotal($total) {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal() {
        return $this->total;
    }

    /**
     * Set formaPago
     *
     * @param string $formaPago
     * @return Factura
     */
    public function setFormaPago($formaPago) {
        $this->formaPago = $formaPago;

        return $this;
    }

    /**
     * Get formaPago
     *
     * @return string 
     */
    public function getFormaPago() {
        return $this->formaPago;
    }

    /**
     * Set nroComprobante
     *
     * @param string $nroComprobante
     * @return Factura
     */
    public function setNroComprobante($nroComprobante) {
        $this->nroComprobante = $nroComprobante;

        return $this;
    }

    /**
     * Get nroComprobante
     *
     * @return string 
     */
    public function getNroComprobante() {
        return $this->nroComprobante;
    }

    /**
     * Set banco
     *
     * @param string $banco
     * @return Factura
     */
    public function setBanco($banco) {
        $this->banco = $banco;

        return $this;
    }

    /**
     * Get banco
     *
     * @return string 
     */
    public function getBanco() {
        return $this->banco;
    }

    /**
     * Set idCaja
     *
     * @param Sistema\AdminBundle\Entity\Caja $idCaja
     * @return Factura
     */
    public function setIdCaja(\Sistema\AdminBundle\Entity\Caja $idCaja = null) {
        $this->idCaja = $idCaja;

        return $this;
    }

    /**
     * Get idCaja
     *
     * @return Sistema\AdminBundle\Entity\Caja 
     */
    public function getIdCaja() {
        return $this->idCaja;
    }

    /**
     * Set idMozo
     *
     * @param Sistema\AdminBundle\Entity\Persona $idMozo
     * @return Factura
     */
    public function setIdMozo(\Sistema\AdminBundle\Entity\Persona $idMozo = null) {
        $this->idMozo = $idMozo;

        return $this;
    }

    /**
     * Get idMozo
     *
     * @return Sistema\AdminBundle\Entity\Persona 
     */
    public function getIdMozo() {
        return $this->idMozo;
    }

    /**
     * Set idCliente
     *
     * @param Sistema\AdminBundle\Entity\Persona $idCliente
     * @return Factura
     */
    public function setIdCliente(\Sistema\AdminBundle\Entity\Persona $idCliente = null) {
        $this->idCliente = $idCliente;

        return $this;
    }

    /**
     * Get idCliente
     *
     * @return Sistema\AdminBundle\Entity\Persona 
     */
    public function getIdCliente() {
        return $this->idCliente;
    }

    public function __toString() {
        return $this->getId();
    }

    /**
     * Add idLineaFactura
     *
     * @param Sistema\AdminBundle\Entity\LineaFactura $idLineaFactura
     * @return Factura
     */
    public function addIdLineaFactura(\Sistema\AdminBundle\Entity\LineaFactura $idLineaFactura)
    {
        $this->idLineaFactura[] = $idLineaFactura;
    
        return $this;
    }

    /**
     * Remove idLineaFactura
     *
     * @param Sistema\AdminBundle\Entity\LineaFactura $idLineaFactura
     */
    public function removeIdLineaFactura(\Sistema\AdminBundle\Entity\LineaFactura $idLineaFactura)
    {
        $this->idLineaFactura->removeElement($idLineaFactura);
    }

    /**
     * Get idLineaFactura
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getIdLineaFactura()
    {
        return $this->idLineaFactura;
    }

    /**
     * Set idLineaFactura
     *
     * @return LineaFactura
     */
    public function setIdLineaFactura(ArrayCollection $idLineaFactura)
    {
        foreach ($idLineaFactura as $lf) {
            $lf->setIdFactura($this);
        }

        $this->idLineaFactura = $idLineaFactura;
        
        return $this;
    }
}
