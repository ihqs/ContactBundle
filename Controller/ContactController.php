<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace IHQS\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcher;

class ContactController extends Controller
{
    public function formAction()
    {
        $message = '';
        
        $contactRequest = $this->get('ihqs_contact.manager.contact')->createContact();

        $formClass = $this->container->getParameter('ihqs_contact.form.contact.class');
        $form = $formClass::create(
            $this->get('form.context'),
            'contact',
            array('data_class' => $this->container->getParameter('ihqs_contact.model.contact.class'))
        );
        
        $form->bind($this->get('request'), $contactRequest);

        if($form->isValid())
        {
            $event = new Event($contactRequest, 'form.contact_submission');
            $this->get('event_dispatcher')->notify($event);

            $message = 'Your contact request has been processed';
        }
        
        return $this->render(
            'IHQSContactBundle:Contact:form.html.twig',
            array(
                'form'      => $form,
                'message'   => $message
            )
        );
    }
}