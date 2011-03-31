<?php

namespace IHQS\ContactBundle\Entity;

use Doctrine\ORM\EntityManager;
use IHQS\ContactBundle\Manager\ContactManager as BaseContactManager;

class ContactManager extends BaseContactManager
{
    protected $em;
    protected $class;
    protected $repository;

    public function __construct(EntityManager $em, $class)
    {
        $this->em = $em;
        $this->repository  = $em->getRepository($class);

        $metadata = $em->getClassMetadata($class);
        $this->class = $metadata->name;
    }
}