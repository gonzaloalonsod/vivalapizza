<?php

namespace Sistema\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;

use Sistema\AdminBundle\Entity\CierreCaja;
use Sistema\AdminBundle\Form\CierreCajaType;
use Sistema\AdminBundle\Form\CierreCajaFilterType;

/**
 * CierreCaja controller.
 *
 * @Route("/cierrecaja")
 */
class CierreCajaController extends Controller
{
    /**
     * Lists all CierreCaja entities.
     *
     * @Route("/", name="cierrecaja")
     * @Template()
     */
    public function indexAction()
    {
        list($filterForm, $queryBuilder) = $this->filter();

        list($entities, $pagerHtml) = $this->paginator($queryBuilder);

    
        return array(
            'entities' => $entities,
            'pagerHtml' => $pagerHtml,
            'filterForm' => $filterForm->createView(),
        );
    }

    /**
    * Create filter form and process filter request.
    *
    */
    protected function filter()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $filterForm = $this->createForm(new CierreCajaFilterType());
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('SistemaAdminBundle:CierreCaja')->createQueryBuilder('e');
    
        // Reset filter
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {
            $session->remove('CierreCajaControllerFilter');
        }
    
        // Filter action
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'filter') {
            // Bind values from the request
            $filterForm->bind($request);

            if ($filterForm->isValid()) {
                // Build the query from the given form object
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
                // Save filter to session
                $filterData = $filterForm->getData();
                $session->set('CierreCajaControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('CierreCajaControllerFilter')) {
                $filterData = $session->get('CierreCajaControllerFilter');
                $filterForm = $this->createForm(new CierreCajaFilterType(), $filterData);
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
            }
        }
    
        return array($filterForm, $queryBuilder);
    }

    /**
    * Get results from paginator and get paginator view.
    *
    */
    protected function paginator($queryBuilder)
    {
        // Paginator
        $adapter = new DoctrineORMAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($adapter);
        $currentPage = $this->getRequest()->get('page', 1);
        $pagerfanta->setCurrentPage($currentPage);
        $entities = $pagerfanta->getCurrentPageResults();
    
        // Paginator - route generator
        $me = $this;
        $routeGenerator = function($page) use ($me)
        {
            return $me->generateUrl('cierrecaja', array('page' => $page));
        };
    
        // Paginator - view
        $translator = $this->get('translator');
        $view = new TwitterBootstrapView();
        $pagerHtml = $view->render($pagerfanta, $routeGenerator, array(
            'proximity' => 3,
            'prev_message' => $translator->trans('views.index.pagprev', array(), 'JordiLlonchCrudGeneratorBundle'),
            'next_message' => $translator->trans('views.index.pagnext', array(), 'JordiLlonchCrudGeneratorBundle'),
        ));
    
        return array($entities, $pagerHtml);
    }
    
    /**
     * Finds and displays a CierreCaja entity.
     *
     * @Route("/{id}/show", name="cierrecaja_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SistemaAdminBundle:CierreCaja')->find($id);
        
        $detalles = $this->calcularingresosdetalle($id);
        $efectivo = $this->calcularingresosEfectivo($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CierreCaja entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        
        $propinas = $this->calcularPorMozo($entity->getIdCaja());

        return array(
            'efectivos'   => $efectivo,
            'detalles'    => $detalles, 
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'propinas'    => $propinas
        );
    }

    /**
     * Displays a form to create a new CierreCaja entity.
     *
     * @Route("/new", name="cierrecaja_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CierreCaja();
        $form   = $this->createForm(new CierreCajaType(), $entity);
        //$entity->setIngresos($this->calcularingresos());
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new CierreCaja entity.
     *
     * @Route("/create", name="cierrecaja_create")
     * @Method("post")
     * @Template("SistemaAdminBundle:CierreCaja:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new CierreCaja();
        
                
        $request = $this->getRequest();
        $form    = $this->createForm(new CierreCajaType(), $entity);
        $form->bind($request);
        $caja = $entity->getIdCaja();
        $entity->setIngresos($this->calcularingresos($caja));
        $entity->setEgresos($this->calcularegresos($caja));
        $entity->setTotal($this->calcularingresos($caja)-$this->calcularegresos($caja));
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.create.success');

            return $this->redirect($this->generateUrl('cierrecaja_show', array('id' => $entity->getId())));        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.create.error');
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }
    /**
     * Displays a form to edit an existing CierreCaja entity.
     *
     * @Route("/{id}/edit", name="cierrecaja_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SistemaAdminBundle:CierreCaja')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CierreCaja entity.');
        }

        $editForm = $this->createForm(new CierreCajaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing CierreCaja entity.
     *
     * @Route("/{id}/update", name="cierrecaja_update")
     * @Method("post")
     * @Template("SistemaAdminBundle:CierreCaja:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SistemaAdminBundle:CierreCaja')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CierreCaja entity.');
        }

        $editForm   = $this->createForm(new CierreCajaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.update.success');

            return $this->redirect($this->generateUrl('cierrecaja_edit', array('id' => $id)));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.update.error');
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a CierreCaja entity.
     *
     * @Route("/{id}/delete", name="cierrecaja_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SistemaAdminBundle:CierreCaja')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CierreCaja entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.delete.error');
        }

        return $this->redirect($this->generateUrl('cierrecaja'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    /**
     * Creates a new CierreCaja entity.
     *
     * @Route("/jojo", name="cierrecaja_jojo")     
     * @Template("SistemaAdminBundle:CierreCaja:jojo.html.twig")
     */
    public function jojoAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery(
            'SELECT p FROM SistemaAdminBundle:Factura p WHERE p.idCaja = :caja and p.formaPago = :formaPago'
        )->setParameters(array(
    'caja' => '1',
    'formaPago'  => 'tarjeta',
));        
        $ingresos=0;
        $entity = $query->getResult();
        foreach ($entity as $lf) {
            //echo $lf->getTotal();
            echo $lf->getFormaPago();
            echo $lf->getBanco();
        }
        return $ingresos;
        //var_dump($entity);
        return array(
            'entity'      => $entity,            
        );
    }
    
    public function calcularingresos($id){
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery(
            'SELECT p FROM SistemaAdminBundle:Factura p WHERE p.idCaja = :caja'
        )->setParameter('caja', $id);        
        $ingresos=0;
        $entity = $query->getResult();
        foreach ($entity as $lf) {
            //echo $lf->getTotal();
            $ingresos=$ingresos+$lf->getTotal();
        }
        return $ingresos;
        //var_dump($entity);
    }
    
    public function calcularegresos($id){
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery(
            'SELECT p FROM SistemaAdminBundle:Factura p WHERE p.idCaja = :caja'
        )->setParameter('caja', $id);        
        $ingresos=0;
        $entity = $query->getResult();
        foreach ($entity as $lf) {
            //echo $lf->getTotal();
            $ingresos=$ingresos+$lf->getTotal();
        }
        $egresos= 0.15*$ingresos;
        return $egresos;
        //var_dump($entity);
    }
    
    public function calcularingresosdetalle($id){
         $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery(
            'SELECT p FROM SistemaAdminBundle:Factura p WHERE p.idCaja = :caja and p.formaPago = :formaPago'
        )->setParameters(array(
    'caja' => $id,
    'formaPago'  => 'tarjeta',
));         
        $entity = $query->getResult();
//        foreach ($entity as $lf) {
//            //echo $lf->getTotal();
//            //echo $lf->getFormaPago();
//            //echo $lf->getBanco();
//        }
        return $entity;
        //var_dump($entity);
    }
    
    public function calcularingresosEfectivo($id){
         $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery(
            'SELECT p FROM SistemaAdminBundle:Factura p WHERE p.idCaja = :caja and p.formaPago = :formaPago'
        )->setParameters(array(
    'caja' => $id,
    'formaPago'  => 'contado',
));        
        $entity = $query->getResult();
//        foreach ($entity as $lf) {
//            //echo $lf->getTotal();
//            //echo $lf->getFormaPago();
//            //echo $lf->getBanco();
//        }
        return $entity;
        //var_dump($entity);
    }
}
