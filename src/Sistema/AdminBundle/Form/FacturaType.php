<?php

namespace Sistema\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FacturaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('fecha', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy hh:mm:ss',
                    'attr' => array('class' => 'date')
                ))
                ->add('idLineaFactura', 'collection', array(
                    'type' => new LineaFacturaType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false
                ))
                ->add('total')
                ->add('formaPago')
                ->add('nroComprobante')
                ->add('banco')
                ->add('idCaja')
                ->add('idMozo')
                ->add('idCliente')
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