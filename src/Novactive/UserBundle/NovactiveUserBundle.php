<?php

namespace Novactive\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class NovactiveUserBundle extends Bundle
{
        public function getParent()
    {
        return 'FOSUserBundle';
    }
}
