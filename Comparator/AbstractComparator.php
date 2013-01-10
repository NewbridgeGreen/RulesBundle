<?php
/**
 * Newbridge Green
 * User: jsutherland
 */

namespace NewbridgeGreen\RulesBundle\Comparator;

abstract class AbstractComparator implements Comparable
{
    protected $expected;

    public function __construct($expected)
    {
        $this->expected = $expected;
    }

    public function setExpected($expected)
    {
        $this->expected = $expected;
    }

    public function getExpected()
    {
        return $this->expected;
    }
}