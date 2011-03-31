<?php

namespace IHQS\ContactBundle\Provider;

use IHQS\ContactBundle\ProviderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Provider
{
    protected $container;

    protected $connectorServiceIds = array();

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function addConnectorServiceId($name, $serviceId)
    {
        $this->connectorServiceIds[$name] = $serviceId;
    }

    public function getConnector($name)
    {
        if (!isset($this->connectorServiceIds[$name]))
        {
            throw new \InvalidArgumentException(sprintf('The contact connector "%s" is not defined.', $name));
        }

        return $this->container->get($this->connectorServiceIds[$name]);
    }

    public function getConnectors()
    {
        return $this->connectorServiceIds;
    }
}
