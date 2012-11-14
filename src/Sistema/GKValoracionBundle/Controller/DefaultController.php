<?php

namespace Sistema\GKValoracionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sistema\GKValoracionBundle\Entity\Valoracion;
//use Sistema\AdminBundle\Entity\TipoProducto;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }

    /**
     * @Route("/rating_star", name="valoracion_rating_star")
     * @Template()
     */
    function rating_starAction() {
        $id_product = $this->getRequest()->get('id_product');
        $value = $this->getRequest()->get('value');
//        echo $id_product;echo $value;
//        die;
        //set some variables
        $ip = $_SERVER['REMOTE_ADDR'];
//        if (!$units) {$units = 10;}
//        if (!$static) {$static = FALSE;}
        
        // get votes, values, ips for the current rating bar
        $em = $this->getDoctrine()->getManager();
        $valoracion = $em->getRepository('SistemaGKValoracionBundle:Valoracion')->findValoracion($id_product);
        if (!$valoracion) {
            $valoracion = new Valoracion();
            $valoracion->setTotalVotos(1);
            $valoracion->setTotalValue($value);
//            $tipoProducto = new TipoProducto();
            $tipoProducto = $em->getRepository('SistemaAdminBundle:TipoProducto')->find($id_product);
            $tipoProducto->setIdValoracion($valoracion);
            $em->persist($tipoProducto);
//            throw $this->createNotFoundException('Unable to find valoracion.');
            $em->flush();
            
            $valor_score = $value;
        }  else {
            $totalVotos = $valoracion->getTotalVotos() + 1;
            $totalValue = $valoracion->getTotalValue() + $value;
            
            $valoracion->setTotalVotos($totalVotos);
            $valoracion->setTotalValue($totalValue);
            $em->persist($valoracion);
            $em->flush();
            
            $valor_score = $totalValue / $totalVotos;
        }
        return array('valor_score' => $valor_score);
//        return array('jsstar' => $this->creaJSstar($id_product,$valor_score));
    }
    
    function creaJSstar($id_product,$valor_score) {
        $js = "
            <script>
                $('#star_".$id_product."').raty({
                    half  : true,
                    score : ".$valor_score.",
                    click: function(score, evt) {
                      $.ajax({
                          type: 'POST',
                          url: '{{ path('valoracion_rating_star') }}',
                          data: { id_product: '".$id_product."', value: score },
                          success: function(data) {
                            //divpromo.html(data);
                          }
                      });
                    }
                  });
            </script>
        ";
        return $js;
    }
}