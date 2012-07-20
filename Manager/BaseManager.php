<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace IHQS\ContactBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

abstract class BaseManager extends ContainerAware
{
    public function getRepository()
    {
        return $this->repository;
    }

    public function getClass()
    {
        return $this->class;
    }
}