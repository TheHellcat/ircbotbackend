<?php

namespace Hellcat\Tools\UserBundle\Security\Factory;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\SecurityFactoryInterface;

/**
 * Class Factory
 * @package Hellcat\Tools\UserBundle\Security\Factory
 */
class Factory implements SecurityFactoryInterface
{
    public function create(ContainerBuilder $container, $id, $config, $userProvider, $defaultEntryPoint)
    {
        $providerId = 'security.authentication.provider.hcuser.'.$id;
        $container
            ->setDefinition($providerId, new DefinitionDecorator('hc_user.security.authentication.provider'))
            ->replaceArgument(0, new Reference($userProvider))
        ;

        $listenerId = 'security.authentication.listener.hcuser.'.$id;
        $listener = $container->setDefinition($listenerId, new DefinitionDecorator('hc_user.security.authentication.listener'));

        return array($providerId, $listenerId, $defaultEntryPoint);
    }

    public function getPosition()
    {
        return 'pre_auth';
    }

    public function getKey()
    {
        return 'hc_user';
    }

    public function addConfiguration(NodeDefinition $node)
    {
    }
}
