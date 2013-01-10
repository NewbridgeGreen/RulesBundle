<?php
/**
 * Newbridge Green
 * User: jsutherland
 */

namespace NewbridgeGreen\RulesBundle\Tests\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

class Employee
{
    /** @var bool */
    protected $active = true;

    /** @var string */
    protected $empty = '';

    /** @var null */
    protected $null = null;

    /** @var ArrayCollection */
    protected $documents;

    /** @var ArrayCollection */
    protected $tasks;

    /** @var ArrayCollection */
    protected $rules;

    public function __construct()
    {
        $this->documents = new ArrayCollection;
        $this->rules = new ArrayCollection;
        $this->tasks = new ArrayCollection;
    }

    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param string $empty
     */
    public function setEmpty($empty)
    {
        $this->empty = $empty;
    }

    /**
     * @return string
     */
    public function getEmpty()
    {
        return $this->empty;
    }

    /**
     * @param null $null
     */
    public function setNull($null)
    {
        $this->null = $null;
    }

    /**
     * @return null
     */
    public function getNull()
    {
        return $this->null;
    }

    public function setDocuments($documents)
    {
        $this->documents = $documents;
        return $this;
    }

    public function getDocuments()
    {
        return $this->documents;
    }

    public function addDocument(Document $document)
    {
        $this->documents->add($document);
    }

    /**
     * @param ArrayCollection $tasks
     */
    public function setTasks($tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @return ArrayCollection
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    public function getNextTask()
    {
        return $this->tasks->first();
    }

    public function addTask(Task $task)
    {
        $this->tasks->add($task);
        return $this;
    }

    /**
     * @param ArrayCollection $rules
     */
    public function setRules($rules)
    {
        $this->rules = $rules;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getRules()
    {
        return $this->rules;
    }

    public function addRule(Rule $rule)
    {
        $this->rules->add($rule);
    }
}
