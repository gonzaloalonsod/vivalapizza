<?php

namespace Sistema\GKValoracionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sistema\GKValoracionBundle\Entity\Valoracion
 *
 * @ORM\Table(name="gk_valoracion")
 * @ORM\Entity(repositoryClass="Sistema\GKValoracionBundle\Repository\ValoracionRepository")
 */
class Valoracion
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
     * @var integer $total_votos
     *
     * @ORM\Column(name="total_votos", type="integer")
     */
    private $total_votos;

    /**
     * @var integer $total_value
     *
     * @ORM\Column(name="total_value", type="integer")
     */
    private $total_value;
    
    
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
     * Set total_votos
     *
     * @param integer $totalVotos
     * @return Valor
     */
    public function setTotalVotos($totalVotos)
    {
        $this->total_votos = $totalVotos;
    
        return $this;
    }

    /**
     * Get total_votos
     *
     * @return integer 
     */
    public function getTotalVotos()
    {
        return $this->total_votos;
    }

    /**
     * Set total_value
     *
     * @param integer $totalValue
     * @return Valor
     */
    public function setTotalValue($totalValue)
    {
        $this->total_value = $totalValue;
    
        return $this;
    }

    /**
     * Get total_value
     *
     * @return integer 
     */
    public function getTotalValue()
    {
        return $this->total_value;
    }
}