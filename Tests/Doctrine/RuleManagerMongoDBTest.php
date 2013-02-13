<?php
/**
 * Newbridge Green
 * User: jsutherland
 */

namespace NewbridgeGreen\RulesBundle\Tests\Doctrine;

use NewbridgeGreen\RulesBundle\Doctrine\RuleManager;
use NewbridgeGreen\RulesBundle\Document\Rule;
use NewbridgeGreen\RulesBundle\Document\Condition;
use NewbridgeGreen\RulesBundle\Comparator\Equals;
use NewbridgeGreen\RulesBundle\Tests\Fixture\Employee;

class RuleManagerMongoDBTest extends \PHPUnit_Framework_TestCase
{

    private $om;
    private $ruleManager;

    public function setUp()
    {
        if (!interface_exists('Doctrine\Common\Persistence\ObjectManager')) {
            $this->markTestSkipped('Doctrine Common has to be installed for this test to run.');
        }
        $this->om = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $this->ruleManager = $this->createRuleManager($this->om);
    }


    public function testSaveNewRule()
    {
        $rule = new Rule();
        $employee = new Employee();

        $condition = new Condition;
        $condition->setTarget($employee)
            ->setProperty('active')
            ->setComparator(new Equals(true));

        $rule->addCondition($condition);

        $this->ruleManager->save($rule);
    }

    protected function getOptions()
    {
        return array(
            'collection' => 'rules',
        );
    }

    protected function createRuleManager($om)
    {
        return new RuleManager($om);
    }

    public function arrayRuleProvider()
    {
        return array(
            'name' => 'Test',
            'target' => 'NewbridgeGreen\RulesBundle\Tests\Fixtures\Employee',
            'conditions' => array(
                'property' => 'active',
                'comparator' => 'NewbridgeGreen\RulesBundle\Comparator\Equals',
                'expected' => true
            ),
            'actions' => array(
                'class' => 'NewbridgeGreen\RulesBundle\Action\CreateTask',
                'data' => array(
                    'title' => 'New Task'
                )
            )
        );
    }
}