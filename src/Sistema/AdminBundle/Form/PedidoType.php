<?php

namespace Sistema\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class PedidoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
//            ->add('fecha')
                ->add('total')
                ->add('idCaja', 'entity', array(
                    'label' => 'Caja nro',
                    'class' => 'SistemaAdminBundle:Caja',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('c')
                                ->where('c.cierreCaja IS NULL');
                    },
                    'read_only' => true
                ))
                ->add('idCliente', null, array(
                    'label' => 'Cliente'
                ))
//            ->add('idFactura')
//            ->add('lineasPedido', 'collection', array(
//                'type' => 'collection'
//            ))
                ->add('lineasPedido', 'collection', array(
                    'type' => new LineaFacturaType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false
                ))
                ->add('direccion', null, array(
                    'label' => 'Dirección'
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Sistema\AdminBundle\Entity\Pedido'
        ));
    }

    public function getName() {
        return 'sistema_adminbundle_pedidotype';
    }

}
