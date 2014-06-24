<?php
/**
 * Created by PhpStorm.
 * User: fnaccache
 * Date: 23/06/14
 * Time: 14:39
 */

namespace Novactive\InterfaceBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DateCycleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date',  'date')
        ->add('cycle', 'entity', array(
                'class' => 'NovactiveAdminBundle:Cycle',
                'property' => 'name',
            ))
        ->add('valider', 'submit')
        ;

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'Novactive\InterfaceBundle\Form\Model\DateCycleFormModel'
            ));
    }

    public function getName()
    {
        return 'date_cycle';
    }

} 