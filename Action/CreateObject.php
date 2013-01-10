<?php
/**
 * Newbridge Green
 * User: jsutherland
 */

namespace NewbridgeGreen\RulesBundle\Action;

class CreateObject implements Actionable
{
    public function perform($object, $data = null)
    {
        return new $object($data);
    }
}
