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

class ContactController extends Controller
{
    public function getAction()
    {
        return $this->render($this->getFormView(), array(
                'form' => $this->getForm()->createview(),
            )
        );
    }

    public function postAction($msg = 'Message sent')
    {
        $contact = $this->get('ihqs_contact.contact_manager')->createContact();
        $formHandler = $this->get('ihqs_contact.contact.form.handler');

        if ($formHandler->process($contact)) {
            return new Response($msg);
        }

        return $this->render($this->getFormView(), array(
                'form' => $this->getForm()->createview(),
            )
        );
    }

    private function getForm()
    {
        return $this->get('ihqs_contact.contact.form');
    }

    private function getFormView()
    {
        $formView = $this->container->getParameter('ihqs_contact.contact.form.view');
        return ($formView) ? $formView : 'IHQSContactBundle:Contact:form.html.twig';
    }
}