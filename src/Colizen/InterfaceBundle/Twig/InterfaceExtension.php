<?php

namespace Colizen\InterfaceBundle\Twig;

use Colizen\InterfaceBundle\Service\TableauNational;
use Doctrine\ORM\EntityManager;

class InterfaceExtension extends \Twig_Extension
{
    /**
     *
     * @var EntityManager 
     */
    protected $em;
    
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    /**
     * Returns a list of global variables to add to the existing list.
     *
     * @return array An array of global variables
     */
    public function getGlobals()
    {
        $globals = array();
        
        $repo = $this->em->getRepository('ColizenAdminBundle:ImportLog');
        
        $globals += $repo->findLatestImportLogDates();
        
        return $globals;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('make_na_small', array($this, 'makeNaSmall')),
        );
    }

    public function makeNaSmall($value)
    {
        if  ($value === TableauNational::NOT_AVAILABLE_LABEL)
        {
            $value = '<small class="red">'.$value.'</small>';
        }

        return $value;
    }


    public function getName() {
        return 'regulzen_interface';
    }
}
