<?php
/**
 * Newbridge Green
 * User: jsutherland
 */

namespace NewbridgeGreen\RulesBundle\Tests\Document;

use NewbridgeGreen\RulesBundle\Document\Rule;
use NewbridgeGreen\RulesBundle\Document\Action;
use NewbridgeGreen\RulesBundle\Action\CreateTask;

use NewbridgeGreen\RulesBundle\Tests\Fixture\Employee;

/**
 *
 */
class ActionTest extends \PHPUnit_Framework_TestCase
{
    /** @var Action */
    private $action;

    public function setUp()
    {
        $this->action = new Action();
    }

    public function testTargetPropertyEqualsAction()
    {

        $employee = new Employee();

        $this->action->setClass(new CreateTask(array(
            'name' => 'Test Task',
            'dueDate' => new \DateTime()
        )));
        $this->action->perform($employee);


        // assert that rules are active by default
        $this->assertEquals(1, $employee->getTasks()->count());
        $this->assertEquals('Test Task', $employee->getNextTask()->getName());

    }
}
