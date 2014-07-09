<?php

namespace Regulzen\RegulationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class DateCycleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date',  'date')
        ->add('cycle', 'entity', array(
                'class' => 'RegulzenCoreBundle:Cycle',
                'property' => 'name',
                    'query_builder' => function (EntityRepository $er) {
                            return $er->getCyclesQueryBuilder();
                        },
            ))
        ->add('valider', 'submit')
        ;

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'Regulzen\RegulationBundle\Form\Model\DateCycleFormModel'
            ));
    }

    public function getName()
    {
        return 'date_cycle';
    }

}
