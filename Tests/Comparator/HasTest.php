<?php
/**
 * Newbridge Green
 * User: jsutherland
 */
namespace NewbridgeGreen\RulesBundle\Tests\Comparator;

use NewbridgeGreen\RulesBundle\Comparator\Has;
use NewbridgeGreen\RulesBundle\Tests\Fixture\Employee;

class HasTest extends \PHPUnit_Framework_TestCase
{
    public function testHasProperty()
    {
        $employee = new \NewbridgeGreen\RulesBundle\Tests\Fixture\Employee();

        $has = new Has('active');
        $this->assertTrue($has->compare($employee));

        $has = new Has('invalidProperty');
        $this->assertFalse($has->compare($employee));

        $has = new Has('empty');
        $this->assertFalse($has->compare($employee));

        $has = new Has('null');
        $this->assertFalse($has->compare($employee));
    }

}
