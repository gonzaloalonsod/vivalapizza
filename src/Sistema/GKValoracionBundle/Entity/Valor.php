<?php

namespace Sistema\GKValoracionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sistema\GKValoracionBundle\Entity\Valor
 *
 * @ORM\Table(name="gk_valor")
 * @ORM\Entity
 */
class Valor
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
     * @var integer $value
     *
     * @ORM\Column(name="value", type="integer")
     */
    private $value;
    
    /**
     * @ORM\ManyToOne(targetEntity="Valoracion")
     * @ORM\JoinColumn(name="valoracion_valor_id", referencedColumnName="id")
     */
    private $idValoracion;


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
     * Set value
     *
     * @param integer $value
     * @return Valor
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }

    /**
     * Get value
     *
     * @return integer 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set idValoracion
     *
     * @param Sistema\GKValoracionBundle\Entity\Valoracion $idValoracion
     * @return Valor
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