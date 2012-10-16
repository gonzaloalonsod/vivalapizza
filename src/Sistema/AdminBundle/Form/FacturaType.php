<?php

namespace Sistema\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FacturaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('idCaja', null, array(
                    'label' => 'Caja nro'
                ))
//                ->add('fecha', 'date', array(
//                    'widget' => 'single_text',
//                    'format' => 'dd-MM-yyyy hh:mm:ss',
//                    'attr' => array('class' => 'date')
//                ))
                ->add('idLineaFactura', 'collection', array(
                    'type' => new LineaFacturaType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false
                ))
                ->add('total')
                ->add('formaPago', 'choice', array(
                    'choices' => array(
                        'contado' => 'Contado',
                        'tarjeta' => 'Tarjeta'
                    ),
                    'label' => 'Forma de pago'
                ))
                ->add('nroComprobante', null, array(
                    'label' => 'Nro de comprobante'
                ))
                ->add('banco')
                ->add('idMozo', null, array(
                    'label' => 'Mozo'
                ))
                ->add('idCliente', null, array(
                    'label' => 'Cliente'
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Sistema\AdminBundle\Entity\Factura'
        ));
    }

    public function getName() {
        return 'sistema_adminbundle_facturatype';
    }
}