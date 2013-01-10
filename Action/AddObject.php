<?php
/**
 * Newbridge Green
 * User: jsutherland
 */
namespace NewbridgeGreen\RulesBundle\Action;

class AddObject implements Actionable
{
    public function perform($obj1, $obj2)
    {
        return new $obj1->add($obj2);
    }
}
