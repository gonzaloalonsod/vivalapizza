<?php

namespace Sistema\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

class FacturaRepository extends EntityRepository
{
    /**
     * Busca personas por autocomplete.
     */
    public function buscarPorNomApe($value) {
        $em = $this->getEntityManager();
        $consulta = $em->createQuery('SELECT p FROM SistemaAdminBundle:Persona p
                                        WHERE p.nombre LIKE :value OR p.apellido LIKE :value
             ');
         $consulta->setParameter('value', '%'.$value.'%');
         
         return $consulta->getResult();
    }
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