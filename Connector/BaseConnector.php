<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace IHQS\ContactBundle\Connector;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\EventDispatcher\Event;
use IHQS\ContactBundle\Model\ContactInterface;
use IHQS\ContactBundle\Event\ContactEvent;

abstract class BaseConnector implements ContainerAwareInterface
{
    protected $container, $spamDetector;

    /**
     * inject the container
     * 
     * @param ContainerInterface $container 
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * delegates the event to the set connectors
     * 
     * @param Event $event
     * @return boolean 
     */
    public function process(Event $event)
    {
        $message = $event->getSubject();
        
        return $this->doProcess($message);
    }

    /**
     * event listener for a submitted form
     * 
     * @param ContactEvent $event
     * @return boolean 
     */
    public function onContactRequest(ContactEvent $event)
    {
        $contact = $event->getContact();
        
        if(!$this->isSpam($contact))
        {
            return $this->doProcess($contact);
        }
        else
        {
            $this->container->get('session')->setFlash('error','your request have been marked as spam');
            return false;
        }
    }
    
    /**
     * checks if a contact request is spam
     *  
     * @param ContactInterface $contact
     * @return boolean
     */
    protected function isSpam(ContactInterface $contact)
    {
        return $this->spamDetector->isSpam(array(
            'comment_author' => $contact->getSenderName(),
            'comment_content' => $contact->getSubject()
        ));   
    }

    /**
     * set the spam detector IHQS\ContactBundle\SpamDetection\False by default
     * 
     * @param type $spamDetector
     */
    public function setSpamDetector($spamDetector)
    {
        $this->spamDetector = $spamDetector;
    }
}

