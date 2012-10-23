<?php

namespace Sistema\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sistema\AdminBundle\Entity\Caja
 *
 * @ORM\Table(name="caja")
 * @ORM\Entity
 */
class Caja {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime $inicioCaja
     *
     * @ORM\Column(name="inicio_caja", type="time", nullable=false)
     */
    private $inicioCaja;

    /**
     * @var \DateTime $cierreCaja
     *
     * @ORM\Column(name="cierre_caja", type="time", nullable=true)
     */
    private $cierreCaja;

    /**
     * @var string $montoInicial
     *
     * @ORM\Column(name="monto_inicial", type="string", length=200, nullable=false)
     */
    private $montoInicial;

    /**
     * @var Persona
     *
     * @ORM\ManyToOne(targetEntity="Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cajero", referencedColumnName="id")
     * })
     */
    private $idCajero;
    
    /**
     * @ORM\OneToMany(targetEntity="Factura", mappedBy="idCaja", cascade={"persist", "remove"})
     */
    private $idFactura;

    public function __construct() {
        $this->inicioCaja = new \DateTime();
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
     * Set inicioCaja
     *
     * @param \DateTime $inicioCaja
     * @return Caja
     */
    public function setInicioCaja($inicioCaja) {
        $this->inicioCaja = $inicioCaja;

        return $this;
    }

    /**
     * Get inicioCaja
     *
     * @return \DateTime 
     */
    public function getInicioCaja() {
        return $this->inicioCaja;
    }

    /**
     * Set cierreCaja
     *
     * @param \DateTime $cierreCaja
     * @return Caja
     */
    public function setCierreCaja($cierreCaja) {
        $this->cierreCaja = $cierreCaja;

        return $this;
    }

    /**
     * Get cierreCaja
     *
     * @return \Time 
     */
    public function getCierreCaja() {
        return $this->cierreCaja;
    }

    /**
     * Set montoInicial
     *
     * @param string $montoInicial
     * @return Caja
     */
    public function setMontoInicial($montoInicial) {
        $this->montoInicial = $montoInicial;

        return $this;
    }

    /**
     * Get montoInicial
     *
     * @return string 
     */
    public function getMontoInicial() {
        return $this->montoInicial;
    }

    /**
     * Set idCajero
     *
     * @param Sistema\AdminBundle\Entity\Persona $idCajero
     * @return Caja
     */
    public function setIdCajero(\Sistema\AdminBundle\Entity\Persona $idCajero = null) {
        $this->idCajero = $idCajero;

        return $this;
    }

    /**
     * Get idCajero
     *
     * @return Sistema\AdminBundle\Entity\Persona 
     */
    public function getIdCajero() {
        return $this->idCajero;
    }

    public function __toString() {
        return $this->getId();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idFactura = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add idFactura
     *
     * @param Sistema\AdminBundle\Entity\Factura $idFactura
     * @return Caja
     */
    public function addIdFactura(\Sistema\AdminBundle\Entity\Factura $idFactura)
    {
        $this->idFactura[] = $idFactura;
    
        return $this;
    }

    /**
     * Remove idFactura
     *
     * @param Sistema\AdminBundle\Entity\Factura $idFactura
     */
    public function removeIdFactura(\Sistema\AdminBundle\Entity\Factura $idFactura)
    {
        $this->idFactura->removeElement($idFactura);
    }

    /**
     * Get idFactura
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getIdFactura()
    {
        return $this->idFactura;
    }
}
