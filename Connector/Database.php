<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace IHQS\ContactBundle\Connector;

use IHQS\ContactBundle\Model\ContactInterface;
use Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle;
use Symfony\Component\EventDispatcher\EventDispatcher;

class Database extends BaseConnector implements ConnectorInterface
{
    public function doProcess(ContactInterface $contact)
    {
        $manager = $this->container->get('ihqs_contact.model_manager');
        $manager->persist($contact);
        $manager->flush();

        return true;
    }
}

