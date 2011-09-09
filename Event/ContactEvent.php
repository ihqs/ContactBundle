<?php

namespace IHQS\ContactBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use IHQS\ContactBundle\Model\ContactInterface;

class ContactEvent extends Event
{
    protected $contact;

    public function __construct(ContactInterface $contact)
    {
        $this->contact = $contact;
    }

    public function getContact()
    {
        return $this->contact;
    }
}
