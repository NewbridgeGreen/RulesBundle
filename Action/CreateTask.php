<?php
/**
 * Newbridge Green
 * User: jsutherland
 */

namespace NewbridgeGreen\RulesBundle\Action;

use NewbridgeGreen\RulesBundle\Tests\Fixture\Task;

class CreateTask extends AbstractAction
{
    protected $task;

    public function __construct($data)
    {
        parent::__construct($data);

        $this->task = new Task($data);
    }

    public function perform($target)
    {
        if (method_exists($target, 'addTask')) {
            return $target->addTask($this->task);
        }
        throw new \BadMethodCallException('Target does not handle tasks');
    }
}
