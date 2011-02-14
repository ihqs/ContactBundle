<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bundle\IHQS\ContactBundle\Connector;

use Bundle\IHQS\ContactBundle\Model\ContactInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

interface ConnectorInterface
{
    function register(EventDispatcher $dispatcher, $priority = 0);
    
    function doProcess(ContactInterface $contact);
}