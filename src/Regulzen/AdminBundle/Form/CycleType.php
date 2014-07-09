<?php

namespace Regulzen\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CycleType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('start','timepicker')
            ->add('end','timepicker')
            ->add('tourCodeFormat')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Regulzen\CoreBundle\Entity\Cycle'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'regulzen_adminbundle_cycle';
    }
}
