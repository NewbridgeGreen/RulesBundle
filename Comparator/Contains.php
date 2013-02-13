<?php
/**
 * Newbridge Green
 * User: jsutherland
 */
namespace NewbridgeGreen\RulesBundle\Comparator;

class Contains extends AbstractComparator
{
    public function compare($actual)
    {
        return preg_match('/^'.$this->expected.'/i', $actual);
    }
}
