<?php

namespace Sistema\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sistema\UsuarioBundle\Form\UsuarioType;

class PersonaFormType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        switch ($options['flowStep']) {
            case 1:
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
                break;
            case 2:
                $builder
                    ->add('usuario', new UsuarioType(), array(
                        'label' => 'Cajero',
                        'required' => false
                    ))
                ;
                break;
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'flowStep' => 1,
            'data_class' => 'Sistema\AdminBundle\Entity\Persona', // should point to your user entity
        ));
    }
//    public function setDefaultOptions(OptionsResolverInterface $resolver) {
//        $resolver->setDefaults(array(
//            'flowStep' => 1,
//            'data_class' => 'Sistema\AdminBundle\Entity\Persona', // should point to your user entity
//            'tipo' => 'cajero',
//        ));
//    }

    public function getName() {
        return 'registerUser';
    }

}