<?php

namespace Sistema\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ComprobanteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreMozo')
            ->add('fecha')
            ->add('total')
            ->add('idCierreCaja')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sistema\AdminBundle\Entity\Comprobante'
        ));
    }

    public function getName()
    {
        return 'sistema_adminbundle_comprobantetype';
    }
}
