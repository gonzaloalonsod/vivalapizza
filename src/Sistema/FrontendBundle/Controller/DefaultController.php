<?php

namespace Sistema\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="frontend_index")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    
    /**
     * @Route("/promociones", name="frontend_promociones")
     * @Template()
     */
    public function promocionesAction()
    {
        $repository = $this->getDoctrine()->getRepository('SistemaAdminBundle:Promocion');
        
        $fecha = new \DateTime('yesterday');
        $query = $repository->createQueryBuilder('p')
                ->where('p.validoHasta > :fecha')
                ->setParameter('fecha', $fecha)
                ->getQuery()
        ;
        $promociones = $query->getResult();
        return array(
            'promociones' => $promociones,
        );
    }
    
    /**
     * @Route("/menu", name="frontend_menu")
     * @Template()
     */
    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SistemaAdminBundle:Producto')->findAll();
        return array(
            'entities' => $entities,
        );
    }
}
