<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace IHQS\ContactBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class ContactManager extends BaseManager implements ContactManagerInterface
{
    public function __construct($class)
    {
        $this->class = $class;
    }

    public function createContact()
    {
        $class = $this->getClass();

        $contact = new $class();
        return new $class();
    }

    public function getClass()
    {
        return $this->class;
    }
}