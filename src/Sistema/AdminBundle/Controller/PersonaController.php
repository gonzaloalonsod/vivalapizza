<?php

namespace Sistema\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;

use Sistema\AdminBundle\Entity\Persona;
use Sistema\AdminBundle\Form\PersonaType;
use Sistema\AdminBundle\Form\PersonaFilterType;

/**
 * Persona controller.
 *
 * @Route("/persona")
 */
class PersonaController extends Controller
{
    /**
     * Lists all Persona entities.
     *
     * @Route("/", name="persona")
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
        $filterForm = $this->createForm(new PersonaFilterType());
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('SistemaAdminBundle:Persona')->createQueryBuilder('e');
    
        // Reset filter
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {
            $session->remove('PersonaControllerFilter');
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
                $session->set('PersonaControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('PersonaControllerFilter')) {
                $filterData = $session->get('PersonaControllerFilter');
                $filterForm = $this->createForm(new PersonaFilterType(), $filterData);
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
            return $me->generateUrl('persona', array('page' => $page));
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
     * Finds and displays a Persona entity.
     *
     * @Route("/{id}/show", name="persona_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SistemaAdminBundle:Persona')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Persona entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

//    /**
//     * Displays a form to create a new Persona entity.
//     *
//     * @Route("/new", name="persona_new")
//     * @Template()
//     */
//    public function newAction()
//    {
//        $entity = new Persona();
//        $form   = $this->createForm(new PersonaType(), $entity);
//
//        return array(
//            'entity' => $entity,
//            'form'   => $form->createView(),
//        );
//    }

    /**
     * Displays a form to create a new Persona entity.
     *
     * @Route("/new", name="persona_new")
     * @Template()
     */
    public function newAction() {
       $user = new Persona(); // Should be your user entity. Has to be an object, won't work properly with an array.

       $flow = $this->get('sistemaAdmin.form.flow.nuevoPersona'); // must match the flow's service id
       $flow->bind($user);

       // form of the current step
       $form = $flow->createForm($user);

       return array(
           'form' => $form->createView(),
           'flow' => $flow,
       );
    }
    
    /**
     * Creates a new Persona entity.
     *
     * @Route("/create", name="persona_create")
     * @Method("post")
     * @Template("SistemaAdminBundle:Persona:new.html.twig")
     */
    public function createAction()
    {
       $user = new Persona(); // Should be your user entity. Has to be an object, won't work properly with an array.

       $flow = $this->get('sistemaAdmin.form.flow.nuevoPersona'); // must match the flow's service id
       $flow->bind($user);

       // form of the current step
       $form = $flow->createForm($user);
       if ($flow->isValid($form)) {
           $flow->saveCurrentStepData();

           if ($flow->nextStep()) {
               // form for the next step
               $form = $flow->createForm($user);
           } else {
               if($user->getTipo() == 'cajero'){//si el tipo es cajero.
                    $user->getUsuario()->setRoles(array('ROLE_CAJERO'));//el rol es cajero.
                    $encoder = $this->get('security.encoder_factory')->getEncoder($user->getUsuario());
                    $passwordCodificado = $encoder->encodePassword(
                        $user->getUsuario()->getPassword(),
                        $user->getUsuario()->getSalt()
                    );
                    $user->getUsuario()->setPassword($passwordCodificado);
               }
               // flow finished
               $em = $this->getDoctrine()->getEntityManager();
               $em->persist($user);
               $em->flush();
               $this->get('session')->getFlashBag()->add('success', 'flash.create.success');

               return $this->redirect($this->generateUrl('persona_show', array('id' => $user->getId())));
           }
       }
//       else {
//           $this->get('session')->getFlashBag()->add('error', 'flash.create.error');
//       }

       return array(
           'form' => $form->createView(),
           'flow' => $flow,
       );
    }
   
//    /**
//     * Creates a new Persona entity.
//     *
//     * @Route("/create", name="persona_create")
//     * @Method("post")
//     * @Template("SistemaAdminBundle:Persona:new.html.twig")
//     */
//    public function createAction()
//    {
//        $entity  = new Persona();
//        $request = $this->getRequest();
//        $form    = $this->createForm(new PersonaType(), $entity);
//        $form->bind($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($entity);
//            $em->flush();
//            $this->get('session')->getFlashBag()->add('success', 'flash.create.success');
//
//            return $this->redirect($this->generateUrl('persona_show', array('id' => $entity->getId())));        } else {
//            $this->get('session')->getFlashBag()->add('error', 'flash.create.error');
//        }
//
//        return array(
//            'entity' => $entity,
//            'form'   => $form->createView(),
//        );
//    }
    /**
     * Displays a form to edit an existing Persona entity.
     *
     * @Route("/{id}/edit", name="persona_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('SistemaAdminBundle:Persona')->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Unable to find Persona entity.');
        }
        
        $flow = $this->get('sistemaAdmin.form.flow.nuevoPersona'); // must match the flow's service id
        $flow->bind($user);
        
        $form = $flow->createForm($user);
        $deleteForm = $this->createDeleteForm($id);
       
        return array(
            'user' => $user,
            'form' => $form->createView(),
            'flow' => $flow,
            'delete_form' => $deleteForm->createView(),
        );
    }
    
    /**
     * Edits an existing Persona entity.
     *
     * @Route("/{id}/update", name="persona_update")
     * @Method("post")
     * @Template("SistemaAdminBundle:Persona:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('SistemaAdminBundle:Persona')->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Unable to find Persona entity.');
        }

        $flow = $this->get('sistemaAdmin.form.flow.nuevoPersona'); // must match the flow's service id
        $flow->bind($user);
        
        $form = $flow->createForm($user);
        $deleteForm = $this->createDeleteForm($id);
        
       // form of the current step
       $form = $flow->createForm($user);
       if ($flow->isValid($form)) {
           $flow->saveCurrentStepData();

           if ($flow->nextStep()) {
               // form for the next step
               $form = $flow->createForm($user);
           } else {
               $em = $this->getDoctrine()->getEntityManager();
               
               if($user->getTipo() == 'cajero'){//si el tipo es cajero.
                    $user->getUsuario()->setRoles(array('ROLE_CAJERO'));//el rol es cajero.
                    $encoder = $this->get('security.encoder_factory')->getEncoder($user->getUsuario());
                    $passwordCodificado = $encoder->encodePassword(
                        $user->getUsuario()->getPassword(),
                        $user->getUsuario()->getSalt()
                    );
                    $user->getUsuario()->setPassword($passwordCodificado);
               }  else {
                   if ($usuario = $user->getUsuario()) {
                       $user->setUsuario(null);
                       $em->remove($usuario);
                   }
               }
               // flow finished
               $em->persist($user);
               $em->flush();
               $this->get('session')->getFlashBag()->add('success', 'flash.update.success');

               return $this->redirect($this->generateUrl('persona_edit', array('id' => $id)));
           }
       }

        return array(
            'user' => $user,
            'form' => $form->createView(),
            'flow' => $flow,
            'delete_form' => $deleteForm->createView(),
        );
    }
//    /**
//     * Displays a form to edit an existing Persona entity.
//     *
//     * @Route("/{id}/edit", name="persona_edit")
//     * @Template()
//     */
//    public function editAction($id)
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('SistemaAdminBundle:Persona')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Persona entity.');
//        }
//
//        $editForm = $this->createForm(new PersonaType(), $entity);
//        $deleteForm = $this->createDeleteForm($id);
//
//        return array(
//            'entity'      => $entity,
//            'edit_form'   => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        );
//    }

//    /**
//     * Edits an existing Persona entity.
//     *
//     * @Route("/{id}/update", name="persona_update")
//     * @Method("post")
//     * @Template("SistemaAdminBundle:Persona:edit.html.twig")
//     */
//    public function updateAction($id)
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('SistemaAdminBundle:Persona')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Persona entity.');
//        }
//
//        $editForm   = $this->createForm(new PersonaType(), $entity);
//        $deleteForm = $this->createDeleteForm($id);
//
//        $request = $this->getRequest();
//
//        $editForm->bind($request);
//
//        if ($editForm->isValid()) {
//            $em->persist($entity);
//            $em->flush();
//            $this->get('session')->getFlashBag()->add('success', 'flash.update.success');
//
//            return $this->redirect($this->generateUrl('persona_edit', array('id' => $id)));
//        } else {
//            $this->get('session')->getFlashBag()->add('error', 'flash.update.error');
//        }
//
//        return array(
//            'entity'      => $entity,
//            'edit_form'   => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        );
//    }
    /**
     * Deletes a Persona entity.
     *
     * @Route("/{id}/delete", name="persona_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SistemaAdminBundle:Persona')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Persona entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.delete.error');
        }

        return $this->redirect($this->generateUrl('persona'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
//    /**
//     * @Route("/nuevo", name="persona_nuevo")
//     * @Template()
//     */
//   public function nuevoAction() {
//       $user = new Persona(); // Should be your user entity. Has to be an object, won't work properly with an array.
//
//       $flow = $this->get('sistemaAdmin.form.flow.nuevoPersona'); // must match the flow's service id
//       $flow->bind($user);
//
//       // form of the current step
//       $form = $flow->createForm($user);
//       if ($flow->isValid($form)) {
//           $flow->saveCurrentStepData();
//
//           if ($flow->nextStep()) {
//               // form for the next step
//               $form = $flow->createForm($user);
//           } else {
//               // flow finished
//               $em = $this->getDoctrine()->getEntityManager();
//               $em->persist($user);
//               $em->flush();
//
//               return $this->redirect($this->generateUrl('persona')); // redirect when done
//           }
//       }
//
//       return array(
//           'form' => $form->createView(),
//           'flow' => $flow,
//       );
//   }

}