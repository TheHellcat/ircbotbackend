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
class LoginUserFactory implements SecurityFactoryInterface
{
    /**
     * @param ContainerBuilder $container
     * @param string $id
     * @param array $config
     * @param string $userProvider
     * @param string $defaultEntryPoint
     * @return array
     */
    public function create(ContainerBuilder $container, $id, $config, $userProvider, $defaultEntryPoint)
    {
        $providerId = 'security.authentication.provider.hcuser.'.$id;
        $container
            ->setDefinition($providerId, new DefinitionDecorator('hc_user.security.authentication.login_user.provider'))
            ->replaceArgument(0, new Reference($userProvider))
        ;

        $listenerId = 'security.authentication.listener.hcuser.'.$id;
        $listener = $container->setDefinition($listenerId, new DefinitionDecorator('hc_user.security.authentication.login_user.listener'));

        return array($providerId, $listenerId, $defaultEntryPoint);
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return 'pre_auth';
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return 'hc_user';
    }

    /**
     * @param NodeDefinition $node
     */
    public function addConfiguration(NodeDefinition $node)
    {
        // satisfy the interface
        unset($node);
    }
}
