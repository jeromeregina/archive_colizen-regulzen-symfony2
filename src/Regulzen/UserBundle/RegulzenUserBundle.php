<?php

namespace Regulzen\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class RegulzenUserBundle extends Bundle
{
        public function getParent()
    {
        return 'FOSUserBundle';
    }
}
