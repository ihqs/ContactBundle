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
use Symfony\Component\HttpFoundation\RedirectResponse;

use IHQS\ContactBundle\Event\Events;
use IHQS\ContactBundle\Event\Event;

class ContactController extends Controller
{
    public function formAction()
    {
        $contact = $this->get('ihqs_contact.contact_manager')->createContact();

        $form        = $this->get('ihqs_contact.contact.form');
        $formHandler = $this->get('ihqs_contact.contact.form.handler');

        $formView = $this->container->getParameter('ihqs_contact.contact.form.view');
        $formView = ($formView) ? $formView : 'IHQSContactBundle:Contact:form.html.twig';

        $process = $formHandler->process($contact);
        if ($process) {
            $this->get('session')->setFlash('notice', 'Your contact request was successfully sent');
        }

        return $this->render(
            $formView,
            array(
                'form'      => $form->createview(),
            )
        );
    }
}