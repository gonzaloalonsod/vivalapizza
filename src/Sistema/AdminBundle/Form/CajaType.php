<?php

namespace Sistema\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class CajaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('inicioCaja')
//            ->add('cierreCaja')
            ->add('montoInicial', null, array(
                    'label' => 'Monto inicial'
                ))
            ->add('idCajero', 'entity', array(
                    'label' => 'Cajero',
                    'class' => 'SistemaAdminBundle:Persona',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('c')
                                ->where('c.tipo = :cajero')
                                ->setParameter('cajero', 'cajero');
                    }
                 ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sistema\AdminBundle\Entity\Caja'
        ));
    }

    public function getName()
    {
        return 'sistema_adminbundle_cajatype';
    }
}
