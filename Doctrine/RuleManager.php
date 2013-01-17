<?php
/**
 * Newbridge Green
 * User: jsutherland
 */

namespace NewbridgeGreen\RulesBundle\Doctrine;

use Doctrine\MongoDB\Database;
use Doctrine\MongoDB\Cursor;
use Doctrine\MongoDB\Connection;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Collections\ArrayCollection;

use NewbridgeGreen\RulesBundle\Document\Rule;
use NewbridgeGreen\RulesBundle\Comparator\Comparable;

class RuleManager
{

    protected $ruleDocument = 'NewbridgeGreen\RulesBundle\Document\Rule';
    protected $om;

    protected $rules;

    public function __construct(ObjectManager $dm, $document = null)
    {
        //TODO: Make this generic so it will work with ORM/Couch
        $this->om = $dm;
        if ($document) {
            $this->ruleDocument = $document;
        }
        $this->rules = new ArrayCollection;

    }

    public function getRules($target)
    {
        $matches = new ArrayCollection();

        $rules = $this->findRules($target);
        // Get all the rules that match the object
        foreach ($rules as $rule) {
            if ($rule->matches($target)) {
                $matches->add($rule);
            }
        }

        // Check if any of the matches found are overridden by
        // newer rules and remove them if they are.
        foreach ($matches as $match) {
            foreach ($rules as $rule) {
                if ($rule->overrides($match)) {
                    $matches->removeElement($match);
                }
            }
        }

        return $matches;
    }

    public function save(Rule $rule)
    {
        $this->om->persist($rule);
        $this->om->flush();
    }

    public function findRules($target)
    {
        return $this->om->getRepository($this->ruleDocument)->findByTarget(get_class($target));
    }

    public function evaluate($object)
    {
        $result = false;
        $rules = $this->getRules($object);

        foreach ($rules as $rule) {
            $result = $rule->evaluate($object);
        }

        return $result;
    }

    public function create(array $data = array())
    {
        $rule = new \Rule();
    }
}
