<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 * (c) Laszlo Horvath <pentarim@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace IHQS\ContactBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ContactFormType extends AbstractType
{
    private $class;

    /**
     * @param string $class The Contact class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('senderEmail');
        $builder->add('senderName');
        $builder->add('subject');
        $builder->add('message', 'textarea');
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => $this->class);
    }

    public function getName()
    {
        return 'ihqs_contact_contact';
    }
}
