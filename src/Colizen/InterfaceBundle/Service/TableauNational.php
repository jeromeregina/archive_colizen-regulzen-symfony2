<?php

namespace Colizen\InterfaceBundle\Service;


use Colizen\AdminBundle\Entity\Cycle;
use Doctrine\ORM\EntityManagerInterface;

class TableauNational implements TableauNationalInterface
{

    const NOT_AVAILABLE_LABEL = 'N/A';
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

    }

    /**
     * @param \DateTime $date
     * @param Cycle     $cycle
     */
    public function getTableauNational(\DateTime $date, Cycle $cycle)
    {
        $sitesData = array();

        // Les sites
        $sites = $this->getSiteRepository()->findAll();

        // init results
        foreach ($sites as $site)
        {
            $sitesData[$site->getId()]['site']               = $site;
            $sitesData[$site->getId()]['nombreExpeditions']  = self::NOT_AVAILABLE_LABEL;
            $sitesData[$site->getId()]['countColisCoecEdir'] = self::NOT_AVAILABLE_LABEL;
            $sitesData[$site->getId()]['dispatchRate']       = self::NOT_AVAILABLE_LABEL;
        }

        // nombre d'expeditions
        $nombreExpeditions = $this->getSiteRepository()->getNombreExpeditionsBySite($date, $cycle);

        foreach ($nombreExpeditions as $nombreExpeditionsLine)
        {
            $sitesData[$nombreExpeditionsLine['site']->getId()]['nombreExpeditions'] = $nombreExpeditionsLine['nombreExpeditions'];
        }

        // nombre de colis COEC/EDIR
        $colisCoecEdir = $this->getSiteRepository()->countColisCoecEdirBySite($date, $cycle);
        foreach ($colisCoecEdir as $colisCoecEdirLine)
        {
            $sitesData[$colisCoecEdirLine['site']->getId()]['countColisCoecEdir'] = $colisCoecEdirLine['countColisCoecEdir'];
        }

        // Pourcentage de dispatch
        $allColis = $this->getSiteRepository()->countColisBySite($date, $cycle);
        foreach ($allColis as $countColis)
        {
            $siteId = $countColis['site']->getId();

            if ($sitesData[$siteId]['countColisCoecEdir'] !== self::NOT_AVAILABLE_LABEL)
            {
                $sitesData[$siteId]['dispatchRate'] = $sitesData[$siteId]['countColisCoecEdir'] / $countColis['countColis'];
            }
        }

        return $sitesData;
    }

    private function getSiteRepository()
    {
        return $this->entityManager->getRepository('ColizenAdminBundle:Site');
    }

}
