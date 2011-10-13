<?php

namespace IHQS\ContactBundle\SpamDetection;

/**
 * Stub Spam detector
 *
 * @author digitalkaoz <seroscho@googlemail.com>
 */
class TrueDetector implements SpamDetectorInterface
{
    /**
     * report all as spam
     * 
     * @param array $data
     * @return boolean 
     */
    public function isSpam(array $data)
    {
        return true;
    }
}
