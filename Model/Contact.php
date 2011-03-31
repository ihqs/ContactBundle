<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace IHQS\ContactBundle\Model;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

class Contact implements ContactInterface
{
    protected $createdAt;
    
    protected $senderEmail;

    protected $senderName;

    protected $subject;

    protected $message;

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setSenderEmail($senderEmail)
    {
        $this->senderEmail = $senderEmail;
        return $this;
    }

    public function getSenderEmail()
    {
        return $this->senderEmail;
    }

    public function setSenderName($senderName)
    {
        $this->senderName = $senderName;
        return $this;
    }

    public function getSenderName()
    {
        return $this->senderName;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function incrementCreatedAt()
    {
        $this->createdAt = new \DateTime();
    }

    static public function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('senderEmail', new NotBlank(array(
            'message' => 'Please add an email address'
        )));
        $metadata->addPropertyConstraint('senderEmail', new Email(array(
            'message' => 'Please add a valid email address'
        )));
        $metadata->addPropertyConstraint('senderName', new NotBlank(array(
            'message' => 'Please add your name'
        )));
        $metadata->addPropertyConstraint('subject', new NotBlank(array(
            'message' => 'Please add a subject for your message'
        )));
        $metadata->addPropertyConstraint('message', new NotBlank(array(
            'message' => 'Please add a message'
        )));
    }
}
