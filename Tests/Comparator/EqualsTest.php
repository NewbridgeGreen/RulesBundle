<?php
/**
 * Newbridge Green
 * User: jsutherland
 */
namespace NewbridgeGreen\RulesBundle\Tests\Comparator;

use NewbridgeGreen\RulesBundle\Comparator\Equals;

class EqualsTest extends \PHPUnit_Framework_TestCase
{
    public function testEqualsComparison()
    {
        $equals = new Equals(1);
        $this->assertTrue($equals->compare(1));
        $this->assertFalse($equals->compare(2));
    }

}
