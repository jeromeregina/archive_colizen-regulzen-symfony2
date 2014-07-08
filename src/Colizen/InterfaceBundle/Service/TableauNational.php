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
        foreach ($sites as $site) {
            $sitesData[$site->getId()]['site']               = $site;
            $sitesData[$site->getId()]['nombreExpeditions']  = self::NOT_AVAILABLE_LABEL;
            $sitesData[$site->getId()]['countColisCoecEdir'] = self::NOT_AVAILABLE_LABEL;
            $sitesData[$site->getId()]['dispatchRate']       = self::NOT_AVAILABLE_LABEL;
            $sitesData[$site->getId()]['controleRate']       = self::NOT_AVAILABLE_LABEL;
            $sitesData[$site->getId()]['departRate']         = self::NOT_AVAILABLE_LABEL;
            $sitesData[$site->getId()]['avancementRate']     = self::NOT_AVAILABLE_LABEL;
            $sitesData[$site->getId()]['echecRate']          = self::NOT_AVAILABLE_LABEL;
            $sitesData[$site->getId()]['horsCreneauRate']    = self::NOT_AVAILABLE_LABEL;
        }

        // nombre d'expeditions
        $nombreExpeditions = $this->getSiteRepository()->getNombreExpeditionsBySite($date, $cycle);

        foreach ($nombreExpeditions as $nombreExpeditionsLine) {
            $sitesData[$nombreExpeditionsLine['site']->getId()]['nombreExpeditions'] = $nombreExpeditionsLine['nombreExpeditions'];
        }

        // nombre de colis COEC/EDIR
        $colisCoecEdir = $this->getSiteRepository()->countColisCoecEdirBySite($date, $cycle);
        foreach ($colisCoecEdir as $colisCoecEdirLine) {
            $sitesData[$colisCoecEdirLine['site']->getId()]['countColisCoecEdir'] = $colisCoecEdirLine['countColisCoecEdir'];
        }

        // Pourcentage de dispatch
        $allColis = $this->getSiteRepository()->countColisBySite($date, $cycle);
        foreach ($allColis as $countColis) {
            $siteId = $countColis['site']->getId();

            if ($sitesData[$siteId]['countColisCoecEdir'] !== self::NOT_AVAILABLE_LABEL) {
                $value = $sitesData[$siteId]['countColisCoecEdir'] / $countColis['countColis'];
                $sitesData[$siteId]['dispatchRate'] = round($value, 2) . '%';
            }
        }

        // Pourcentage de controle
        $colisCtrl = $this->getSiteRepository()->countColisCtrlBySite($date, $cycle);
        foreach ($colisCoecEdir as $colisCoecEdirLine) {
            $siteId = $colisCoecEdirLine['site']->getId();

            foreach ($colisCtrl as $colisCtrlLine) {
                if ($colisCtrlLine['site']->getId() == $siteId) {
                    $value = $colisCtrlLine['countColisCtrl'] / $colisCoecEdirLine['countColisCoecEdir'];
                    $sitesData[$siteId]['controleRate'] = round($value, 2) . '%';
                }
            }
        }



        // Pourcentage de départ
        $colisTour = $this->getSiteRepository()->countColisTourBySite($date, $cycle);
        foreach ($colisCoecEdir as $colisCoecEdirLine) {
            $siteId = $colisCoecEdirLine['site']->getId();

            foreach ($colisTour as $colisTourLine) {
                if ($colisTourLine['site']->getId() == $siteId) {
                    $value = $colisTourLine['countColisTour'] / $colisCoecEdirLine['countColisCoecEdir'];
                    $sitesData[$siteId]['departRate'] = round($value, 2) . '%';
                }
            }
        }

        // Pourcentage d'avancement
        $colisRemiNliv = $this->getSiteRepository()->countColisRemiNlivBySite($date, $cycle);
        foreach ($allColis as $countColis) {
            $siteId = $countColis['site']->getId();

            foreach ($colisRemiNliv as $colisRemiNlivLine) {
                if ($siteId == $colisRemiNlivLine['site']->getId()) {
                    $value = $colisRemiNlivLine['countColisRemiNliv'] / $countColis['countColis'];
                    $sitesData[$siteId]['avancementRate'] = round($value, 2) . '%';
                }
            }
        }

        // Pourcentage d'échec
        $colisNlivCnml = $this->getSiteRepository()->countColisNlivCnmlBySite($date, $cycle);
        foreach ($allColis as $countColis) {
            $siteId = $countColis['site']->getId();

            foreach ($colisNlivCnml as $colisNlivCnmlLine) {
                if ($siteId == $colisNlivCnmlLine['site']->getId()) {
                    $value = $colisNlivCnmlLine['countColisNlivCnml'] / $countColis['countColis'];
                    $sitesData[$siteId]['echecRate'] = round($value, 2) . '%';
                }
            }
        }

        // Pourcentage de colis remis Hors Créneau
        $colisHorsCreneau = $this->getSiteRepository()->countColisHorsCreneauBySite($date, $cycle);
        foreach ($allColis as $countColis) {
            $siteId = $countColis['site']->getId();

            foreach ($colisHorsCreneau as $colisHorsCreneauLine) {
                if ($siteId == $colisHorsCreneauLine['site']->getId()) {
                    $value = $colisHorsCreneauLine['countColisHorsCreneau'] / $countColis['countColis'];
                    $sitesData[$siteId]['horsCreneauRate'] = round($value, 2) . '%';
                }
            }
        }

        return $sitesData;
    }

    private function getSiteRepository()
    {
        return $this->entityManager->getRepository('ColizenAdminBundle:Site');
    }

}
