<?php

namespace Sistema\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;

use Lexik\Bundle\FormFilterBundle\Filter\Expr;
use Doctrine\ORM\QueryBuilder;

class TipoProductoFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('id', 'filter_number_range')
//            ->add('descripcion', 'filter_text')
//            ->add('precio', 'filter_number_range')
//            ->add('cantidad_vendido', 'filter_text')
            ->add('idProducto', new TipoIdProductoFilterType(), array(
                'label' => 'Producto'
            ))
//            ->add('descripcion', 'filter_text', array(
//                'apply_filter' => function (QueryBuilder $queryBuilder, Expr $expr, $field, array $values) {
//                    // add conditions you need :)
//                    echo $field.' - ';
//                    echo var_dump($expr).' - ';
//                    echo var_dump($values).' - ';
//                    echo $values['value'];//die;
//                    if ($values['value']) {
//                        $value = '%'.$values['value'].'%';
//                    }  else {
//                        $value = $values['value'];
//                    }
//                    $queryBuilder
//                        ->where($field.' LIKE :value')
//                        ->setParameter('value', $value);
//            }))
        ;

        $listener = function(FormEvent $event)
        {
            // Is data empty?
            foreach ($event->getData() as $data) {
                if(is_array($data)) {
                    foreach ($data as $subData) {
                        if(!empty($subData)) return;
                    }
                }
                else {
                    if(!empty($data)) return;
                }
            }

            $event->getForm()->addError(new FormError('Filter empty'));
        };
        $builder->addEventListener(FormEvents::POST_BIND, $listener);
    }

    public function getName()
    {
        return 'sistema_adminbundle_tipoproductofiltertype';
    }
}
