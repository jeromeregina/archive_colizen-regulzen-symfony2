<?php
namespace Novactive\InterfaceBundle\Twig;

use Doctrine\ORM\EntityManager;
class InterfaceExtension extends \Twig_Extension{
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
        $globals=array();
        
        $repo=$this->em->getRepository('NovactiveAdminBundle:ImportLog');
        
        $globals += $repo->findLatestImportLogDates();
        
        return $globals;
    }
    public function getName() {
        return 'regulzen_interface';
    }

}
