<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace IHQS\ContactBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\TextareaField;

class ContactForm extends Form
{
    public function configure()
    {
        $this->add('senderEmail');
        $this->add('senderName');
        $this->add('subject');
        $this->add(new TextareaField('message'));
    }
}
