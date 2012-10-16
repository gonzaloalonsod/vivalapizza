<?php

namespace Sistema\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;

use Sistema\AdminBundle\Entity\Promocion;
use Sistema\AdminBundle\Form\PromocionType;
use Sistema\AdminBundle\Form\PromocionFilterType;

/**
 * Promocion controller.
 *
 * @Route("/promocion")
 */
class PromocionController extends Controller
{
    /**
     * Lists all Promocion entities.
     *
     * @Route("/", name="promocion")
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
    protected function filter($vigentes = null)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $filterForm = $this->createForm(new PromocionFilterType());
        $em = $this->getDoctrine()->getManager();
        if (!$vigentes) {//obtengo todas las promociones
            $queryBuilder = $em->getRepository('SistemaAdminBundle:Promocion')->createQueryBuilder('e');
        } else {//obtengo las promociones vigentes
            $fecha = new \DateTime('yesterday');
            $queryBuilder = $em->getRepository('SistemaAdminBundle:Promocion')->createQueryBuilder('e')
                    ->where('e.validoHasta > :fecha')
                    ->setParameter('fecha', $fecha)
            ;
        }
        
    
        // Reset filter
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {
            $session->remove('PromocionControllerFilter');
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
                $session->set('PromocionControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('PromocionControllerFilter')) {
                $filterData = $session->get('PromocionControllerFilter');
                $filterForm = $this->createForm(new PromocionFilterType(), $filterData);
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
            return $me->generateUrl('promocion', array('page' => $page));
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
     * Finds and displays a Promocion entity.
     *
     * @Route("/{id}/show", name="promocion_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SistemaAdminBundle:Promocion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Promocion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Promocion entity.
     *
     * @Route("/new", name="promocion_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Promocion();
        $form   = $this->createForm(new PromocionType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Promocion entity.
     *
     * @Route("/create", name="promocion_create")
     * @Method("post")
     * @Template("SistemaAdminBundle:Promocion:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Promocion();
        $request = $this->getRequest();
        $form    = $this->createForm(new PromocionType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.create.success');

            return $this->redirect($this->generateUrl('promocion_show', array('id' => $entity->getId())));        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.create.error');
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }
    /**
     * Displays a form to edit an existing Promocion entity.
     *
     * @Route("/{id}/edit", name="promocion_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SistemaAdminBundle:Promocion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Promocion entity.');
        }

        $editForm = $this->createForm(new PromocionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Promocion entity.
     *
     * @Route("/{id}/update", name="promocion_update")
     * @Method("post")
     * @Template("SistemaAdminBundle:Promocion:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SistemaAdminBundle:Promocion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Promocion entity.');
        }

        $editForm   = $this->createForm(new PromocionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.update.success');

            return $this->redirect($this->generateUrl('promocion_edit', array('id' => $id)));
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
     * Deletes a Promocion entity.
     *
     * @Route("/{id}/delete", name="promocion_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SistemaAdminBundle:Promocion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Promocion entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.delete.error');
        }

        return $this->redirect($this->generateUrl('promocion'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    /**
     * Lists all Promocion entities.
     *
     * @Route("/vigentes", name="promocion_vigentes")
     * @Template("SistemaAdminBundle:Promocion:index.html.twig")
     */
    public function vigentesAction()
    {
        list($filterForm, $queryBuilder) = $this->filter(1);

        list($entities, $pagerHtml) = $this->paginator($queryBuilder);

    
        return array(
            'entities' => $entities,
            'pagerHtml' => $pagerHtml,
            'filterForm' => $filterForm->createView(),
        );
    }
}