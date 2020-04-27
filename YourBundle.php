<?php

namespace YOUR\BUNDLE;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use YOUR\BUNDLE\DependencyInjection\YourBundleExtension;

class YourBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new YourBundleExtension();
    }
}
