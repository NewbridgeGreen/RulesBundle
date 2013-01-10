<?php
/**
 * Newbridge Green
 * User: jsutherland
 */

namespace NewbridgeGreen\RulesBundle\Action;

interface Actionable
{
    public function perform($target);
}
