<?php

namespace Sistema\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dni')
            ->add('nombre')
            ->add('apellido')
            ->add('tipo', 'choice', array(
                'choices' => array('cliente' => 'Cliente',
                                   'cajero'  => 'Cajero',
                                   'mozo' => 'Mozo'
                                  )
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sistema\AdminBundle\Entity\Persona'
        ));
    }

    public function getName()
    {
        return 'sistema_adminbundle_personatype';
    }
}
