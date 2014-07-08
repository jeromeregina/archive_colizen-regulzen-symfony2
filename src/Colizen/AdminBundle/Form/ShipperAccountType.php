<?php

namespace Colizen\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Colizen\AdminBundle\Entity\ShipperAccount as Entity;

class ShipperAccountType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('code')
            ->add('status')
            ->add('sensitivity')
            ->add('flowType','choice',array('choices'=> Entity::$flowTypeLabels))
            ->add('serviceLevel','choice',array('choices'=> Entity::$serviceLevelLabels))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Colizen\AdminBundle\Entity\ShipperAccount'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'colizen_adminbundle_shipper_account';
    }
}
