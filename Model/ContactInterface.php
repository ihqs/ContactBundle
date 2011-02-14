<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bundle\IHQS\ContactBundle\Model;

interface ContactInterface
{
    function setSenderEmail($senderEmail);

    function getSenderEmail();

    function setSenderName($senderName);

    function getSenderName();

    function setSubject($subject);

    function getSubject();

    function setMessage($message);

    function getMessage();

    function incrementCreatedAt();

    function getCreatedAt();
}
