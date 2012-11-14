<?php

namespace Sistema\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class ProductoRepository extends EntityRepository
{
    /**
     * Busca personas por autocomplete.
     */
    public function allProductoTipoProducto() {
        $em = $this->getEntityManager();
        $consulta = $em->createQuery('SELECT p,tp,v FROM SistemaAdminBundle:Producto p
                                        JOIN p.idTipoProducto tp
                                        LEFT JOIN tp.idValoracion v
             ');
//        $consulta = $em->createQuery('select * from producto as p
//                                        inner join tipo_producto as tp
//                                        left join gk_valoracion as v
//                                        on tp.IdValoracion_id = v.Id
//             ');
//        $consulta = $em->createQuery('select p,tp,v from SistemaAdminBundle:Producto p
//                                        inner join p.idTipoProducto tp
//                                        left join tp.idValoracion v
//                                        where tp.idValoracion = v.id
//             ');
//        $rsm = new ResultSetMapping;
//        $rsm->addEntityResult('SistemaAdminBundle:Producto', 'p');
//        $rsm->addFieldResult('p', 'id', 'id');
//        $rsm->addFieldResult('p', 'nombre', 'nombre');
//        $rsm->addFieldResult('p', 'imagen', 'imagen');
//        $rsm->addJoinedEntityResult('SistemaAdminBundle:TipoProducto' , 'tp', 'p', 'idTipoProducto');
//        $rsm->addFieldResult('tp', 'id', 'id');
//        $rsm->addFieldResult('tp', 'id_valoracion', 'id_valoracion');
//        $rsm->addJoinedEntityResult('SistemaGKValoracionBundle:Valoracion' , 'a', 'tp', 'valoracion');
//        $rsm->addFieldResult('a', 'id', 'id');
//        $consulta = $em->createNativeQuery('select * from producto as p
//                                            inner join tipo_producto as tp
//                                            left join gk_valoracion as v
//                                            on tp.IdValoracion_id = v.Id', $rsm);
//         $consulta->setParameter('value', '%'.$value.'%');
         
         return $consulta->getArrayResult();
    }
//    /**
//     * Busca pedidos por caja.
//     */
//    public function buscarPedidoPorCaja($id) {
//        $em = $this->getEntityManager();
//        $consulta = $em->createQuery('SELECT p FROM SistemaAdminBundle:Pedido p
//                                        WHERE p.idCaja = :id
//            ');
//        $consulta->setParameter('id', $id);
//        return $consulta->getResult();
//    }
//    /**
//     * Busca los equipos de un grupo de un torneo segun cualquier fecha del torneo.
//     */
//    public function findEquiposDeGrupo($idGrupo) {
//        $em = $this->getEntityManager();
//        $consulta = $em->createQuery('SELECT e FROM SistemaAdminBundle:Equipo e
//                                        JOIN e.idGrupo grupoequipo
//                                        WHERE grupoequipo.id = :idGrupo
//             ');
//         $consulta->setParameter('idGrupo', $idGrupo);
//         
//         return $consulta->getResult();
//    }
//    /**
//     * Busca los equipos de un grupo de un torneo segun cualquier fecha del torneo.
//     */
//    public function findEquiposDeGrupoByFecha($idFecha) {
//        $em = $this->getEntityManager();
//        $consulta = $em->createQuery('SELECT e FROM SistemaAdminBundle:Equipo e
//                                        JOIN e.idGrupo grupoequipo
//                                        JOIN grupoequipo.idFecha f
//                                        JOIN f.idGrupo grupofecha
//                                        WHERE f.id = :idFecha AND grupofecha.id = grupoequipo.id
//             ');
//         $consulta->setParameter('idFecha', $idFecha);
//         
//         return $consulta->getResult();
//    }
//    /**
//     * no funciona
//     */
//    public function findEquiposNoInscriptos($idFecha)
//    {
//        $em = $this->getEntityManager();
//        
//        $consulta = $em->createQuery('SELECT e FROM SistemaAdminBundle:Equipo e
//                                      JOIN e.idPartido partidodeequipo
//                                      JOIN partidodeequipo.idPartido partido
//                                      JOIN partido.idFecha f
//                                      JOIN partidodeequipo.idEquipo equipo
//                                      JOIN f.idGrupo grupofecha
//                                      JOIN e.idGrupo grupoequipo
//                                      WHERE grupofecha.id = grupoequipo.id');
//        $consulta = $em->createQuery('SELECT e FROM SistemaAdminBundle:Equipo e
//                                      JOIN e.idGrupo grupoequipo
//                                      JOIN grupoequipo.idFecha f
//                                      JOIN f.idGrupo grupofecha
//                                      WHERE grupofecha.id = grupoequipo.id');
//        $consulta = $em->createQuery('SELECT e FROM SistemaAdminBundle:Equipo e
//                                      LEFT JOIN e.idGrupo grupoequipo
//                                      LEFT JOIN grupoequipo.idFecha f
//                                      LEFT JOIN f.idGrupo grupofecha
//                                      LEFT JOIN e.idPartido partidodeequipo
//                                      LEFT JOIN partidodeequipo.idPartido partido
//                                      LEFT JOIN partidodeequipo.idEquipo equipo
//                                      LEFT JOIN partido.idFecha fec
//                                      WHERE (grupofecha.id = grupoequipo.id) AND EXISTS (
//                                            SELECT fecha FROM SistemaAdminBundle:Fecha fecha
//                                                WHERE e.id = equipo.id
////                                      )');
//          $consulta = $em->createQuery('SELECT e FROM SistemaAdminBundle:Equipo e
//                                      LEFT JOIN e.idGrupo grupoequipo
//                                      LEFT JOIN grupoequipo.idFecha f
//                                      LEFT JOIN f.idGrupo grupofecha
//                                      LEFT JOIN e.idPartido partidodeequipo
//                                      LEFT JOIN partidodeequipo.idPartido partido
//                                      LEFT JOIN partidodeequipo.idEquipo equipo
//                                      WHERE grupofecha.id = grupoequipo.id AND EXISTS (
//                                            SELECT fecha FROM SistemaAdminBundle:Fecha fecha
//                                                WHERE fecha.id = :idFecha
//                                      )');
////        $consulta->setMaxResults($cantidad);
//        $consulta->setParameter('idFecha', $idFecha);
//        
//        return $consulta->getResult();
//    }
}