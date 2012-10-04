<?php

namespace Sistema\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class MesaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero')
            ->add('ubicacion')
//            ->add('idMozo')
            ->add('idMozo', 'entity', array(
                    'label' => 'Mozo',
                    'class' => 'SistemaAdminBundle:Persona',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('m')
                                ->where('m.tipo = :mozo')
                                ->setParameter('mozo', 'mozo');
                    }
                 ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sistema\AdminBundle\Entity\Mesa'
        ));
    }

    public function getName()
    {
        return 'sistema_adminbundle_mesatype';
    }
}
