<?php

namespace Sistema\GKValoracionBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class ValoracionRepository extends EntityRepository
{
    /**
     * Busca valoracion por id tipo producto.
     */
    public function findValoracion($idTipoProducto) {
        $em = $this->getEntityManager();
        $consulta = $em->createQuery('SELECT v FROM SistemaGKValoracionBundle:Valoracion v
                                        JOIN SistemaAdminBundle:TipoProducto tp
                                        WHERE tp.idValoracion = v.id AND tp.id = :id
             ');
        $consulta->setParameter('id', $idTipoProducto);
        return $consulta->getOneOrNullResult();
    }
}