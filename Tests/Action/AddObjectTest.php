<?php
/**
 * Newbridge Green
 * User: jsutherland
 */
namespace NewbridgeGreen\RulesBundle\Tests\Action;

use NewbridgeGreen\RulesBundle\Action\AddObject;
use NewbridgeGreen\RulesBundle\Tests\Fixture\Employee;

class AddObjectTest extends \PHPUnit_Framework_TestCase
{
    public function testAddObjectAction()
    {
        //$this->markTestSkipped();
        $employee = new Employee();
        //$add = new AddObject($employee);

        $this->assertTrue($employee->getActive());
    }

}