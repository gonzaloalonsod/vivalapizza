<?php

namespace Sistema\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Doctrine\ORM\QueryBuilder;

use Lexik\Bundle\FormFilterBundle\Filter\QueryBuilderExecuterInterface;
use Lexik\Bundle\FormFilterBundle\Filter\Expr;
use Lexik\Bundle\FormFilterBundle\Filter\Extension\Type\FilterTypeSharedableInterface;

/**
 * Embbed filter type.
 */
class TipoIdProductoFilterType extends AbstractType implements FilterTypeSharedableInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre', 'filter_text');
    }

    public function getName()
    {
        return 'sistema_adminbundle_tipoidproductofiltertype';
    }

    /**
     * This method aim to add all joins you need
     */
    public function addShared(QueryBuilderExecuterInterface $qbe)
    {
        $closure = function(QueryBuilder $queryBuilder, $alias, $joinAlias, Expr $expr) {
            // add the join clause to the doctrine query builder
            // the where clause for the label and color fields will be added automatically with the right alias later by the Lexik\Filter\QueryBuilderUpdater
            $queryBuilder->leftJoin($alias.'.idProducto', 'opt');
//            echo '///'.$alias.' - ';
//            echo $joinAlias.' - ';
        };
//        echo $qbe->getAlias().' - ';
        // then use the query builder executor to define the join, the join's alias and things to do on the doctrine query builder.
        $qbe->addOnce($qbe->getAlias().'.idProducto', 'opt', $closure);
//        echo '<br>';
//        echo var_dump($closure);
//        echo '<br>';
    }

}