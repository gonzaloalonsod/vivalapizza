<?php

namespace Sistema\UsuarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
//            ->add('usernameCanonical')
            ->add('email')
//            ->add('emailCanonical')
//            ->add('enabled')
//            ->add('salt')
            ->add('password')
//            ->add('lastLogin')
//            ->add('locked')
//            ->add('expired')
//            ->add('expiresAt')
//            ->add('confirmationToken')
//            ->add('passwordRequestedAt')
            ->add('roles')
//            ->add('credentialsExpired')
//            ->add('credentialsExpireAt')
//            ->add('groups')
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
        return 'sistema_usuariobundle_usuariotype';
    }
}
