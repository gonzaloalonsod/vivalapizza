<?php

namespace Sistema\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TipoProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idProducto', null, array(
                'label' => 'Producto'
            ))
            ->add('descripcion')
            ->add('precio', null, array(
                'label' => 'Precio $'
            ))
//            ->add('cantidad_vendido')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sistema\AdminBundle\Entity\TipoProducto'
        ));
    }

    public function getName()
    {
        return 'sistema_adminbundle_tipoproductotype';
    }
}
