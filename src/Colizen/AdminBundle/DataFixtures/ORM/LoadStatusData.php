<?php

namespace Colizen\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Colizen\AdminBundle\Entity\Status;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use \PHPExcel;

class LoadStatusData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $statusFilePath = dirname($this->container->getParameter('kernel.root_dir')).'/data/fixtures/Status-2014_07_01.xlsx';
        $phpexcel = $this->container->get('phpexcel');
        /* @var $peo \PHPExcel */
        $peo = $phpexcel->createPHPExcelObject($statusFilePath);
        $peo->setActiveSheetIndexByName('Statuts CargoNET');
        $sheetData = $peo->getActiveSheet()->toArray(null, true, true, true);
        foreach ($sheetData as $i=>$line) {
            if (strlen($line['B'])== 4) {
                $status = new Status();
                $status->setCode($line['A']);
                $status->setShortname($line['B']);
                $status->setDescription($line['D']);
                $status->setIsExcluded($line['H'] == '1' ? false : true);
                $manager->persist($status);
            }
        }
        $manager->flush();
    }
}
