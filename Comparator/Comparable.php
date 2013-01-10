<?php
/**
 * Newbridge Green
 * User: jsutherland
 */

namespace NewbridgeGreen\RulesBundle\Comparator;

interface Comparable
{
    public function __construct($expected);
    public function compare($actual);
}
