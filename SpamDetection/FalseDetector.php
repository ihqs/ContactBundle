<?php

namespace IHQS\ContactBundle\SpamDetection;

/**
 * Default Stub Spam detector
 *
 * @author digitalkaoz <seroscho@googlemail.com>
 */
class FalseDetector implements SpamDetectorInterface
{
    /**
     * dont check for spams
     * 
     * @param array $data
     * @return boolean 
     */
    public function isSpam(array $data)
    {
        return false;
    }
}
