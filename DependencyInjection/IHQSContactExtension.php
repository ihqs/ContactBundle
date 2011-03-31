<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace IHQS\ContactBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\EventDispatcher\EventDispatcher;

use Symfony\Component\Config\FileLocator;

class IHQSContactExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(array(__DIR__.'/../Resources/config')));
        $loader->load('form.xml');
        $loader->load('connector.xml');
        $loader->load('model.xml');

        foreach($configs as $config_unit)
        {
            $this->doConfigLoad($config_unit, $container);
        }

    }

    public function doConfigLoad(array $config, ContainerBuilder $container)
    {
        // Connectors
        if(!isset($config['connectors']))
        {
            $config['connectors'] = array();
        }

        foreach($config['connectors'] as $connector => $attributes)
        {
            // custom connectors
            if(array_key_exists("class", (array) $attributes))
            {
                // TODO
                continue;
            }

            // built-in connectors
            $service_id = 'ihqs_contact.connector.' . $connector;
            if($container->has($service_id))
            {
                $container->getDefinition($service_id)->addTag('ihqs_contact.connector', array('alias' => $connector));
            }

            // built-in connector configuration
            $mappingMethod = "map" . ucfirst($connector) . "ConnectorParameters";
            if(method_exists($this, $mappingMethod))
            {
                $this->$mappingMethod($attributes, $container);
            }
        }

        // Contact form and entities
        if(array_key_exists("model", $config)
        && isset($config['model']))
        {
            $container->setParameter('ihqs_contact.model.contact.class', $config['model']);
        }

        if(array_key_exists("form", $config)
        && isset($config['form']))
        {
            $container->setParameter('ihqs_contact.form.contact.class', $config['form']);
        }
    }

    public function mapEmailConnectorParameters($config, ContainerBuilder $container)
    {
        $container->setParameter('ihqs_contact.email.recipients', $config['recipients']);
    }

    public function mapDatabaseConnectorParameters($config, ContainerBuilder $container)
    {
        if(!isset($config['db_driver'])
        || !in_array(strtolower($config['db_driver']), array('orm', 'mongodb')))
        {
            throw new \InvalidArgumentException(sprintf('Invalid db driver "%s".', $config['db_driver']));
        }

        $loader = new XmlFileLoader($container, new FileLocator(array(__DIR__.'/../Resources/config')));
        $loader->load(sprintf('%s.xml', $config['db_driver']));
    }
}