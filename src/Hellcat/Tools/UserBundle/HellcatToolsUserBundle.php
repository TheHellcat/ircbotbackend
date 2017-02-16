<?php

namespace Hellcat\Tools\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Hellcat\Tools\UserBundle\DependencyInjection\HellcatUserToolsExtension;
use Hellcat\Tools\UserBundle\Security\Factory\Factory;

class HellcatToolsUserBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new HellcatUserToolsExtension();
    }

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new Factory());
    }
}
