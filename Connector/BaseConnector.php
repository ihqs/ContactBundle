<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace IHQS\ContactBundle\Connector;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\EventDispatcher\Event;

abstract class BaseConnector implements ContainerAwareInterface
{
    protected $container;

    public function __construct()
    {
        
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function process(Event $event)
    {
        $message = $event->getSubject();
        return $this->doProcess($message);
    }
}

