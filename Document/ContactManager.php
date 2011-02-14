<?php

namespace Bundle\IHQS\ContactBundle\Entity;

use Doctrine\ORM\DocumentManager;
use Bundle\IHQS\ContactBundle\Manager\ContactManager as BaseContactManager;

class ContactManager extends BaseContactManager
{
    protected $dm;
    protected $class;
    protected $repository;

    public function __construct(DocumentManager $dm, $class)
    {
        $this->dm = $dm;
        $this->repository  = $dm->getRepository($class);

        $metadata = $dm->getClassMetadata($class);
        $this->class = $metadata->name;
    }
}