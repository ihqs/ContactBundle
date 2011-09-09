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

class File extends BaseConnector implements ConnectorInterface
{
    public function doProcess(ContactInterface $contact)
    {
        $dir = $this->container->getParameter('kernel.root_dir') . '/logs';

        $line = array();
        array_push($line, $contact->getCreatedAt()->format('Y-m-d H:i:s'));
        array_push($line, $contact->getSenderEmail());
        array_push($line, $contact->getSenderName());
        array_push($line, $contact->getSubject());
        array_push($line, $contact->getMessage());

        file_put_contents($dir . '/contact.log', implode("\t", $line), FILE_APPEND);

        return true;
    }
}

