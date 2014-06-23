<?php

namespace Novactive\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware{
      public function adminMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('admin');

        $menu->addChild('Retour à l\'interface', array('route' => 'regulzen_interface_index'));
        $menu->addChild('Logs imports');
        $menu['Logs imports']->addChild('Logs imports de fichiers', array('route' => 'regulzen_interface_index'));
        $menu['Logs imports']->addChild('Logs imports webservices', array('route' => 'regulzen_interface_index'));
        $menu->addChild('Créneaux', array('route' => 'regulzen_interface_index'));
        $menu->addChild('Comptes chargeurs', array('route' => 'admin_sender_list'));
        $menu->addChild('Sites', array('route' => 'admin_site_list'));

        return $menu;
    }
}
