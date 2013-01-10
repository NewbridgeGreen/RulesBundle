<?php
/**
 * Newbridge Green
 * User: jsutherland
 */

namespace NewbridgeGreen\RulesBundle\Tests\Document;

use NewbridgeGreen\RulesBundle\Document\Rule;
use NewbridgeGreen\RulesBundle\Document\Condition;
use NewbridgeGreen\RulesBundle\Document\Action;
use NewbridgeGreen\RulesBundle\Comparator\Equals;
use NewbridgeGreen\RulesBundle\Comparator\Has;
use NewbridgeGreen\RulesBundle\Action\CreateTask;

use NewbridgeGreen\RulesBundle\Tests\Fixture\Document;
use NewbridgeGreen\RulesBundle\Tests\Fixture\Employee;



/**
 *
 */
class RuleTest extends \PHPUnit_Framework_TestCase
{
    /** @var Rule */
    private $rule;

    public function setUp()
    {
        $this->rule = new Rule();
    }

    public function testRule()
    {

        // assert that rules are active by default
        $this->assertTrue($this->rule->isActive());

        $this->rule->setActive(false);

        // assert that we can change the active state
        $this->assertFalse($this->rule->isActive());

    }

    public function testAddRemoveCondition()
    {
        $rc = new Condition();
        $this->rule->addCondition($rc);

        $this->assertEquals(1, $this->rule->getConditions()->count());

        $this->rule->removeCondition($rc);

        $this->assertEquals(0, $this->rule->getConditions()->count());

    }

    public function testAddRemoveAction()
    {
        $rc = new Action();
        $this->rule->addAction($rc);

        $this->assertEquals(1, $this->rule->getActions()->count());

        $this->rule->removeAction($rc);

        $this->assertEquals(0, $this->rule->getActions()->count());

    }

    public function testEmployeeIsActive()
    {
        $employee = new Employee;
        $document = new Document;

        $employee->addDocument($document);

        $condition = new Condition;
        $condition->setProperty('active')
            ->setComparator(new Equals(true));

        $this->rule->setTarget($employee);
        $this->rule->addCondition($condition);

        $this->assertTrue($this->rule->matches($employee));

    }

    public function testEmployeeHasDocument()
    {
        $employee = new Employee;
        $document = new Document;

        $employee->addDocument($document);

        $condition = new Condition();
        $condition->setProperty('documents')
            ->setComparator(new Has($document));

        $this->rule->setTarget($employee);
        $this->rule->addCondition($condition);

        $this->assertTrue($this->rule->matches($employee));

    }

    public function testEmployeeHasInvalidDocument()
    {
        $employee = new Employee;
        $document = new Document;
        $invalidDocument = new Document;

        $employee->addDocument($document);

        $condition = new Condition();
        $condition->setProperty('documents')
            ->setComparator(new Has($invalidDocument));

        $this->rule->setTarget($employee);
        $this->rule->addCondition($condition);

        $this->assertFalse($this->rule->matches($employee));

    }

    public function testActionOnInactiveEmployee()
    {
        $employee = new Employee;
        $employee->setActive(false);

        $rule = new Rule();
        $rule->setTarget($employee);

        $condition = new Condition;
        $condition->setProperty('active')
            ->setComparator(new Equals(false));

        $action = new Action;
        $action->setClass(new CreateTask(array('name' => 'New Task')));

        $rule->addCondition($condition);
        $rule->addAction($action);

        $rule->evaluate($employee);

        // Check to see if we have had a task added
        $this->assertEquals(1, $employee->getTasks()->count());
    }

    /*public function testNewTaskIfEmployeeHasNoDocument()
    {
        $employee = new Employee;
        $document = new Document;

        $employee->addDocument($document);

        $condition = new Condition();
        $condition->setTarget($employee)
            ->setProperty('documents')
            ->setComparator(new Has())
            ->setValue($invalidDocument);

        $this->rule->addCondition($condition);

        $this->rule->evaluate();
    } */


    /**
     * @dataProvider overrideRuleProvider
     */
    public function testRuleOverride(Rule $overridden, Rule $overrider)
    {
        $this->assertTrue($overrider->overrides($overridden));
        $this->assertFalse($overridden->overrides($overrider));
    }

    public function prepareSingleRule(Rule $rule)
    {
        $this->rule = new Rule();
        $condition = new Condition();
        $condition->setComparator('active', new Equals(true));

    }

    public function overrideRuleProvider()
    {
        $overridden = new Rule();
        $overrider = new Rule();

        $overrider->addOverride($overridden);

        return array(
            array($overridden, $overrider)
        );
    }
}
