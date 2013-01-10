<?php
/**
 * Newbridge Green
 * User: jsutherland
 */
namespace NewbridgeGreen\RulesBundle\Tests\Action;

use NewbridgeGreen\RulesBundle\Action\CreateObject;

class CreateObjectTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateObjectAction()
    {
        $create = new CreateObject();

        $employee = $create->perform('NewbridgeGreen\RulesBundle\Tests\Fixture\Employee');

        $this->assertTrue($employee->getActive());
    }

}