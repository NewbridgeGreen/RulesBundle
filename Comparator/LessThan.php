<?php
/**
 * Newbridge Green
 * User: jsutherland
 */
namespace NewbridgeGreen\RulesBundle\Comparator;

class LessThan extends AbstractComparator
{
    public function compare($actual)
    {
        return $actual < $this->expected;
    }
}
