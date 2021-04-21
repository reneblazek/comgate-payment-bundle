<?php

namespace Mufin\ComgateBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Mufin\ComgateBundle\DependencyInjection\MufinComgateExtension;

class MufinComgateBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new MufinComgateExtension();
    }
}
