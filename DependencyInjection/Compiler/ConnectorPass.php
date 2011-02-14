<?php
namespace Bundle\IHQS\ContactBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class ConnectorPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $connectors = array();

        foreach ($container->findTaggedServiceIds('ihqs_contact.connector') as $id => $attributes)
        {
            if (isset($attributes[0]['alias']))
            {
                $connectors[$attributes[0]['alias']] = $id;
            }
        }
        
        $container->setParameter('ihqs_contact.connectors', $connectors);
    }
}