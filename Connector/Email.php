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

class Email extends BaseConnector implements ConnectorInterface
{
    public function doProcess(ContactInterface $contact)
    {
        $mailer = $this->container->get('mailer');

        $mail = \Swift_Message::newInstance()
            ->setSubject('[Contact] ' . $contact->getSubject())
            ->setFrom($contact->getSenderEmail(), $contact->getSenderName())
            ->setTo($this->container->getParameter('ihqs_contact.email.recipients'))
            ->setBody($contact->getMessage());

        $mailer->send($mail);

        return true;
    }
}

