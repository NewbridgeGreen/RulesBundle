<?php
/**
 * Newbridge Green
 * User: jsutherland
 */

namespace NewbridgeGreen\RulesBundle\Tests\Document;

use NewbridgeGreen\RulesBundle\Document\Rule;
use NewbridgeGreen\RulesBundle\Document\Condition;
use NewbridgeGreen\RulesBundle\Comparator\Equals;
use NewbridgeGreen\RulesBundle\Comparator\Has;

use NewbridgeGreen\RulesBundle\Tests\Fixture\Employee;

/**
 *
 */
class ConditionTest extends \PHPUnit_Framework_TestCase
{
    /** @var Condition */
    private $condition;

    public function setUp()
    {
        $this->condition = new Condition();
    }

    public function testTargetPropertyEqualsCondition()
    {

        $target = new Employee();

        // If an Employees 'active' property is true
        $this->condition->setProperty('active');
        $this->condition->setComparator(new Equals(true));

        // assert that rules are active by default
        $this->assertTrue($this->condition->evaluate($target));
    }

    public function testInvalidProperty()
    {
        $this->setExpectedException('BadMethodCallException');

        $target = new Employee();

        //$this->condition->setTarget($target);
        $this->condition->setProperty('notthere');

        $this->assertTrue($this->condition->evaluate($target));

        $this->fail('Expected BadMethodCallException to be thrown');
    }
}
