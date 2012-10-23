<?php

namespace Sistema\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LineaFacturaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('idTipoProducto', null, array(
                    'label' => ' ',
                    'empty_value' => 'Seleccionar producto'
                ))
                ->add('Precio', null, array(
                    'label' => ' ',
                    'disabled' => true,
                    'attr' => array('style' => 'width:130px'),
                    'property_path' => 'false',
//                    'data' => 0
                ))
                ->add('cantidad', null, array(
                    'label' => ' ',
                    'attr' => array('style' => 'width:130px'),
//                    'data' => 0
                ))
                ->add('total', null, array(
                    'label' => ' ',
                    'read_only' => true,
                    'attr' => array('style' => 'width:130px'),
//                    'data' => 0
                ))
//                ->add('idFactura')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Sistema\AdminBundle\Entity\LineaFactura'
        ));
    }

    public function getName() {
        return 'sistema_adminbundle_lineafacturatype';
    }
}