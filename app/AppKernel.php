<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Braincrafted\Bundle\BootstrapBundle\BraincraftedBootstrapBundle(),
            new Widop\HttpAdapterBundle\WidopHttpAdapterBundle(),
            new Ivory\GoogleMapBundle\IvoryGoogleMapBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Liuggio\ExcelBundle\LiuggioExcelBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),

            // Regulzen Bundles
            //new BeSimple\DeploymentBundle\BeSimpleDeploymentBundle(),
            new Regulzen\CoreBundle\RegulzenCoreBundle(),
            new Regulzen\UserBundle\RegulzenUserBundle(),
            new Regulzen\AdminBundle\RegulzenAdminBundle(),
            new Regulzen\RegulationBundle\RegulzenRegulationBundle(),
            new Regulzen\CustomerServiceBundle\RegulzenCustomerServiceBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
