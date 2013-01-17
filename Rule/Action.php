<?php
/**
 * Newbridge Green
 * User: jsutherland
 */

namespace NewbridgeGreen\RulesBundle\Rule;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\EmbeddedDocument
 */
class Action
{
    /**
     * @var Class Action class to instantiate
     */
    protected $class;

    /**
     * @var string Fully Qualitied Class Name
     */
    protected $className;

    /**
     * @var mixed Data to be sent to the action
     */
    protected $data;

    public function __construct(array $config = array()) {
        if (isset($config['class_name'])) {
            $this->setClassName($config['class_name']);
        }

        if (isset($config['data'])) {
            $this->setData($config['data']);
        }

        if (isset($config['class'])) {
            $this->setClass($config['class']);
        }
    }
    /**
     * @param string $class
     */
    public function setClass($class)
    {
        if (is_object($class)) {
            $this->className = get_class($class);
        }
        $this->class = $class;
        $this->data = $this->class->getData();
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    public function getClassName()
    {
        return $this->className;
    }

    public function setClassName($className)
    {
        $this->className = $className;
        return $this;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    public function perform($object)
    {
        if ($this->class === null && $this->className) {
            $this->class = new $this->className($this->data);
        }
        try {
            $this->class->perform($object);
            return true;
        } catch (\Exception $e) {

        }
    }
}
