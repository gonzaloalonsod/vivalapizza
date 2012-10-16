<?php

namespace Sistema\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LineaFacturaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('cantidad', null, array(
                    'label' => ' '
                ))
                ->add('total', null, array(
                    'label' => ' '
                ))
//                ->add('idFactura')
                ->add('idTipoProducto', null, array(
                    'label' => ' '
                ))
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