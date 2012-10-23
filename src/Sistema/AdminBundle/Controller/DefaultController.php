<?php

namespace Sistema\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="admin_index")
     * @Template()
     */
    public function indexAction()
    {
        $roles = $this->getUser()->getRoles();
        if($roles[0] == 'ROLE_CAJERO'){
            return $this->redirect($this->generateUrl('caja'));
        }
        return array();
    }
}
