<?php

namespace Colizen\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function adminMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('admin');

        //$menu->addChild('Retour à l\'interface', array('route' => 'regulzen_interface_index', 'attributes' => array('class' => 'purple')));
        $menu->addChild('Logs imports', array('attributes' => array('class' => 'purple')));
        $menu['Logs imports']->addChild('Logs imports de fichiers', array('route' => 'admin_logs_imports_list'));
        $menu['Logs imports']->addChild('Logs imports webservices', array('route' => 'regulzen_interface_index'));
        $menu->addChild('Codes Tournées', array('route' => 'admin_tour_code_list', 'attributes' => array('class' => 'purple')));
        $menu->addChild('Status', array('route' => 'admin_status_list', 'attributes' => array('class' => 'purple')));
        $menu->addChild('Comptes chargeurs', array('route' => 'admin_shipper_account_list', 'attributes' => array('class' => 'purple')));
        $menu->addChild('Sites', array('route' => 'admin_site_list', 'attributes' => array('class' => 'purple')));
        $menu->addChild('Cycles', array('route' => 'admin_cycle_list', 'attributes' => array('class' => 'purple')));

        return $menu;
    }
}
