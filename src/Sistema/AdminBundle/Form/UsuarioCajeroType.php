<?php

namespace Sistema\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioCajeroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'Los campos de contraseña deben coincidir.',
                'options' => array('label' => 'Contraseña')
            ))
//            ->add('roles')
            ->add('enabled', null, array(
                'label' => ' ',
                'data' => true,
                'read_only' => true,
                'attr' => array('style' => 'display:none;')
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sistema\UsuarioBundle\Entity\Usuario'
        ));
    }

    public function getName()
    {
        return 'sistema_adminbundle_usuariocajerotype';
    }
}
