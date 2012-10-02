<?php

namespace Sistema\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
//            ->add('imagen')
            ->add('file', null, array(
                'label' => 'Imagen'
            ))
//            ->add('cantidad_vendido')
//            ->add('created')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sistema\AdminBundle\Entity\Producto'
        ));
    }

    public function getName()
    {
        return 'sistema_adminbundle_productotype';
    }
}
