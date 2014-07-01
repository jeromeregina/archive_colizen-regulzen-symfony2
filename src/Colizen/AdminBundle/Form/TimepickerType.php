<?php

namespace Colizen\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TimepickerType  extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
        {
            $resolver->setDefaults(array(
                'widget'=>'single_text'
            ));
        }

        public function getParent()
        {
            return 'time';
        }

        public function getName()
        {
            return 'timepicker';
        }
}
