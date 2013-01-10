<?php
/**
 * Newbridge Green
 * User: jsutherland
 */

namespace NewbridgeGreen\RulesBundle\Rule;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="rules")
 */
class Rule
{

    /**
     * @var bool State boolean to see if this rule is active or not
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @var bool
     * @MongoDB\Boolean
     */
    protected $active = true;

    /**
     * @var bool
     * @MongoDB\Boolean
     */
    protected $readOnly = true;

    /**
     * @var String The full class name we want to apply this rule to
     */
    protected $target;

    /**
     * @var String The full class name we want to apply this rule to
     * @MongoDB\String
     */
    protected $targetClassName;

    /**
     * @var Rule[] Which rules does this one override
     * @MongoDB\ReferenceMany(targetDocument="Rule")
     */
    protected $overrides;

    /**
     * @var Condition[] A collection of conditions to be checked for this rule to hold true
     * @MongoDB\EmbedMany(targetDocument="Condition")
     */
    protected $conditions;

    /**
     * @var Action[] A collection of actions to perform when the conditions are met
     * @MongoDB\EmbedMany(targetDocument="Action")
     */
    protected $actions;

    /**
     *  Setup the array collections
     */
    public function __construct()
    {
        $this->conditions = new ArrayCollection();
        $this->actions = new ArrayCollection();
        $this->overrides = new ArrayCollection();
    }

    /**
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $actions
     */
    public function setActions($actions)
    {
        $this->actions = $actions;
    }

    /**
     * @return Action[]
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * @param Action $action
     * @return Rule
     */
    public function addAction(Action $action)
    {
        $this->actions->add($action);
        return $this;
    }

    /**
     * @param Action $action
     * @return Rule
     */
    public function removeAction(Action $action)
    {
        $this->actions->removeElement($action);
        return $this;
    }

    /**
     * @param Condition[] $conditions
     */
    public function setConditions($conditions)
    {
        $this->conditions = $conditions;
    }

    /**
     * @return Condition[]
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * @param Condition $condition
     * @return Rule
     */
    public function addCondition(Condition $condition)
    {
        $this->conditions->add($condition);
        return $this;
    }

    /**
     * @param Condition $condition
     * @return Rule
     */
    public function removeCondition(Condition $condition)
    {
        $this->conditions->removeElement($condition);
        return $this;
    }

    /**
     * @param boolean $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return boolean
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $overrides
     */
    public function setOverrides($overrides)
    {
        $this->overrides = $overrides;
    }

    /**
     * @return Rule[]
     */
    public function getOverrides()
    {
        return $this->overrides;
    }

    /**
     * @param Rule $rule
     * @return Rule
     */
    public function addOverride(Rule $rule)
    {
        $this->overrides->add($rule);
        return $this;
    }

    /**
     * Returns true if this rule overrides the one given.
     * @param Rule $rule
     * @return bool
     */
    public function overrides(Rule $rule)
    {
        if ($this->overrides && !$this->overrides->isEmpty()) {
            return $this->overrides->forAll(function($i, $override) use ($rule) {
                if ($override === $rule) {
                    return true;
                }
            });
        }
        return false;
    }

    /**
     * @param $readOnly
     */
    public function setReadOnly($readOnly)
    {
        $this->readOnly = $readOnly;
    }

    /**
     * @return bool
     */
    public function getReadOnly()
    {
        return $this->readOnly;
    }

    /**
     * @param \NewbridgeGreen\RulesBundle\Document\Class $target
     */
    public function setTarget($target)
    {
        if (is_object($target)) {
            $this->target = get_class($target);
        }
        return $this;
    }

    /**
     * @return \NewbridgeGreen\RulesBundle\Document\Class
     */
    public function getTarget()
    {
        return $this->target;
    }

    public function getTargetClassName()
    {
        return $this->targetClassName;
    }

    public function matches($object)
    {
        foreach ($this->conditions as $condition) {
            $result = $condition->evaluate($object);
            // Return false if this rule is not a match
            if ($result === false) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return bool
     */
    public function evaluate($object)
    {
        if ($this->matches($object)) {
            if (!$this->actions->isEmpty()) {
                return $this->performActions($object);
            }
        }
        return false;
    }

    protected function performActions($object)
    {
        $result = false;
        foreach ($this->getActions() as $action) {
            $result = $action->perform($object);
        }
        return $result;
    }
}
