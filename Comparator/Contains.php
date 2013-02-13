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
        return (boolean) preg_match('/'.preg_quote($this->expected, '/').'/i', $actual);
    }
}
