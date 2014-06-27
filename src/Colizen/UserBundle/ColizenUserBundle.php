<?php

namespace Colizen\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ColizenUserBundle extends Bundle
{
        public function getParent()
    {
        return 'FOSUserBundle';
    }
}
