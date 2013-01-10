<?php
/**
 * Newbridge Green
 * User: jsutherland
 */
namespace NewbridgeGreen\RulesBundle\Comparator;

class Equals extends AbstractComparator
{
    public function compare($actual)
    {
        return $this->expected == $actual;
    }
}
