<?php
/**
 * Newbridge Green
 * User: jsutherland
 */

namespace NewbridgeGreen\RulesBundle\Tests\Functional;

use NewbridgeGreen\RulesBundle\Action\CreateTask;
use NewbridgeGreen\RulesBundle\Document\Rule;
use NewbridgeGreen\RulesBundle\Document\Condition;
use NewbridgeGreen\RulesBundle\Document\Action;
use NewbridgeGreen\RulesBundle\Comparator\Equals;
use NewbridgeGreen\RulesBundle\Tests\Fixture\Employee;
use NewbridgeGreen\RulesBundle\Tests\Fixture\Document;

class RulesMongoDBTest extends FunctionalTestCase
{


    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        parent::setUp();
        \PHPUnit_Framework_Error_Notice::$enabled = FALSE;
        if (!class_exists('Doctrine\MongoDB\Connection')) {
            $this->markTestSkipped('Doctrine2 MongoDB is required for this test');
        }
    }

    public function testSaveNewRule()
    {
        $rule = new Rule();
        $employee = new Employee();

        $rule->setTarget($employee);

        $condition = new Condition;
        $condition->setProperty('active')
            ->setComparator(new Equals(true));

        $rule->addCondition($condition);

        $action = new Action;
        $action->setClass(new CreateTask(array('name' => 'Test')));

        $rule->addAction($action);

        static::$rm->save($rule);

        $result = static::$rm->evaluate($employee);

        $this->assertTrue($result);
        $this->assertEquals(1, $employee->getTasks()->count());

        $document = new Document;

        $result = static::$rm->evaluate($document);

        $this->assertFalse($result);
    }

    public function testSaveIncorrectRule()
    {
        $rule = new Rule();
        $employee = new Employee();

        $rule->setTarget($employee);

        $condition = new Condition;
        $condition->setProperty('active')
            ->setComparator(new Equals(false));

        $rule->addCondition($condition);

        static::$rm->save($rule);

        $result = static::$rm->evaluate($employee);

        $this->assertFalse($result);
    }
}
