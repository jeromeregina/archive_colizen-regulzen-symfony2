<?php
namespace Colizen\AdminBundle\Query;

use DoctrineExtensions\Query\Mysql\Regexp as Base;
use Doctrine\ORM\Query\SqlWalker;
class Regexp extends Base
{
    public function getSql(SqlWalker $sqlWalker)
    {
        if ($sqlWalker->getConnection()->getDriver()->getName()=='pdo_mysql')
        return '(' . $this->value->dispatch($sqlWalker) . ' REGEXP ' . $this->regexp->dispatch($sqlWalker) . ')';
        if ($sqlWalker->getConnection()->getDriver()->getName()=='pdo_pgsql')
        return '(' . $this->value->dispatch($sqlWalker) . ' ~ ' . $this->regexp->dispatch($sqlWalker) . ')';
    }
}
