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
        $file=__DIR__.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'Status.xlsx';
        $phpexcel=$this->container->get('phpexcel');
        /* @var $peo \PHPExcel */
        $peo=$phpexcel->createPHPExcelObject($file);
        $peo->setActiveSheetIndexByName('Statuts_CLZ');
        $sheetData=$peo->getActiveSheet()->toArray(null,true,true,true);
        // suppression de la ligne d'entête (meilleure solution?)
        array_shift($sheetData);
        foreach ($sheetData as $line){
            if ($line['B']!=""){
                $status=new Status();
                $status->setCode($line['A']);
                $status->setShortname($line['B']);
                $status->setDescription($line['C']);
                $status->setIsExcluded($line['E']=='non'?true:false);
                $manager->persist($status);
            }
        }
        $manager->flush();
    }
}