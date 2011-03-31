<?php
namespace IHQS\ContactBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class ConnectorPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('ihqs_contact.provider')) {
            return;
        }
        $definition = $container->getDefinition('ihqs_contact.provider');

        $menus = array();
        foreach ($container->findTaggedServiceIds('ihqs_contact.connector') as $id => $attributes) {
            if (isset($attributes[0]['alias']))
            {
                $definition->addMethodCall('addConnectorServiceId', array($attributes[0]['alias'], $id));
            }
        }
    }
}